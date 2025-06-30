// Test script để kiểm tra logic lấy chính sách giá
// Run this in browser console to test

async function testPolicyLogic() {
  console.log("🧪 Testing pricing policy logic...")
  
  try {
    // Test với loại xe máy
    console.log("\n--- Testing XE_MAY ---")
    const xeMayPolicy = await layChinhSachMacDinhChoLoaiPT("XE_MAY")
    console.log("XE_MAY policy:", xeMayPolicy)
    
    // Test với loại ô tô
    console.log("\n--- Testing OT ---")
    const otoPolicy = await layChinhSachMacDinhChoLoaiPT("OT")
    console.log("OT policy:", otoPolicy)
    
    // Test với loại không tồn tại
    console.log("\n--- Testing INVALID ---")
    const invalidPolicy = await layChinhSachMacDinhChoLoaiPT("INVALID")
    console.log("Invalid type policy:", invalidPolicy)
    
    console.log("\n✅ Policy logic test completed!")
    
  } catch (error) {
    console.error("❌ Policy logic test failed:", error)
  }
}

// Để chạy test, gọi: testPolicyLogic()
console.log("💡 To run test, execute: testPolicyLogic()")
