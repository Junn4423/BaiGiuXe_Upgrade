"use client"

import React, { useRef, useState, useEffect, useCallback } from "react"

const DauDocThe = React.forwardRef((props, ref) => {
  const [isRunning, setIsRunning] = useState(false)
  const [isScanning, setIsScanning] = useState(false)
  const [cardBuffer, setCardBuffer] = useState("")
  const [ui, setUi] = useState(null)
  const [vehicleManager, setVehicleManager] = useState(null)
  const [cameraManager, setCameraManager] = useState(null)
  const [serialPort, setSerialPort] = useState(null)

  const cardReaderThread = useRef(null)
  const keyboardBuffer = useRef("")
  const lastKeyTime = useRef(0)
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
      if (!isRunning) return

      const currentTime = Date.now()

      // If too much time has passed, reset buffer (new card scan)
      if (currentTime - lastKeyTime.current > CARD_TIMEOUT) {
        keyboardBuffer.current = ""
      }

      lastKeyTime.current = currentTime

      // Handle Enter key (end of card scan)
      if (event.key === "Enter") {
        event.preventDefault()
        if (keyboardBuffer.current && !isScanning) {
          const cardId = keyboardBuffer.current.trim()
          if (cardId.length > 0) {
            console.log(`Card scanned: ${cardId}`)
            processCardScan(cardId)
          }
        }
        keyboardBuffer.current = ""
        return
      }

      // Handle regular characters (accumulate card ID)
      if (event.key.length === 1 && /[0-9A-Za-z]/.test(event.key)) {
        keyboardBuffer.current += event.key
      }
    },
    [isRunning, isScanning],
  )

  // Start card reader
  const startCardReader = useCallback(() => {
    setIsRunning(true)
    console.log("Starting RFID card reader...")

    // Add keyboard event listener for card reading
    document.addEventListener("keydown", handleKeyDown, true)

    // Try to connect to serial port for RFID reader
    connectSerialPort()
  }, [handleKeyDown])

  // Stop card reader
  const stopCardReader = useCallback(() => {
    setIsRunning(false)
    console.log("Stopping RFID card reader...")

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
  }, [handleKeyDown, serialPort])

  // Connect to serial port for RFID reader
  const connectSerialPort = async () => {
    try {
      if ("serial" in navigator) {
        // Request serial port access
        const port = await navigator.serial.requestPort()
        await port.open({ baudRate: 9600 })
        setSerialPort(port)

        console.log("Serial port connected for RFID reader")

        // Start reading from serial port
        readFromSerialPort(port)
      }
    } catch (error) {
      console.log("Serial port not available or access denied:", error.message)
      console.log("Falling back to keyboard input for RFID cards")
    }
  }

  // Read data from serial port
  const readFromSerialPort = async (port) => {
    try {
      const reader = port.readable.getReader()

      while (isRunning && port.readable) {
        const { value, done } = await reader.read()
        if (done) break

        // Convert bytes to string
        const cardData = new TextDecoder().decode(value).trim()
        if (cardData && !isScanning) {
          console.log(`Card read from serial: ${cardData}`)
          processCardScan(cardData)
        }
      }

      reader.releaseLock()
    } catch (error) {
      console.error("Error reading from serial port:", error)
    }
  }

  // Reset scanning state
  const resetScanningState = useCallback(() => {
    setIsScanning(false)
    setCardBuffer("")
    keyboardBuffer.current = ""
  }, [])

  // Process card scan
  const processCardScan = useCallback(
    async (cardId) => {
      if (isScanning) return // Prevent multiple simultaneous scans

      try {
        setIsScanning(true)
        console.log(`Processing card: ${cardId}`)

        if (ui) {
          ui.updateCardReaderStatus(`Đang xử lý thẻ: ${cardId}...`, "#f39c12")
        }

        if (ui && cameraManager && vehicleManager) {
          const currentMode = ui.currentMode || "vao"
          const zone = ui.currentZone

          if (!zone) {
            console.log("Không có khu hiện tại!")
            if (ui) {
              ui.updateCardReaderStatus("Lỗi: Không có khu hiện tại", "#e74c3c")
            }
            return
          }

          if (currentMode === "vao") {
            // Process vehicle entry
            const entryGateStr = zone.congVao && zone.congVao.length > 0 ? zone.congVao[0].maCong : "N/A"
            const cameraId = zone.cameraVao && zone.cameraVao.length > 0 ? zone.cameraVao[0].maCamera : "N/A"

            const [capturedFrame, licensePlate, faceImagePath] = await cameraManager.captureImage(cardId, "vao")
            console.log(`Entry - Image: ${capturedFrame}, License: ${licensePlate}, Face: ${faceImagePath}`)

            // Update license plate display
            if (licensePlate && ui) {
              ui.updateLicensePlateDisplay(licensePlate.toUpperCase())
            }

            if (!capturedFrame) {
              console.log("Lỗi: Không chụp được ảnh xe vào")
              if (ui) {
                ui.updateCardReaderStatus("Lỗi: Không chụp được ảnh xe vào", "#e74c3c")
              }
              return
            }

            // Process vehicle entry
            const result = await vehicleManager.processVehicleEntry(
              cardId,
              capturedFrame,
              licensePlate,
              null,
              entryGateStr,
              cameraId,
              faceImagePath,
            )

            // Handle card not found error
            if (result && typeof result === "object" && !result.success) {
              const message = result.message || "Có lỗi xảy ra"

              if (
                message.toLowerCase().includes("không tồn tại") ||
                message.toLowerCase().includes("chưa tồn tại") ||
                message.toLowerCase().includes("not found") ||
                message.toLowerCase().includes("không tìm thấy") ||
                message.toLowerCase().includes("not exist") ||
                message.toLowerCase().includes("does not exist")
              ) {
                if (ui) {
                  ui.updateCardReaderStatus(`Thẻ ${cardId} chưa được đăng ký`, "#f39c12")
                }

                // Ask user if they want to add the card
                const answer = window.confirm(
                  `Thẻ ${cardId} chưa được đăng ký trong hệ thống.\n\nBạn có muốn thêm thẻ này không?`,
                )

                if (answer) {
                  const addResult = await showAddCardDialog(cardId)

                  if (addResult === "success") {
                    if (ui) {
                      ui.updateCardReaderStatus(`Thẻ ${cardId} đã được thêm, đang xử lý lại...`, "#27ae60")
                    }
                    // Retry processing entry
                    await vehicleManager.processVehicleEntry(
                      cardId,
                      capturedFrame,
                      licensePlate,
                      null,
                      entryGateStr,
                      cameraId,
                      faceImagePath,
                    )
                  } else {
                    if (ui) {
                      ui.updateCardReaderStatus("Đã hủy thêm thẻ", "#95a5a6")
                    }
                  }
                } else {
                  if (ui) {
                    ui.updateCardReaderStatus("Từ chối thêm thẻ", "#95a5a6")
                  }
                }
              } else {
                if (ui) {
                  ui.showError("Lỗi xe vào", message)
                }
              }
            }
          } else {
            // Process vehicle exit
            const exitGateStr = zone.congRa && zone.congRa.length > 0 ? zone.congRa[0].maCong : "N/A"
            const cameraId = zone.cameraRa && zone.cameraRa.length > 0 ? zone.cameraRa[0].maCamera : "N/A"

            const [exitImagePath, exitLicensePlate, exitFaceImagePath] = await cameraManager.captureImage(cardId, "ra")
            console.log(`Exit - Image: ${exitImagePath}, License: ${exitLicensePlate}, Face: ${exitFaceImagePath}`)

            // Update license plate display
            if (exitLicensePlate && ui) {
              ui.updateLicensePlateDisplay(exitLicensePlate.toUpperCase())
            }

            if (!exitImagePath) {
              console.log("Lỗi: Không chụp được ảnh xe ra")
              if (ui) {
                ui.updateCardReaderStatus("Lỗi: Không chụp được ảnh xe ra", "#e74c3c")
              }
              return
            }

            const plateMatch = 1
            // Process vehicle exit
            const result = await vehicleManager.processVehicleExit(
              cardId,
              exitImagePath,
              exitGateStr,
              cameraId,
              plateMatch,
              exitLicensePlate,
              exitFaceImagePath,
            )

            // Handle card not found error for exit
            if (result && typeof result === "object" && !result.success) {
              const message = result.message || "Có lỗi xảy ra"

              if (
                message.toLowerCase().includes("không tồn tại") ||
                message.toLowerCase().includes("chưa tồn tại") ||
                message.toLowerCase().includes("not found") ||
                message.toLowerCase().includes("not exist") ||
                message.toLowerCase().includes("does not exist") ||
                message.toLowerCase().includes("không tìm thấy")
              ) {
                if (ui) {
                  ui.updateCardReaderStatus(`Thẻ ${cardId} chưa được đăng ký`, "#f39c12")
                }

                const answer = window.confirm(
                  `Thẻ ${cardId} chưa được đăng ký trong hệ thống.\n\nBạn có muốn thêm thẻ này không?`,
                )

                if (answer) {
                  const addResult = await showAddCardDialog(cardId)

                  if (addResult === "success") {
                    if (ui) {
                      ui.updateCardReaderStatus(`Thẻ ${cardId} đã được thêm thành công`, "#27ae60")
                    }
                  } else {
                    if (ui) {
                      ui.updateCardReaderStatus("Đã hủy thêm thẻ", "#95a5a6")
                    }
                  }
                } else {
                  if (ui) {
                    ui.updateCardReaderStatus("Từ chối thêm thẻ", "#95a5a6")
                  }
                }
              } else {
                if (ui) {
                  ui.showError("Lỗi xe ra", message)
                }
              }
            }
          }
        }
      } catch (error) {
        console.error(`Lỗi xử lý quét thẻ: ${error}`)
        if (ui) {
          ui.updateCardReaderStatus(`Lỗi xử lý thẻ: ${error.message}`, "#e74c3c")
        }
      } finally {
        resetScanningState()
      }
    },
    [isScanning, ui, cameraManager, vehicleManager, resetScanningState],
  )

  // Show add card dialog
  const showAddCardDialog = async (cardId) => {
    try {
      // Create a more sophisticated dialog
      const cardType = await new Promise((resolve) => {
        const modal = document.createElement("div")
        modal.style.cssText = `
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(0,0,0,0.5);
          display: flex;
          justify-content: center;
          align-items: center;
          z-index: 10000;
        `

        const dialog = document.createElement("div")
        dialog.style.cssText = `
          background: white;
          padding: 30px;
          border-radius: 10px;
          box-shadow: 0 4px 20px rgba(0,0,0,0.3);
          max-width: 400px;
          width: 90%;
        `

        dialog.innerHTML = `
          <h3 style="margin-top: 0; color: #333;">Thêm thẻ mới</h3>
          <p>Mã thẻ: <strong>${cardId}</strong></p>
          <div style="margin: 20px 0;">
            <label style="display: block; margin-bottom: 5px;">Loại thẻ:</label>
            <select id="cardTypeSelect" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
              <option value="Thẻ thường">Thẻ thường</option>
              <option value="Thẻ VIP">Thẻ VIP</option>
              <option value="Thẻ nhân viên">Thẻ nhân viên</option>
            </select>
          </div>
          <div style="text-align: right; margin-top: 20px;">
            <button id="cancelBtn" style="margin-right: 10px; padding: 8px 16px; border: 1px solid #ddd; background: #f5f5f5; border-radius: 4px; cursor: pointer;">Hủy</button>
            <button id="confirmBtn" style="padding: 8px 16px; border: none; background: #007bff; color: white; border-radius: 4px; cursor: pointer;">Thêm thẻ</button>
          </div>
        `

        modal.appendChild(dialog)
        document.body.appendChild(modal)

        const cancelBtn = dialog.querySelector("#cancelBtn")
        const confirmBtn = dialog.querySelector("#confirmBtn")
        const cardTypeSelect = dialog.querySelector("#cardTypeSelect")

        cancelBtn.onclick = () => {
          document.body.removeChild(modal)
          resolve(null)
        }

        confirmBtn.onclick = () => {
          const selectedType = cardTypeSelect.value
          document.body.removeChild(modal)
          resolve(selectedType)
        }

        // Focus on confirm button
        confirmBtn.focus()
      })

      if (cardType) {
        // Call API to add card
        const { themThe } = await import("../api/api")
        const result = await themThe(cardId, cardType, "1")

        if (result && result.success) {
          return "success"
        } else {
          window.alert("Lỗi thêm thẻ: " + (result?.message || "Unknown error"))
          return "error"
        }
      }
      return "cancel"
    } catch (error) {
      window.alert("Lỗi thêm thẻ: " + error.message)
      return "error"
    }
  }

  // Simulate card scan (for testing)
  const simulateCardScan = useCallback(
    (cardId) => {
      if (!isScanning) {
        console.log(`Simulating card scan: ${cardId}`)
        processCardScan(cardId)
      }
    },
    [isScanning, processCardScan],
  )

  // Cleanup on unmount
  useEffect(() => {
    return () => {
      stopCardReader()
    }
  }, [stopCardReader])

  // Expose methods to parent component
  React.useImperativeHandle(ref, () => ({
    startCardReader,
    stopCardReader,
    setUIReference,
    simulateCardScan,
    processCardScan,
    isRunning,
    isScanning,
  }))

  return (
    <div style={{ display: "none" }}>
      {/* RFID Card Reader Logic - No visible UI */}
      <div>
        Status: {isRunning ? "Running" : "Stopped"} | Scanning: {isScanning ? "Yes" : "No"}
      </div>
    </div>
  )
})

DauDocThe.displayName = "DauDocThe"

export default DauDocThe
