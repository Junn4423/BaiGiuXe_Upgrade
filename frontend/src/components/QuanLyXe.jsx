"use client"

import React, { useState } from "react"
import {
  themPhienGuiXe,
  loadPhienGuiXeTheoMaThe,
  capNhatPhienGuiXe,
  tinhPhiGuiXe,
  loadPhienGuiXeTheoMaThe_XeRa,
} from "../api/api"

const QuanLyXe = () => {
  const [activeParkingSessions, setActiveParkingSessions] = useState({})
  const [vehicles, setVehicles] = useState([])
  const [ui, setUi] = useState(null)

  // Process vehicle entry
  const processVehicleEntry = async (
    cardId,
    imagePath,
    licensePlate,
    policy,
    entryGate,
    cameraId,
    faceImagePath = null,
  ) => {
    // Auto-determine policy if not provided
    if (!policy && ui) {
      if (ui.currentMode === "vao") {
        if (ui.currentVehicleType === "xe_may") {
          policy = "CS_XEMAY_4H"
        } else if (ui.currentVehicleType === "oto") {
          policy = "CS_OTO_4H"
        }
      }
    }

    const entryTime = new Date().toISOString().slice(0, 19).replace("T", " ")
    const session = {
      uidThe: cardId,
      bienSo: licensePlate || "",
      viTriGui: null,
      chinhSach: policy,
      congVao: entryGate,
      gioVao: entryTime,
      anhVao: imagePath || "",
      anhMatVao: faceImagePath || "",
      camera_id: cameraId,
    }

    try {
      const apiResult = await themPhienGuiXe(session)

      let success = false
      let errorMessage = ""

      if (typeof apiResult === "object" && apiResult !== null) {
        success = apiResult.success || false
        errorMessage = apiResult.message || ""
      } else {
        success = Boolean(apiResult)
      }

      if (success) {
        setActiveParkingSessions((prev) => ({ ...prev, [cardId]: session }))

        // Update vehicle info in UI
        if (ui) {
          const vehicleEntryData = {
            bien_so: licensePlate || "",
            gio_vao: entryTime,
            gio_ra: "",
            ma_the: cardId,
            thoi_gian_do: "",
            phi: "",
            chinh_sach: policy || "",
            cong_vao: entryGate,
            cong_ra: "",
            trang_thai: "Trong bãi",
            loai_xe: ui.currentVehicleType || "xe_may",
          }
          ui.updateVehicleInfo(vehicleEntryData)
        }
      }

      if (ui) {
        ui.updateVehicleEntryStatus(cardId, licensePlate, success, errorMessage)
      }

      return success
        ? { success: true, message: "Xe vào thành công" }
        : { success: false, message: errorMessage || "Lỗi xe vào không xác định" }
    } catch (error) {
      console.error("Error processing vehicle entry:", error)
      return { success: false, message: error.message }
    }
  }

  // Process vehicle exit
  const processVehicleExit = async (
    cardId,
    exitImagePath,
    exitGate,
    cameraId,
    plateMatch = null,
    exitLicensePlate = null,
    exitFaceImagePath = null,
  ) => {
    console.log("Processing vehicle exit:", cardId, exitGate, cameraId, plateMatch, exitLicensePlate)

    try {
      // Step 1: Load parking session by card ID
      console.log(`🔍 DEBUG: Calling API loadPhienGuiXeTheoMaThe for card ID: ${cardId}`)
      const response = await loadPhienGuiXeTheoMaThe(cardId)

      console.log(`🔍 DEBUG: API Response type: ${typeof response}`)
      console.log(`🔍 DEBUG: API Response:`, response)

      // Process response from API
      let session = null
      if (Array.isArray(response) && response.length > 0) {
        session = response[0]
        console.log(`🔍 DEBUG: Got session from array:`, session)
      } else if (typeof response === "object" && response !== null) {
        if (response.success && response.data) {
          const data = response.data
          if (Array.isArray(data) && data.length > 0) {
            session = data[0]
          } else {
            session = data
          }
        } else {
          const msg = response.message || "Không tìm thấy phiên gửi xe"
          console.log(`❌ API returned error: ${msg}`)
          if (ui) {
            ui.updateVehicleExitStatus(cardId, "", false, msg)
          }
          return { success: false, message: msg }
        }
      } else {
        const msg = "Không tìm thấy phiên gửi xe hoặc format response không đúng"
        console.log(`❌ ${msg}`)
        if (ui) {
          ui.updateVehicleExitStatus(cardId, "", false, msg)
        }
        return { success: false, message: msg }
      }

      if (!session) {
        const msg = "Dữ liệu phiên gửi xe trống"
        console.log(`❌ ${msg}`)
        if (ui) {
          ui.updateVehicleExitStatus(cardId, "", false, msg)
        }
        return { success: false, message: msg }
      }

      console.log(`🔍 DEBUG: Session object:`, session)

      // Get information from session object
      const entryLicensePlate = session.bienSo || ""
      const entryImageUrl = session.anhVao || ""
      const sessionId = session.maPhien || ""

      console.log(`🔍 DEBUG: Entry license plate = '${entryLicensePlate}', Exit license plate = '${exitLicensePlate}'`)
      console.log(`🔍 DEBUG: Entry image URL = '${entryImageUrl}'`)
      console.log(`🔍 DEBUG: Session ID = '${sessionId}'`)

      // Display entry image immediately
      if (ui && entryImageUrl) {
        ui.displayEntryVehicleImageInConfirmation(entryImageUrl, entryLicensePlate, cardId)
      }

      // Check if license plates match
      const licensePlatesMatch = checkLicensePlateMatch(entryLicensePlate, exitLicensePlate)
      console.log(`🔍 DEBUG: License plate match result = ${licensePlatesMatch}`)

      if (!licensePlatesMatch && ui) {
        console.log("🚨 Displaying license plate error dialog")
        const dialogResult = await handleLicensePlateError(
          cardId,
          entryLicensePlate,
          exitLicensePlate,
          exitImagePath,
          exitFaceImagePath,
        )
        console.log(`🔍 DEBUG: Dialog result = ${dialogResult}`)

        if (typeof dialogResult === "string" && dialogResult.startsWith("xac_nhan:")) {
          exitLicensePlate = dialogResult.split(":", 2)[1]
          console.log(`🔍 DEBUG: New license plate from dialog = ${exitLicensePlate}`)
          const licensePlatesMatch = true // User confirmed
        } else if (dialogResult === "huy") {
          return { success: false, message: "Người dùng hủy bỏ" }
        } else {
          return { success: false, message: "Xử lý lỗi biển số thất bại" }
        }
      }

      // Step 2: Update parking session (vehicle exit)
      const currentTime = new Date()
      const sessionUpdate = {
        maPhien: sessionId,
        uidThe: cardId,
        bienSo: entryLicensePlate,
        viTriGui: session.viTriGui,
        chinhSach: session.chinhSach || "",
        congVao: session.congVao || "",
        gioVao: session.gioVao || "",
        anhVao: session.anhVao || "",
        anhMatVao: session.anhMatVao || "",
        trangThai: "DA_RA",
        congRa: exitGate,
        gioRa: currentTime.toISOString().slice(0, 19).replace("T", " "),
        anhRa: exitImagePath,
        anhMatRa: exitFaceImagePath || "",
        camera_id: cameraId,
        plate_match: licensePlatesMatch ? 1 : 0,
        plate: exitLicensePlate,
      }

      console.log(`🔍 DEBUG: Updating parking session:`, sessionUpdate)
      const apiResult = await capNhatPhienGuiXe(sessionUpdate)

      // Check API result
      let success = false
      let errorMessage = ""
      if (typeof apiResult === "object" && apiResult !== null) {
        success = apiResult.success || false
        errorMessage = apiResult.message || ""
      } else {
        success = Boolean(apiResult)
      }

      if (success) {
        console.log("✅ Vehicle exit update successful, calculating fee...")

        // Step 3: Calculate parking fee
        console.log(`🔍 DEBUG (QuanLyXe.processVehicleExit): Calling tinhPhiGuiXe for session ID: ${sessionId}`)
        const feeResult = await tinhPhiGuiXe(sessionId)
        console.log(`🔍 DEBUG (QuanLyXe.processVehicleExit): Fee calculation result:`, feeResult)

        let calculatedFee = null
        if (feeResult && feeResult.success) {
          calculatedFee = feeResult.phi || 0
          console.log(`✅ Fee calculation successful: ${calculatedFee}`)
        } else {
          console.log(`⚠️ Fee calculation error: ${feeResult?.message}`)
        }

        // Step 4: Load and display complete data from server
        await loadAndDisplayVehicleExitData(
          cardId,
          calculatedFee,
          currentTime.toISOString().slice(0, 19).replace("T", " "),
        )

        console.log(`🔍 DEBUG (QuanLyXe.processVehicleExit): Completed vehicle exit processing for card ID ${cardId}.`)

        return { success: true, message: "Xe ra thành công" }
      } else {
        const msg = errorMessage || "Lỗi cập nhật phiên gửi xe"
        if (ui) {
          ui.updateVehicleExitStatus(cardId, entryLicensePlate, false, msg)
        }
        return { success: false, message: msg }
      }
    } catch (error) {
      console.log(`❌ Vehicle exit processing error: ${error}`)
      console.error(error)
      if (ui) {
        ui.updateVehicleExitStatus(cardId, "", false, error.message)
      }
      return { success: false, message: error.message }
    }
  }

  // Load and display vehicle exit data
  const loadAndDisplayVehicleExitData = async (cardId, calculatedFee = null, actualExitTime = null) => {
    try {
      console.log(`🔍 DEBUG: Starting to load complete data for card ID ${cardId}`)
      console.log(`🔍 DEBUG: Calculated fee passed in: ${calculatedFee}, Actual exit time passed in: ${actualExitTime}`)

      // Call API to get parking session data
      const response = await loadPhienGuiXeTheoMaThe_XeRa(cardId)

      // Process response
      let session = null
      if (Array.isArray(response) && response.length > 0) {
        session = response[0]
      } else if (typeof response === "object" && response !== null) {
        if (response.success && response.data) {
          const data = response.data
          if (Array.isArray(data) && data.length > 0) {
            session = data[0]
          } else {
            session = data
          }
        } else {
          const msg = response.message || "Lỗi load dữ liệu từ server"
          console.log(`❌ Load data failed: ${msg}`)
          if (ui) {
            ui.updateVehicleExitStatus(cardId, "", false, msg)
          }
          return
        }
      } else {
        const msg = "Không có response từ server hoặc format không đúng"
        console.log(`❌ Load data failed: ${msg}`)
        if (ui) {
          ui.updateVehicleExitStatus(cardId, "", false, msg)
        }
        return
      }

      if (!session) {
        console.log("❌ Không tìm thấy phiên gửi xe")
        if (ui) {
          ui.updateVehicleExitStatus(cardId, "", false, "Không tìm thấy phiên gửi xe")
        }
        return
      }

      console.log(`🔍 DEBUG: Session object received:`, session)

      // Convert session object to UI format
      const vehicleData = convertSessionObjectToUI(session, calculatedFee, actualExitTime)
      console.log(`🔍 DEBUG (QuanLyXe.loadAndDisplayVehicleExitData): UI data created:`, vehicleData)

      if (ui) {
        console.log(`🔍 DEBUG: Updating UI with data:`, vehicleData)

        // Update vehicle info in UI
        ui.updateVehicleInfo(vehicleData)

        // Update vehicle list
        updateVehicleInList(vehicleData)
        ui.updateVehicleList(vehicleData, false)

        // Update status to success
        ui.updateVehicleExitStatus(cardId, vehicleData.bien_so, true, "Xe ra thành công")

        // **DISPLAY ENTRY IMAGES AFTER SUCCESSFUL EXIT**
        // Get entry image and face image URLs from session
        const entryImageUrl = session.anhVao || ""
        const entryFaceUrl = session.anhMatVao || ""

        console.log(
          `🎯 Calling display entry images after successful exit - Vehicle: ${entryImageUrl}, Face: ${entryFaceUrl}`,
        )

        // Call method to display entry images on camera frames
        ui.displayEntryImagesAfterExit(entryImageUrl, entryFaceUrl)

        // Set timer to restore camera after 3 seconds
        setTimeout(() => {
          if (ui.restoreLiveCameraFeeds) {
            ui.restoreLiveCameraFeeds()
          }
        }, 3000)

        console.log(`✅ Loaded and displayed complete data for card ID ${cardId}`)
      }
    } catch (error) {
      console.log(`❌ Error loading and displaying data: ${error}`)
      console.error(error)
      if (ui) {
        ui.updateVehicleExitStatus(cardId, "", false, `Lỗi load dữ liệu: ${error.message}`)
      }
    }
  }

  // Convert session object to UI format
  const convertSessionObjectToUI = (session, overrideFee = null, overrideExitTime = null) => {
    try {
      // Get data from session object
      const entryTimeStr = session.gioVao || ""
      const exitTimeStr = overrideExitTime !== null ? overrideExitTime : session.gioRa || ""
      const licensePlate = session.bienSo || ""
      const cardId = session.uidThe || ""
      const policy = session.chinhSach || ""
      const entryGate = session.congVao || ""
      const exitGate = session.congRa || ""
      const feeValue = overrideFee !== null ? overrideFee : session.phi || ""

      console.log(`🔍 DEBUG (QuanLyXe.convertSessionObjectToUI): Extracted 'feeValue': ${feeValue}`)

      console.log(`🔍 DEBUG: Extracted data from session:`)
      console.log(`  - License plate: ${licensePlate}`)
      console.log(`  - Entry time: ${entryTimeStr}`)
      console.log(`  - Exit time: ${exitTimeStr}`)
      console.log(`  - Fee: ${feeValue}`)

      // Calculate parking duration
      let parkingDurationFormatted = ""
      if (entryTimeStr && exitTimeStr) {
        try {
          const entryTime = new Date(entryTimeStr)
          const exitTime = new Date(exitTimeStr)
          const duration = exitTime - entryTime

          const hours = Math.floor(duration / (1000 * 60 * 60))
          const minutes = Math.floor((duration % (1000 * 60 * 60)) / (1000 * 60))
          parkingDurationFormatted = `${hours}h ${minutes}m`
        } catch (e) {
          console.log(`⚠️ Error calculating parking duration: ${e}`)
          parkingDurationFormatted = "N/A"
        }
      }

      // Format fee
      let feeFormatted = ""
      if (feeValue) {
        try {
          const fee = Number.parseInt(feeValue)
          feeFormatted = `${fee.toLocaleString()} VND`
        } catch {
          feeFormatted = String(feeValue)
        }
      }

      // Determine vehicle type
      let vehicleType = "xe_may" // default
      if (
        policy &&
        (policy.toLowerCase().includes("oto") || policy.toLowerCase().includes("xe_hoi") || policy.includes("CS_OTO"))
      ) {
        vehicleType = "oto"
      }

      // Create UI data
      const vehicleData = {
        bien_so: licensePlate,
        gio_vao: entryTimeStr,
        gio_ra: exitTimeStr,
        ma_the: cardId,
        thoi_gian_do: parkingDurationFormatted,
        phi: feeFormatted,
        cong_vao: entryGate,
        cong_ra: exitGate,
        chinh_sach: policy,
        trang_thai: exitTimeStr ? "Đã ra" : "Trong bãi",
        loai_xe: vehicleType,
        nhan_dien_boi_api: (session.plate_match || 0) === 1,
        da_xac_minh: true,
      }

      console.log(`🔍 DEBUG (QuanLyXe.convertSessionObjectToUI): UI data created:`, vehicleData)
      return vehicleData
    } catch (error) {
      console.log(`❌ Error converting session object: ${error}`)
      console.error(error)

      // Fallback data
      return {
        bien_so: session.bienSo || "",
        gio_vao: session.gioVao || "",
        gio_ra: session.gioRa || "",
        ma_the: session.uidThe || "",
        thoi_gian_do: "",
        phi: "",
        cong_vao: session.congVao || "",
        cong_ra: session.congRa || "",
        chinh_sach: session.chinhSach || "",
        trang_thai: "Lỗi dữ liệu",
        loai_xe: "xe_may",
        nhan_dien_boi_api: false,
        da_xac_minh: false,
      }
    }
  }

  // Check license plate match
  const checkLicensePlateMatch = (entryPlate, exitPlate) => {
    if (!entryPlate || !exitPlate) {
      return false
    }

    // Normalize license plates (remove spaces, convert to uppercase)
    const entryClean = String(entryPlate).trim().toUpperCase().replace(/[ -]/g, "")
    const exitClean = String(exitPlate).trim().toUpperCase().replace(/[ -]/g, "")

    console.log(`Comparing license plates: '${entryClean}' vs '${exitClean}'`)

    // Check exact match FIRST
    if (entryClean === exitClean) {
      console.log("License plates match exactly")
      return true
    }

    // **ADD STRICTER CHECK**
    // If length difference is more than 2 characters -> no match
    if (Math.abs(entryClean.length - exitClean.length) > 2) {
      console.log("License plates differ too much in length")
      return false
    }

    // Check match with tolerance but STRICTER
    let sameChars = 0
    for (let i = 0; i < Math.min(entryClean.length, exitClean.length); i++) {
      if (entryClean[i] === exitClean[i]) {
        sameChars++
      }
    }
    const similarity = sameChars / Math.max(entryClean.length, exitClean.length)

    console.log(`Similarity: ${(similarity * 100).toFixed(0)}%`)

    // **REDUCE THRESHOLD TO 95%** for stricter matching
    const isMatch = similarity >= 0.95

    if (isMatch) {
      console.log("License plates considered matching (similarity >= 95%)")
    } else {
      console.log("License plates DO NOT match (similarity < 95%)")
    }

    return isMatch
  }

  // Handle license plate error
  const handleLicensePlateError = async (cardId, entryPlate, exitPlate, exitImage, exitFaceImage = null) => {
    try {
      // This would show a dialog in the actual implementation
      // For now, return a mock result
      const userConfirmed = window.confirm(
        `Biển số không khớp!\nBiển số vào: ${entryPlate}\nBiển số ra: ${exitPlate}\n\nBạn có muốn xác nhận xe ra không?`,
      )

      if (userConfirmed) {
        const correctedPlate = window.prompt("Nhập biển số chính xác:", exitPlate)
        if (correctedPlate) {
          return `xac_nhan:${correctedPlate}`
        }
      }

      return "huy"
    } catch (error) {
      console.log(`❌ Error displaying dialog: ${error}`)
      console.error(error)
      return "huy"
    }
  }

  // Update vehicle in list
  const updateVehicleInList = (vehicleData) => {
    // Create list if it doesn't exist
    if (!Array.isArray(vehicles)) {
      setVehicles([])
    }

    const cardId = vehicleData.ma_the
    const licensePlate = vehicleData.bien_so

    // Find vehicle in list
    const existingVehicleIndex = vehicles.findIndex((vehicle) => vehicle.ma_the === cardId)

    if (existingVehicleIndex !== -1) {
      // Update existing vehicle
      const updatedVehicles = [...vehicles]
      updatedVehicles[existingVehicleIndex] = { ...updatedVehicles[existingVehicleIndex], ...vehicleData }
      setVehicles(updatedVehicles)
      console.log(`✅ Updated vehicle ${licensePlate} in list`)
    } else {
      // Add new vehicle
      setVehicles((prev) => [...prev, vehicleData])
      console.log(`✅ Added vehicle ${licensePlate} to list`)
    }
  }

  // Set UI reference
  const setUIReference = (uiRef) => {
    setUi(uiRef)
  }

  // Expose methods to parent component
  React.useImperativeHandle(
    React.forwardRef(() => null),
    () => ({
      processVehicleEntry,
      processVehicleExit,
      setUIReference,
      updateVehicleInList,
    }),
  )

  return (
    <div>
      <h3>QuanLyXe Logic (No UI)</h3>
      {/* Vehicle management logic only */}
    </div>
  )
}

export default QuanLyXe
