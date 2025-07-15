// userContext.js - Quản lý thông tin người dùng và quyền hạn

import React, { createContext, useContext, useState, useEffect } from 'react';
import { layThongTinQuyenHanNhanVien } from '../api/api';

const UserContext = createContext();

export const UserProvider = ({ children }) => {
  const [currentUser, setCurrentUser] = useState(null);
  const [permissions, setPermissions] = useState({
    canAccessConfig: false,
    canAccessCamera: false,
    canAccessPricing: false,
    canAccessZone: false,
    canAccessVehicle: false,
    canAccessVehicleType: false,
    canAccessRfid: false
  });
  const [isLoading, setIsLoading] = useState(true);

  // Load user từ localStorage khi app khởi động
  useEffect(() => {
    loadUserFromStorage();
  }, []);

  // Load user từ localStorage
  const loadUserFromStorage = async () => {
    try {
      setIsLoading(true);
      const storedToken = localStorage.getItem('authToken');
      const storedUser = localStorage.getItem('currentUser');
      
      console.log('[UserContext] Loading user from storage...', { 
        hasToken: !!storedToken, 
        hasUser: !!storedUser 
      });

      if (storedToken && storedUser) {
        const userData = JSON.parse(storedUser);
        
        // Verify token với server và lấy quyền hạn mới nhất
        console.log('[UserContext] Verifying token with server...');
        const permissionResult = await layThongTinQuyenHanNhanVien(storedToken, userData.userCode);
        
        if (permissionResult.success) {
          console.log('[UserContext] Token valid, updating user data');
          setCurrentUser({
            ...userData,
            ...permissionResult.data
          });
          setPermissions(permissionResult.data.permissions);
        } else {
          console.warn('[UserContext] Token invalid, clearing storage');
          clearUserData();
        }
      } else {
        console.log('[UserContext] No stored user data found');
      }
    } catch (error) {
      console.error('[UserContext] Error loading user:', error);
      clearUserData();
    } finally {
      setIsLoading(false);
    }
  };

  // Đăng nhập user
  const login = async (userData, token) => {
    try {
      console.log('[UserContext] Logging in user...', userData);
      
      // Lấy thông tin quyền hạn từ server
      const permissionResult = await layThongTinQuyenHanNhanVien(token, userData.userCode);
      
      if (permissionResult.success) {
        const fullUserData = {
          ...userData,
          ...permissionResult.data,
          loginTime: new Date().toISOString()
        };
        
        console.log('[UserContext] Login successful with permissions:', fullUserData);
        
        setCurrentUser(fullUserData);
        setPermissions(permissionResult.data.permissions);
        
        // Lưu vào localStorage
        localStorage.setItem('currentUser', JSON.stringify(fullUserData));
        localStorage.setItem('authToken', token);
        
        return { success: true };
      } else {
        console.error('[UserContext] Failed to get user permissions:', permissionResult.message);
        return { 
          success: false, 
          message: permissionResult.message || 'Không thể lấy thông tin quyền hạn' 
        };
      }
    } catch (error) {
      console.error('[UserContext] Login error:', error);
      return { 
        success: false, 
        message: `Lỗi đăng nhập: ${error.message}` 
      };
    }
  };

  // Đăng xuất
  const logout = () => {
    console.log('[UserContext] Logging out user');
    clearUserData();
  };

  // Clear user data
  const clearUserData = () => {
    setCurrentUser(null);
    setPermissions({
      canAccessConfig: false,
      canAccessCamera: false,
      canAccessPricing: false,
      canAccessZone: false,
      canAccessVehicle: false,
      canAccessVehicleType: false,
      canAccessRfid: false
    });
    localStorage.removeItem('currentUser');
    localStorage.removeItem('authToken');
  };

  // Kiểm tra quyền hạn
  const hasPermission = (permissionKey) => {
    const result = permissions[permissionKey] || false;
    console.log(`[UserContext] Checking permission '${permissionKey}':`, result);
    return result;
  };

  // Kiểm tra admin
  const isAdmin = () => {
    const result = currentUser?.isAdmin || false;
    console.log('[UserContext] Checking admin status:', result);
    return result;
  };

  // Refresh permissions
  const refreshPermissions = async () => {
    try {
      const token = localStorage.getItem('authToken');
      if (!token) return false;

      console.log('[UserContext] Refreshing permissions...');
      const permissionResult = await layThongTinQuyenHanNhanVien(token, currentUser?.userCode || currentUser?.taiKhoanDN);
      
      if (permissionResult.success) {
        setCurrentUser(prev => ({
          ...prev,
          ...permissionResult.data
        }));
        setPermissions(permissionResult.data.permissions);
        console.log('[UserContext] Permissions refreshed');
        return true;
      } else {
        console.warn('[UserContext] Failed to refresh permissions');
        return false;
      }
    } catch (error) {
      console.error('[UserContext] Error refreshing permissions:', error);
      return false;
    }
  };

  const value = {
    currentUser,
    permissions,
    isLoading,
    login,
    logout,
    hasPermission,
    isAdmin,
    refreshPermissions
  };

  return (
    <UserContext.Provider value={value}>
      {children}
    </UserContext.Provider>
  );
};

export const useUser = () => {
  const context = useContext(UserContext);
  if (context === undefined) {
    throw new Error('useUser must be used within a UserProvider');
  }
  return context;
};

export default UserContext; 