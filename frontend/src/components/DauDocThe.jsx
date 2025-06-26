"use client"

import React, { useRef, useState, useEffect, useCallback } from "react"

// Add immediate console log
console.log("🚀 DauDocThe.jsx file loaded at", new Date().toISOString())

const DauDocThe = React.forwardRef((props, ref) => {
  console.log("🔥 DauDocThe component function called")

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

  console.log("📊 DauDocThe initial state:", {
    isRunning,
    isScanning,
    cardBuffer,
    ui: !!ui,
    vehicleManager: !!vehicleManager,
    cameraManager: !!cameraManager,
  })

  // Set UI reference
  const setUIReference = useCallback((uiRef) => {
    console.log("🔗 DauDocThe: Setting UI Reference")
    console.log("📋 UI Reference received:", uiRef)
    setUi(uiRef)
    setVehicleManager(uiRef?.vehicleManager)
    setCameraManager(uiRef?.cameraManager)
    console.log("✅ UI Reference set successfully")
  }, [])

  // Handle keyboard events for RFID card reading
  const handleKeyDown = useCallback(
    (event) => {
      console.log("⌨️ KEYBOARD EVENT:", {
        key: event.key,
        code: event.code,
        target: event.target.tagName,
        isRunning: isRunningRef.current,
        isScanning: isScanningRef.current,
        timestamp: new Date().toISOString(),
      })

      if (!isRunningRef.current) {
        console.log("❌ Card reader not running, ignoring key")
        return
      }

      // Skip if focus is on input elements
      const activeElement = document.activeElement
      if (
        activeElement &&
        (activeElement.tagName === "INPUT" || activeElement.tagName === "TEXTAREA" || activeElement.isContentEditable)
      ) {
        console.log("🚫 Focus on input element, ignoring key:", activeElement.tagName)
        return
      }

      const currentTime = Date.now()
      const timeDiff = currentTime - lastKeyTime.current

      console.log("⏰ Timing info:", {
        currentTime,
        lastKeyTime: lastKeyTime.current,
        timeDifference: timeDiff,
        timeout: CARD_TIMEOUT,
      })

      // If too much time has passed, reset buffer (new card scan)
      if (timeDiff > CARD_TIMEOUT) {
        console.log("🔄 Timeout exceeded, resetting buffer. Old buffer:", keyboardBuffer.current)
        keyboardBuffer.current = ""
      }

      lastKeyTime.current = currentTime

      // Handle Enter key (end of card scan)
      if (event.key === "Enter") {
        console.log("🎯 ENTER KEY DETECTED!")
        console.log("📝 Current buffer content:", keyboardBuffer.current)
        console.log("🔍 Is scanning:", isScanningRef.current)

        event.preventDefault()

        if (keyboardBuffer.current && (!isScanningRef.current || keyboardBuffer.current !== currentCardIdRef.current)) {
          const cardId = keyboardBuffer.current.trim()
          console.log("🏷️ Card ID extracted:", cardId)
          console.log("📏 Card ID length:", cardId.length)

          if (cardId.length > 0) {
            console.log("🚨 *** RFID CARD DETECTED: " + cardId + " ***")
            console.log("🔄 Starting card processing...")
            currentCardIdRef.current = cardId
            processCardScan(cardId)
          } else {
            console.log("⚠️ Empty card ID, ignoring")
          }
        } else {
          console.log("❌ Cannot process:", {
            hasBuffer: !!keyboardBuffer.current,
            isScanning: isScanningRef.current,
          })
        }

        keyboardBuffer.current = ""
        console.log("🧹 Buffer cleared")
        currentCardIdRef.current = null
        return
      }

      // Handle regular characters (accumulate card ID)
      if (event.key.length === 1 && /[0-9A-Za-z]/.test(event.key)) {
        keyboardBuffer.current += event.key
        console.log("📝 Building card ID:", keyboardBuffer.current)
        console.log("📊 Buffer length:", keyboardBuffer.current.length)
      } else {
        console.log("🚫 Invalid character ignored:", event.key)
      }
    },
    [],
  )

  // Start card reader
  const startCardReader = useCallback(() => {
    console.log("🚀 *** STARTING RFID CARD READER ***")
    console.log("📅 Start time:", new Date().toISOString())

    setIsRunning(true)
    isRunningRef.current = true
    console.log("✅ Card reader status: RUNNING")

    // Add keyboard event listener for card reading
    document.addEventListener("keydown", handleKeyDown, true)
    console.log("👂 Keyboard event listener added with capture=true")

    // Try to connect to serial port for RFID reader
    connectSerialPort()

    console.log("🎯 Card reader startup complete")
  }, [handleKeyDown])

  // Stop card reader
  const stopCardReader = useCallback(() => {
    console.log("🛑 *** STOPPING RFID CARD READER ***")
    console.log("📅 Stop time:", new Date().toISOString())

    setIsRunning(false)
    isRunningRef.current = false
    console.log("❌ Card reader status: STOPPED")

    // Remove keyboard event listener
    document.removeEventListener("keydown", handleKeyDown, true)
    console.log("🔇 Keyboard event listener removed")

    // Close serial port if connected
    if (serialPort) {
      serialPort.close()
      setSerialPort(null)
      console.log("🔌 Serial port closed")
    }

    // Clear any ongoing operations
    keyboardBuffer.current = ""
    setIsScanning(false)
    isScanningRef.current = false
    console.log("🧹 All buffers and states cleared")
  }, [handleKeyDown, serialPort])

  // Connect to serial port for RFID reader
  const connectSerialPort = async () => {
    console.log("🔌 Attempting Serial Port Connection...")
    try {
      if ("serial" in navigator) {
        console.log("✅ Serial API available in browser")
        // Don't actually request port to avoid popup
        console.log("⏭️ Skipping serial port request (using keyboard mode)")
      } else {
        console.log("❌ Serial API not available in this browser")
      }
    } catch (error) {
      console.log("⚠️ Serial port connection failed:", error.message)
    }
    console.log("⌨️ Using keyboard input mode for RFID cards")
  }

  // Reset scanning state
  const resetScanningState = useCallback(() => {
    console.log("🔄 *** RESETTING SCANNING STATE ***")
    console.log("📊 Previous state:", { isScanning, cardBuffer })

    setIsScanning(false)
    setCardBuffer("")
    keyboardBuffer.current = ""
    isScanningRef.current = false

    console.log("✅ Scanning state reset complete")
  }, [isScanning, cardBuffer])

  // Check if card exists in database
  const checkCardExists = async (cardId) => {
    console.log("🔍 *** CHECKING CARD EXISTENCE ***")
    console.log("🏷️ Card ID to check:", cardId)

    try {
      console.log("📦 Importing API module...")
      const { layDanhSachThe } = await import("../api/api")
      console.log("✅ API module imported successfully")

      console.log("🌐 Calling layDanhSachThe API...")
      const cardList = await layDanhSachThe()
      console.log("📋 API Response:", cardList)
      console.log("📊 Response type:", typeof cardList)
      console.log("📏 Response length:", Array.isArray(cardList) ? cardList.length : "Not array")

      if (cardList && Array.isArray(cardList)) {
        console.log("🔍 Searching for card in list...")
        console.log("🎯 Looking for uidThe =", cardId)

        const cardExists = cardList.find((card) => {
          console.log("🔍 Checking card:", card)
          return card.uidThe === cardId
        })

        console.log("🎯 Search result:", cardExists)
        console.log("✅ Card exists:", !!cardExists)
        return !!cardExists
      } else {
        console.log("❌ Invalid card list format or empty response")
        return false
      }
    } catch (error) {
      console.error("💥 Error checking card existence:", error)
      console.error("📋 Error stack:", error.stack)
      return false
    }
  }

  // Process card scan
  const processCardScan = useCallback(
    async (cardId) => {
      console.log("🎯 *** PROCESSING CARD SCAN ***")
      console.log("🏷️ Card ID:", cardId)
      console.log("📊 Current state:", { isScanning, isRunning })
      console.log("📅 Process start time:", new Date().toISOString())

      if (isScanningRef.current) {
        console.log("⚠️ Already scanning, ignoring this scan")
        return
      }

      try {
        console.log("🔄 Setting scanning state to true...")
        setIsScanning(true)
        isScanningRef.current = true
        console.log("✅ Scanning state updated")

        if (ui) {
          console.log("🎨 Updating UI status...")
          ui.updateCardReaderStatus && ui.updateCardReaderStatus(`Đang kiểm tra thẻ: ${cardId}...`, "#FF9800")
        } else {
          console.log("⚠️ No UI reference available")
        }

        // Check if card exists in database
        console.log("🔍 Starting card existence check...")
        const cardExists = await checkCardExists(cardId)
        console.log("🎯 Card existence result:", cardExists)

        if (cardExists) {
          console.log("✅ *** CARD EXISTS - PROCEEDING WITH IMAGE CAPTURE ***")
          alert(`Thẻ ${cardId} tồn tại! Đang chụp ảnh...`)

          // TODO: Add image capture logic here
          console.log("📸 Image capture would happen here")
        } else {
          console.log("❌ *** CARD NOT FOUND - SHOWING ADD DIALOG ***")

          if (ui) {
            ui.updateCardReaderStatus && ui.updateCardReaderStatus(`Thẻ ${cardId} chưa được đăng ký`, "#FF5722")
          }

          console.log("💬 Showing confirmation dialog...")
          const shouldAdd = window.confirm(
            `Thẻ ${cardId} chưa được đăng ký trong hệ thống.\n\nBạn có muốn thêm thẻ này không?`,
          )

          console.log("👤 User response to add card:", shouldAdd)

          if (shouldAdd) {
            console.log("➕ User wants to add card, showing add dialog...")
            // Show add card dialog through UI
            if (ui && ui.openAddCardDialog) {
              console.log("🎨 Opening add card dialog through UI...")
              ui.openAddCardDialog(cardId)
            } else {
              console.log("⚠️ No UI openAddCardDialog method, using fallback...")
              alert(`Sẽ mở dialog thêm thẻ cho: ${cardId}`)
            }
          } else {
            console.log("❌ User declined to add card")
          }
        }
      } catch (error) {
        console.error("💥 Error processing card scan:", error)
        console.error("📋 Error stack:", error.stack)

        if (ui) {
          ui.updateCardReaderStatus && ui.updateCardReaderStatus(`Lỗi xử lý thẻ: ${error.message}`, "#F44336")
        }
      } finally {
        console.log("🔄 Scheduling quick reset of scanning state (300ms)...")
        setTimeout(() => {
          console.log("⏰ Timeout reached, resetting scanning state...")
          resetScanningState()
          if (ui) {
            ui.updateCardReaderStatus && ui.updateCardReaderStatus("Sẵn sàng quét thẻ", "#4CAF50")
          }
          console.log("✅ Card processing complete")
        }, 0)
      }
    },
    [],
  )

  // Simulate card scan (for testing)
  const simulateCardScan = useCallback(
    (cardId) => {
      console.log("🧪 *** SIMULATING CARD SCAN ***")
      console.log("🏷️ Simulated Card ID:", cardId)
      console.log("📊 Current scanning state:", isScanningRef.current)

      if (!isScanningRef.current) {
        console.log("▶️ Starting simulated card processing...")
        processCardScan(cardId)
      } else {
        console.log("⚠️ Already scanning, simulation ignored")
      }
    },
    [],
  )

  // Component lifecycle effects
  useEffect(() => {
    console.log("🎬 *** DauDocThe Component Mounted ***")
    console.log("📅 Mount time:", new Date().toISOString())
    console.log("📊 Initial props:", props)

    return () => {
      console.log("💀 *** DauDocThe Component Unmounting ***")
      console.log("📅 Unmount time:", new Date().toISOString())
      stopCardReader()
    }
  }, [stopCardReader])

  // Watch state changes
  useEffect(() => {
    console.log("📊 State change - isRunning:", isRunningRef.current)
  }, [isRunningRef])

  useEffect(() => {
    console.log("📊 State change - isScanning:", isScanningRef.current)
  }, [isScanningRef])

  useEffect(() => {
    console.log("📊 State change - UI reference:", !!ui)
  }, [ui])

  // Keep refs in sync with state
  useEffect(() => { isScanningRef.current = isScanning }, [isScanning])
  useEffect(() => { isRunningRef.current = isRunning }, [isRunning])

  // Expose methods to parent component
  React.useImperativeHandle(ref, () => {
    console.log("🔗 Creating imperative handle with methods")
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

  console.log("🎨 *** DauDocThe Render ***")
  console.log("📊 Render state:", {
    isRunning: isRunningRef.current,
    isScanning: isScanningRef.current,
    hasUI: !!ui,
    timestamp: new Date().toISOString(),
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

console.log("✅ DauDocThe component definition complete")

export default DauDocThe
