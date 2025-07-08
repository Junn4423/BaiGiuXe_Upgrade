// Test script để kiểm tra logic tính phí gửi xe
// Run this in browser console to test

import { tinhPhiGuiXe } from '../api/api'

/**
 * Test the fee calculation functionality
 * @param {string} maPhien - Session ID to test with
 */
async function testFeeCalculation(maPhien) {
  console.log(`🧪 Testing fee calculation for session: ${maPhien}`)
  
  try {
    const result = await tinhPhiGuiXe(maPhien)
    console.log("📊 Fee calculation result:", result)
    
    if (result && result.success) {
      const phi = result.phi || 0
      const tongPhut = result.tongPhut || 0
      const feeFormatted = phi > 0 ? `${phi.toLocaleString()} VNĐ` : "0 VNĐ"
      const durationText = tongPhut > 0 ? ` (${Math.floor(tongPhut / 60)}h ${tongPhut % 60}m)` : ""
      
      console.log(`✅ Fee calculation successful:`)
      console.log(`   - Phí: ${feeFormatted}`)
      console.log(`   - Thời gian: ${durationText}`)
      console.log(`   - Raw phi: ${phi}`)
      console.log(`   - Raw tongPhut: ${tongPhut}`)
      
      return { success: true, phi, tongPhut, formatted: feeFormatted + durationText }
    } else {
      const errorMsg = result?.message || "Lỗi tính phí"
      console.error(`❌ Fee calculation failed: ${errorMsg}`)
      return { success: false, message: errorMsg }
    }
  } catch (error) {
    console.error("❌ Fee calculation error:", error)
    return { success: false, message: error.message }
  }
}

/**
 * Test fee calculation with multiple session IDs
 * @param {string[]} sessionIds - Array of session IDs to test
 */
async function testMultipleFeeCalculations(sessionIds) {
  console.log("🧪 Testing multiple fee calculations...")
  
  for (const sessionId of sessionIds) {
    console.log(`\n--- Testing session: ${sessionId} ---`)
    await testFeeCalculation(sessionId)
    
    // Wait a bit between requests to avoid overwhelming the server
    await new Promise(resolve => setTimeout(resolve, 500))
  }
  
  console.log("\n✅ Multiple fee calculations test completed!")
}

/**
 * Test the VehicleInfoComponent fee calculation functionality
 * This simulates how the component would use the fee calculation
 */
async function testVehicleInfoComponentFeeCalculation() {
  console.log("🧪 Testing VehicleInfoComponent fee calculation integration...")
  
  // Simulate component state
  const mockVehicleInfo = {
    ma_the: "TEST001",
    trang_thai: "Trong bãi", 
    ma_phien: "TEST_SESSION_001"
  }
  
  console.log("📝 Mock vehicle info:", mockVehicleInfo)
  
  if (!mockVehicleInfo.ma_phien) {
    console.log("❌ Không có mã phiên để tính phí")
    return { success: false, message: "Thiếu mã phiên" }
  }
  
  console.log(`💰 Đang tính phí cho mã phiên: ${mockVehicleInfo.ma_phien}`)
  
  const result = await testFeeCalculation(mockVehicleInfo.ma_phien)
  
  if (result.success) {
    console.log("✅ VehicleInfoComponent integration test successful!")
    console.log(`   Display text: ${result.formatted}`)
  } else {
    console.log("❌ VehicleInfoComponent integration test failed!")
  }
  
  return result
}

// Export test functions for use in console
window.testFeeCalculation = testFeeCalculation
window.testMultipleFeeCalculations = testMultipleFeeCalculations  
window.testVehicleInfoComponentFeeCalculation = testVehicleInfoComponentFeeCalculation

console.log("🧪 Fee calculation test functions loaded!")
console.log("Available functions:")
console.log("  - testFeeCalculation(maPhien)")
console.log("  - testMultipleFeeCalculations([sessionIds])")
console.log("  - testVehicleInfoComponentFeeCalculation()")
