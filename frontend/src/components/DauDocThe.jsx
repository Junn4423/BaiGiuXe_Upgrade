"use client"

import React, { useRef, useState, useEffect, useCallback } from "react"

const DauDocThe = React.forwardRef((props, ref) => {
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
  const CARD_TIMEOUT = 100 // ms between characters for card reading



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

      const currentTime = Date.now()
      const timeDiff = currentTime - lastKeyTime.current

      // If too much time has passed, reset buffer (new card scan)
      if (timeDiff > CARD_TIMEOUT) {
        keyboardBuffer.current = ""
      }

      lastKeyTime.current = currentTime

      // Handle Enter key (end of card scan)
      if (event.key === "Enter") {
        event.preventDefault()

        if (keyboardBuffer.current && (!isScanningRef.current || keyboardBuffer.current !== currentCardIdRef.current)) {
          const cardId = keyboardBuffer.current.trim()

          if (cardId.length > 0) {
            console.log("RFID CARD DETECTED:", cardId)
            currentCardIdRef.current = cardId
            processCardScan(cardId)
          }
        }

        keyboardBuffer.current = ""
        currentCardIdRef.current = null
        return
      }

      // Handle regular characters (accumulate card ID)
      if (event.key.length === 1 && /[0-9A-Za-z]/.test(event.key)) {
        keyboardBuffer.current += event.key
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

  // Process card scan
  const processCardScan = useCallback(
    async (cardId) => {
      if (isScanningRef.current) {
        return
      }

      try {
        setIsScanning(true)
        isScanningRef.current = true

        if (ui) {
          ui.updateCardReaderStatus && ui.updateCardReaderStatus(`Đang kiểm tra thẻ: ${cardId}...`, "#FF9800")
        }

        // Check if card exists in database
        const cardExists = await checkCardExists(cardId)

        if (cardExists) {
          console.log("Card exists - proceeding with image capture")
          // Call UI's card scan handler to trigger image capture
          if (ui && ui.handleCardScanned) {
            ui.handleCardScanned(cardId)
          }
        } else {
          console.log("Card not found:", cardId)

          if (ui) {
            ui.updateCardReaderStatus && ui.updateCardReaderStatus(`Thẻ ${cardId} chưa được đăng ký - Đang chụp ảnh...`, "#FF9800")
          }

          // Vẫn chụp ảnh và hiển thị lên UI ngay cả khi thẻ chưa đăng ký
          if (ui && ui.handleCardScanned) {
            ui.handleCardScanned(cardId)
          }
        }
      } catch (error) {
        console.error("Error processing card scan:", error)

        if (ui) {
          ui.updateCardReaderStatus && ui.updateCardReaderStatus(`Lỗi xử lý thẻ: ${error.message}`, "#F44336")
        }
      } finally {
        setTimeout(() => {
          resetScanningState()
          if (ui) {
            ui.updateCardReaderStatus && ui.updateCardReaderStatus("Sẵn sàng quét thẻ", "#4CAF50")
          }
        }, 2000) // Tăng từ 100ms lên 2000ms để người dùng có thời gian xem ảnh
      }
    },
    [],
  )

  // Simulate card scan (for testing)
  const simulateCardScan = useCallback(
    (cardId) => {
      if (!isScanningRef.current) {
        processCardScan(cardId)
      }
    },
    [],
  )

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
      isRunning: isRunningRef.current,
      isScanning: isScanningRef.current,
    }
  })


  return (
    <div style={{ display: "none" }}>
      {/* RFID Card Reader Logic - No visible UI */}
      <div>
        Status: {isRunningRef.current ? "RUNNING" : "STOPPED"} | Scanning: {isScanningRef.current ? "PROCESSING" : "READY"}
      </div>
    </div>
  )
})

DauDocThe.displayName = "DauDocThe"

export default DauDocThe
