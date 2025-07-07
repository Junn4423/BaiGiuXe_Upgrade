// Debug script để kiểm tra hàm layChinhSachMacDinhChoLoaiPT
// Chạy trong browser console để debug

console.log(" Testing layChinhSachMacDinhChoLoaiPT function...");

// Test cases
const testCases = [
  { loaiXe: "xe_may", maLoaiPT: "XE_MAY", expected: "CS_XEMAY_4H" },
  { loaiXe: "oto", maLoaiPT: "OT", expected: "CS_OTO_4H" },
  { loaiXe: null, maLoaiPT: "XE_MAY", expected: "CS_XEMAY_4H" },
  { loaiXe: "xe_may", maLoaiPT: null, expected: "CS_XEMAY_4H" },
  { loaiXe: null, maLoaiPT: null, expected: "CS_XEMAY_4H" },
  { loaiXe: "", maLoaiPT: "", expected: "CS_XEMAY_4H" },
  { loaiXe: undefined, maLoaiPT: undefined, expected: "CS_XEMAY_4H" }
];

// Hàm test (copy từ api.js và chỉnh sửa để không gọi API thật)
async function testLayChinhSachMacDinhChoLoaiPT(loaiXe, maLoaiPT) {
  console.log(`🔍 Testing với loai xe: ${loaiXe}, mã loại PT: ${maLoaiPT}`);
  
  try {
    // Skip API call for testing, go straight to fallback
    console.log(`⚠️ Skipping API call, using fallback logic...`);
    
    // Fallback logic
    let fallbackPolicy = "CS_XEMAY_4H"; // Mặc định cho xe máy
    
    if (loaiXe === "oto" || maLoaiPT === "OT") {
      fallbackPolicy = "CS_OTO_4H";
    } else if (loaiXe === "xe_may" || maLoaiPT === "XE_MAY") {
      fallbackPolicy = "CS_XEMAY_4H";
    }
    
    // Đảm bảo fallback policy không bao giờ là null/empty
    if (!fallbackPolicy || fallbackPolicy.trim() === '') {
      fallbackPolicy = "CS_XEMAY_4H"; // Mặc định cuối cùng
      console.log(`🔧 Sử dụng mặc định cuối cùng: ${fallbackPolicy}`);
    }
    
    return fallbackPolicy;
    
  } catch (error) {
    console.error("❌ Lỗi khi test:", error);
    
    // Fallback cuối cùng
    let fallbackPolicy = "CS_XEMAY_4H"; // Mặc định
    
    if (loaiXe === "oto" || maLoaiPT === "OT") {
      fallbackPolicy = "CS_OTO_4H";
    } else if (loaiXe === "xe_may" || maLoaiPT === "XE_MAY") {
      fallbackPolicy = "CS_XEMAY_4H";
    }
    
    // Đảm bảo không bao giờ trả về null/empty
    if (!fallbackPolicy || fallbackPolicy.trim() === '') {
      fallbackPolicy = "CS_XEMAY_4H";
    }
    
    return fallbackPolicy;
  }
}

// Chạy tất cả test cases
async function runAllTests() {
  console.log("🚀 Starting all tests...");
  
  for (let i = 0; i < testCases.length; i++) {
    const testCase = testCases[i];
    console.log(`\n--- Test ${i + 1}/${testCases.length} ---`);
    
    try {
      const result = await testLayChinhSachMacDinhChoLoaiPT(testCase.loaiXe, testCase.maLoaiPT);
      const success = result === testCase.expected;
      
      console.log(`Input: loaiXe="${testCase.loaiXe}", maLoaiPT="${testCase.maLoaiPT}"`);
      console.log(`Expected: "${testCase.expected}"`);
      console.log(`Got: "${result}"`);
      console.log(`Result: ${success ? '✅ PASS' : '❌ FAIL'}`);
      
      if (!success) {
        console.error(`❌ Test failed for case ${i + 1}`);
      }
    } catch (error) {
      console.error(`❌ Test ${i + 1} threw error:`, error);
    }
  }
  
  console.log("\n🏁 All tests completed!");
}

// Chạy tests
runAllTests();

// Export để có thể gọi từ ngoài
window.testPricingPolicy = {
  runAllTests,
  testLayChinhSachMacDinhChoLoaiPT,
  testCases
};

console.log("💡 You can also call window.testPricingPolicy.runAllTests() manually");
