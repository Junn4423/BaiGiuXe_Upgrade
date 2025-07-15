// Test script để debug logic tính ngày kết thúc chính sách
console.log("=== Test tính ngày kết thúc chính sách ===");

// Import hàm tính toán
function tinhNgayKetThucChinhSach(startDate, tongNgay) {
  if (!startDate || !tongNgay || tongNgay <= 0) {
    return ''
  }
  
  const start = new Date(startDate)
  if (isNaN(start.getTime())) {
    return ''
  }
  
  const endDate = new Date(start)
  endDate.setDate(start.getDate() + tongNgay - 1) // -1 vì bao gồm ngày bắt đầu
  
  return endDate.toISOString().split('T')[0] // Format YYYY-MM-DD
}

// Test cases
const testCases = [
  { startDate: '2025-07-02', tongNgay: 30, expected: '2025-07-31', description: 'VIP 1 tháng' },
  { startDate: '2025-07-02', tongNgay: 90, expected: '2025-09-30', description: 'VIP 3 tháng' },
  { startDate: '2025-07-02', tongNgay: 365, expected: '2026-07-01', description: 'VIP 1 năm' },
  { startDate: '2025-01-01', tongNgay: 1, expected: '2025-01-01', description: '1 ngày' },
  { startDate: '2025-01-01', tongNgay: 7, expected: '2025-01-07', description: '1 tuần' },
]

console.log("Ngày hiện tại:", new Date().toISOString().split('T')[0]);

testCases.forEach((testCase, index) => {
  const result = tinhNgayKetThucChinhSach(testCase.startDate, testCase.tongNgay);
  const isCorrect = result === testCase.expected;
  
  console.log(`\nTest ${index + 1}: ${testCase.description}`);
  console.log(`  Input: ${testCase.startDate} + ${testCase.tongNgay} ngày`);
  console.log(`  Expected: ${testCase.expected}`);
  console.log(`  Actual: ${result}`);
  console.log(`  Result: ${isCorrect ? 'PASS' : 'FAIL'}`);
});

console.log("\n=== Test hoàn thành ===");
