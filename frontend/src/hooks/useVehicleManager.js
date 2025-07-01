import { useState, useRef, useCallback, useEffect } from 'react';
import VehicleManager from '../components/VehicleManager';

export const useVehicleManager = () => {
  const vehicleManagerRef = useRef(null);
  const [vehicles, setVehicles] = useState([]);
  const [activeSessions, setActiveSessions] = useState(new Map());
  const [isProcessing, setIsProcessing] = useState(false);
  const [lastError, setLastError] = useState(null);

  // Initialize VehicleManager
  useEffect(() => {
    if (!vehicleManagerRef.current) {
      vehicleManagerRef.current = new VehicleManager();
      console.log('✅ VehicleManager initialized');
    }
    
    return () => {
      // Cleanup if needed
      vehicleManagerRef.current = null;
    };
  }, []);

  // Set UI reference for VehicleManager
  const setUI = useCallback((uiInstance) => {
    if (vehicleManagerRef.current) {
      vehicleManagerRef.current.setUI(uiInstance);
    }
  }, []);

  // Process vehicle entry
  const processVehicleEntry = useCallback(async (entryData) => {
    if (!vehicleManagerRef.current) {
      throw new Error('VehicleManager not initialized');
    }

    setIsProcessing(true);
    setLastError(null);

    try {
      const {
        cardId,
        imagePath,
        licensePlate,
        policy,
        entryGate,
        cameraId,
        faceImagePath
      } = entryData;

      console.log('🚗 Processing vehicle entry:', entryData);
      
      const result = await vehicleManagerRef.current.processVehicleEntry(
        cardId,
        imagePath,
        licensePlate,
        policy,
        entryGate,
        cameraId,
        faceImagePath
      );

      if (result.success) {
        // Update local state
        const updatedSessions = new Map(vehicleManagerRef.current.getActiveParkingSessions());
        setActiveSessions(updatedSessions);
        
        const updatedVehicles = [...vehicleManagerRef.current.getVehicles()];
        setVehicles(updatedVehicles);
      }

      return result;
    } catch (error) {
      console.error('❌ Error in processVehicleEntry:', error);
      setLastError(error.message);
      return { success: false, message: error.message };
    } finally {
      setIsProcessing(false);
    }
  }, []);

  // Process vehicle exit
  const processVehicleExit = useCallback(async (exitData) => {
    if (!vehicleManagerRef.current) {
      throw new Error('VehicleManager not initialized');
    }

    setIsProcessing(true);
    setLastError(null);

    try {
      const {
        cardId,
        exitImagePath,
        exitGate,
        cameraId,
        plateMatch,
        exitLicensePlate,
        exitFaceImagePath
      } = exitData;

      console.log('🚗 Processing vehicle exit:', exitData);
      
      const result = await vehicleManagerRef.current.processVehicleExit(
        cardId,
        exitImagePath,
        exitGate,
        cameraId,
        plateMatch,
        exitLicensePlate,
        exitFaceImagePath
      );

      if (result.success) {
        // Update local state
        const updatedSessions = new Map(vehicleManagerRef.current.getActiveParkingSessions());
        setActiveSessions(updatedSessions);
        
        const updatedVehicles = [...vehicleManagerRef.current.getVehicles()];
        setVehicles(updatedVehicles);
      }

      return result;
    } catch (error) {
      console.error('❌ Error in processVehicleExit:', error);
      setLastError(error.message);
      return { success: false, message: error.message };
    } finally {
      setIsProcessing(false);
    }
  }, []);

  // Get vehicle by card ID
  const getVehicleByCardId = useCallback((cardId) => {
    return vehicles.find(vehicle => vehicle.ma_the === cardId);
  }, [vehicles]);

  // Check if vehicle is currently parked
  const isVehicleParked = useCallback((cardId) => {
    return activeSessions.has(cardId);
  }, [activeSessions]);

  // Get parking statistics
  const getParkingStatistics = useCallback(() => {
    const parkedVehicles = vehicles.filter(v => v.trang_thai === 'Trong bãi');
    const motorcycles = parkedVehicles.filter(v => v.loai_xe === 'xe_may').length;
    const cars = parkedVehicles.filter(v => v.loai_xe === 'oto').length;
    const totalRevenue = vehicles
      .filter(v => v.phi)
      .reduce((sum, v) => {
        const fee = typeof v.phi === 'string' ? 
          parseInt(v.phi.replace(/[^\d]/g, '')) || 0 : 
          v.phi || 0;
        return sum + fee;
      }, 0);

    return {
      totalParked: parkedVehicles.length,
      motorcycles,
      cars,
      totalProcessed: vehicles.length,
      totalRevenue
    };
  }, [vehicles]);

  // Clear error
  const clearError = useCallback(() => {
    setLastError(null);
  }, []);

  // Refresh vehicle data
  const refreshVehicleData = useCallback(async () => {
    if (vehicleManagerRef.current) {
      try {
        // This would typically call an API to refresh data
        const updatedVehicles = [...vehicleManagerRef.current.getVehicles()];
        setVehicles(updatedVehicles);
        
        const updatedSessions = new Map(vehicleManagerRef.current.getActiveParkingSessions());
        setActiveSessions(updatedSessions);
      } catch (error) {
        console.error('❌ Error refreshing vehicle data:', error);
        setLastError(error.message);
      }
    }
  }, []);

  // Return to management mode
  const returnToManagementMode = useCallback(() => {
    if (vehicleManagerRef.current) {
      vehicleManagerRef.current.returnToManagementMode();
    }
  }, []);

  return {
    // State
    vehicles,
    activeSessions,
    isProcessing,
    lastError,
    
    // Actions
    setUI,
    processVehicleEntry,
    processVehicleExit,
    getVehicleByCardId,
    isVehicleParked,
    getParkingStatistics,
    clearError,
    refreshVehicleData,
    returnToManagementMode,
    
    // Instance access (for advanced usage)
    vehicleManager: vehicleManagerRef.current
  };
};
