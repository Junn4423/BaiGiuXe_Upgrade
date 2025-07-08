"use client"

import React, { useRef, useState, useEffect, useCallback } from "react"

const DauDocThe = React.forwardRef(({ currentMode: propCurrentMode }, ref) => {
  const [isRunning, setIsRunning] = useState(false)
  const [isScanning, setIsScanning] = useState(false)
  const isRunningRef = useRef(false)
  const isScanningRef = useRef(false)
  const [cardBuffer, setCardBuffer] = useState("")
  const [ui, setUi] = useState(null)
  const [vehicleManager, setVehicleManager] = useState(null)
  const [cameraManager, setCameraManager] = useState(null)
  const [serialPort, setSerialPort] = useState(null)

  const cardReaderThread = useRef(null)
  const keyboardBuffer = useRef("")
  const lastKeyTime = useRef(0)
  const currentCardIdRef = useRef(null)
  const CARD_TIMEOUT = 50 // ms between characters for card reading (reduced for faster scanning)



  // Set UI reference
  const setUIReference = useCallback((uiRef) => {
    setUi(uiRef)
    setVehicleManager(uiRef?.vehicleManager)
    setCameraManager(uiRef?.cameraManager)
  }, [])

  // Handle keyboard events for RFID card reading
  const handleKeyDown = useCallback(
    (event) => {
      if (!isRunningRef.current) {
        return
      }

      // Skip if focus is on input elements
      const activeElement = document.activeElement
      if (
        activeElement &&
        (activeElement.tagName === "INPUT" || activeElement.tagName === "TEXTAREA" || activeElement.isContentEditable)
      ) {
        return
      }

      // Skip if modifier keys are pressed
      if (event.ctrlKey || event.altKey || event.metaKey) {
        return
      }

      const currentTime = Date.now()
      const timeDiff = currentTime - lastKeyTime.current

      // If too much time has passed, reset buffer (new card scan)
      if (timeDiff > CARD_TIMEOUT) {
        keyboardBuffer.current = ""
        console.log(`🔄 Reset buffer due to timeout (${timeDiff}ms > ${CARD_TIMEOUT}ms)`)
      }

      lastKeyTime.current = currentTime

      // Handle Enter key (end of card scan)
      if (event.key === "Enter") {
        event.preventDefault()

        const cardId = keyboardBuffer.current.trim()
        
        // Validate card ID format (should be numeric and reasonable length)
        if (cardId && cardId.length >= 6 && cardId.length <= 20 && /^\d+$/.test(cardId)) {
          // Prevent duplicate processing of the same card within short time
          if (!isScanningRef.current || cardId !== currentCardIdRef.current) {
            console.log(`✅ RFID CARD DETECTED: ${cardId} (length: ${cardId.length})`)
            currentCardIdRef.current = cardId
            processCardScan(cardId)
          } else {
            console.log(`⚠️ Ignoring duplicate card scan: ${cardId}`)
          }
        } else if (cardId) {
          console.log(`❌ Invalid card ID format: ${cardId} (length: ${cardId.length})`)
          // Clear invalid data
          keyboardBuffer.current = ""
          
          if (ui) {
            ui.updateCardReaderStatus && ui.updateCardReaderStatus("Định dạng thẻ không hợp lệ", "#F44336")
            setTimeout(() => {
              ui.updateCardReaderStatus && ui.updateCardReaderStatus("Sẵn sàng quét thẻ", "#4CAF50")
            }, 2000)
          }
        }

        keyboardBuffer.current = ""
        currentCardIdRef.current = null
        return
      }

      // Handle regular characters (accumulate card ID) - only digits
      if (event.key.length === 1 && /^\d$/.test(event.key)) {
        keyboardBuffer.current += event.key
        
        // Limit buffer size to prevent memory issues
        if (keyboardBuffer.current.length > 25) {
          console.log(`⚠️ Buffer too long, resetting: ${keyboardBuffer.current}`)
          keyboardBuffer.current = ""
        }
      } else if (event.key.length === 1) {
        // Log non-digit characters for debugging
        console.log(`🔍 Ignoring non-digit character: ${event.key}`)
      }
    },
    [],
  )

  // Start card reader
  const startCardReader = useCallback(() => {
    console.log("Starting RFID card reader")
    setIsRunning(true)
    isRunningRef.current = true
    
    // Add keyboard event listener for card reading
    document.addEventListener("keydown", handleKeyDown, true)
    
    // Try to connect to serial port for RFID reader
    connectSerialPort()
  }, [handleKeyDown])

  // Stop card reader
  const stopCardReader = useCallback(() => {
    console.log("Stopping RFID card reader")
    setIsRunning(false)
    isRunningRef.current = false
    
    // Remove keyboard event listener
    document.removeEventListener("keydown", handleKeyDown, true)
    
    // Close serial port if connected
    if (serialPort) {
      serialPort.close()
      setSerialPort(null)
    }

    // Clear any ongoing operations
    keyboardBuffer.current = ""
    setIsScanning(false)
    isScanningRef.current = false
  }, [handleKeyDown, serialPort])

  // Connect to serial port for RFID reader
  const connectSerialPort = async () => {
    try {
      if ("serial" in navigator) {
        // Don't actually request port to avoid popup
        console.log("Using keyboard input mode for RFID cards")
      }
    } catch (error) {
      console.log("Serial port connection failed:", error.message)
    }
  }

  // Reset scanning state
  const resetScanningState = useCallback(() => {
    setIsScanning(false)
    setCardBuffer("")
    keyboardBuffer.current = ""
    isScanningRef.current = false
  }, [])

  // Check if card exists in database
  const checkCardExists = async (cardId) => {
    console.log("Checking card existence:", cardId)

    try {
      const { layDanhSachThe } = await import("../api/api")
      const cardList = await layDanhSachThe()

      if (cardList && Array.isArray(cardList)) {
        const cardExists = cardList.find((card) => card.uidThe === cardId)
        return !!cardExists
      } else {
        console.log("Invalid card list format or empty response")
        return false
      }
    } catch (error) {
      console.error("Error checking card existence:", error)
      return false
    }
  }

  // Check if card has active parking session
  const checkActiveSession = async (cardId) => {
    console.log("Checking active session for card:", cardId)

    try {
      const { timTheDangCoPhien } = await import("../api/api")
      const activeSession = await timTheDangCoPhien(cardId)
      
      // Return true if card has active session
      return activeSession && Array.isArray(activeSession) && activeSession.length > 0
    } catch (error) {
      console.error("Error checking active session:", error)
      return false
    }
  }

  // Process card scan
  const processCardScan = useCallback(
    async (cardId) => {
      if (isScanningRef.current) {
        console.log(`⚠️ Card reader busy, ignoring duplicate scan: ${cardId}`)
        return
      }

      try {
        setIsScanning(true)
        isScanningRef.current = true

        if (ui) {
          ui.updateCardReaderStatus && ui.updateCardReaderStatus(`Đang xử lý thẻ: ${cardId}...`, "#FF9800")
        }

        // Validate UI reference
        if (!ui) {
          console.error(`❌ UI reference is null, cannot proceed with card processing`)
          return
        }

        // Determine current mode (vao/ra) - prioritize UI reference as it's more reliable
        const currentMode = ui.currentMode || propCurrentMode || "vao"
        console.log(`🎯 Processing card ${cardId} in mode: ${currentMode}`)
        console.log(`🔍 Mode source: ui.currentMode=${ui.currentMode}, propCurrentMode=${propCurrentMode}`)
        console.log(`🔍 Mode detection priority: ui.currentMode (${ui.currentMode}) -> propCurrentMode (${propCurrentMode}) -> default (vao)`)
        
        // Additional validation for mode consistency
        if (ui.currentMode && propCurrentMode && ui.currentMode !== propCurrentMode) {
          console.warn(`⚠️ Mode mismatch detected! UI mode: ${ui.currentMode}, Prop mode: ${propCurrentMode}`)
        }

        // Check if card exists in database
        const cardExists = await checkCardExists(cardId)
        console.log(`📋 Card ${cardId} exists in database: ${cardExists}`)

        if (!cardExists) {
          console.log(`❌ Card ${cardId} not found in database`)
          if (ui) {
            ui.updateCardReaderStatus && ui.updateCardReaderStatus(`Thẻ ${cardId} chưa được đăng ký`, "#F44336")
          }
          
          // For entry mode, still allow processing but show warning
          if (currentMode === "vao") {
            console.log(`⚠️ Allowing unregistered card entry for card ${cardId}`)
            if (ui && ui.handleCardScanned) {
              ui.handleCardScanned(cardId)
            }
            return
          } else {
            // For exit mode, reject unregistered cards
            console.log(`🚫 Rejecting unregistered card exit for card ${cardId}`)
            if (ui) {
              ui.updateCardReaderStatus && ui.updateCardReaderStatus(`Thẻ chưa đăng ký - Không thể ra`, "#F44336")
            }
            return
          }
        }

        // Card exists - check mode-specific logic
        if (currentMode === "vao") {
          // Entry mode: Check if card already has active session
          console.log(`🚪 Entry mode - checking for existing session for card ${cardId}`)
          const hasActiveSession = await checkActiveSession(cardId)
          
          if (hasActiveSession) {
            console.log(`⚠️ Card ${cardId} already has active parking session`)
            if (ui) {
              ui.updateCardReaderStatus && ui.updateCardReaderStatus(`Thẻ ${cardId} đã có phiên gửi xe`, "#F44336")
            }
            return
          }
          
          console.log(`✅ Card ${cardId} is ready for entry`)
          if (ui) {
            ui.updateCardReaderStatus && ui.updateCardReaderStatus(`Thẻ hợp lệ - Đang chụp ảnh xe vào...`, "#FF9800")
          }
          
          // Validate required UI data for entry
          if (!ui) {
            console.error(`❌ UI reference is null, cannot proceed with entry`)
            return
          }
          
          if (!ui.currentVehicleType) {
            console.warn(`⚠️ Missing vehicle type, using default`)
          }
          if (!ui.workConfig?.zone) {
            console.warn(`⚠️ Missing work zone configuration`)
          }
          
          // Log work configuration for debugging
          console.log(`📋 Work Config for entry:`, {
            vehicleType: ui?.currentVehicleType || 'unknown',
            zone: ui?.workConfig?.zone || 'unknown',
            zoneData: ui?.workConfig?.zone_data || 'unknown'
          })
          
        } else if (currentMode === "ra") {
          // Exit mode: Check if card has active session
          console.log(`🚪 Exit mode - checking for active session for card ${cardId}`)
          const hasActiveSession = await checkActiveSession(cardId)
          
          if (!hasActiveSession) {
            console.log(`❌ Card ${cardId} has no active parking session`)
            if (ui) {
              ui.updateCardReaderStatus && ui.updateCardReaderStatus(`Thẻ ${cardId} không có phiên gửi xe`, "#F44336")
            }
            return
          }
          
          console.log(`✅ Card ${cardId} has active session - ready for exit`)
          if (ui) {
            ui.updateCardReaderStatus && ui.updateCardReaderStatus(`Thẻ hợp lệ - Đang chụp ảnh xe ra...`, "#FF9800")
          }
        }

        // Proceed with image capture and processing
        if (ui && ui.handleCardScanned) {
          ui.handleCardScanned(cardId)
        }

      } catch (error) {
        console.error("❌ Error processing card scan:", error)

        if (ui) {
          ui.updateCardReaderStatus && ui.updateCardReaderStatus(`Lỗi xử lý thẻ: ${error.message}`, "#F44336")
        }
      } finally {
        // Reset scanning state after processing
        setTimeout(() => {
          resetScanningState()
          if (ui) {
            ui.updateCardReaderStatus && ui.updateCardReaderStatus("Sẵn sàng quét thẻ", "#4CAF50")
          }
        }, 2000) // Give user time to see the result
      }
    },
    [],
  )

  // Simulate card scan (for testing)
  const simulateCardScan = useCallback(
    (cardId) => {
      if (!isScanningRef.current) {
        console.log(`🧪 Simulating card scan: ${cardId}`)
        processCardScan(cardId)
      } else {
        console.log(`⚠️ Cannot simulate card scan, reader is busy`)
      }
    },
    [],
  )

  // Get current card reader status
  const getCardReaderStatus = useCallback(() => {
    return {
      isRunning: isRunningRef.current,
      isScanning: isScanningRef.current,
      currentBuffer: keyboardBuffer.current,
      lastScanTime: lastKeyTime.current,
      currentCardId: currentCardIdRef.current
    }
  }, [])

  // Force reset card reader state
  const forceReset = useCallback(() => {
    console.log(`🔄 Force resetting card reader state`)
    keyboardBuffer.current = ""
    currentCardIdRef.current = null
    resetScanningState()
    
    if (ui) {
      ui.updateCardReaderStatus && ui.updateCardReaderStatus("Đã reset - Sẵn sàng quét thẻ", "#4CAF50")
    }
  }, [])

  // Component lifecycle effects
  useEffect(() => {
    return () => {
      stopCardReader()
    }
  }, [stopCardReader])

  // Keep refs in sync with state
  useEffect(() => { isScanningRef.current = isScanning }, [isScanning])
  useEffect(() => { isRunningRef.current = isRunning }, [isRunning])

  // Expose methods to parent component
  React.useImperativeHandle(ref, () => {
    return {
      startCardReader,
      stopCardReader,
      setUIReference,
      simulateCardScan,
      processCardScan,
      resetScanningState,
      getCardReaderStatus,
      forceReset,
      checkCardExists,
      checkActiveSession,
      isRunning: isRunningRef.current,
      isScanning: isScanningRef.current,
    }
  })


  return (
    <div style={{ display: "none" }}>
      {/* RFID Card Reader Logic - No visible UI */}
      <div>
        Status: {isRunningRef.current ? "RUNNING" : "STOPPED"} | 
        Scanning: {isScanningRef.current ? "PROCESSING" : "READY"} |
        Buffer: "{keyboardBuffer.current}" |
        Last Card: {currentCardIdRef.current || "None"}
      </div>
    </div>
  )
})

DauDocThe.displayName = "DauDocThe"

export default DauDocThe
