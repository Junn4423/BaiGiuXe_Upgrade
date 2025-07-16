// Test file để kiểm tra Employee API mapping
import { 
  layDanhSachNhanVien, 
  themNhanVien, 
  capNhatNhanVien, 
  xoaNhanVien 
} from '../api/api';

/**
 * Test function để kiểm tra Employee API
 */
export async function testEmployeeAPI() {
  console.log("=== BẮT ĐẦU TEST EMPLOYEE API ===");
  
  try {
    // Test 1: Lấy danh sách nhân viên
    console.log("1. Test lấy danh sách nhân viên...");
    const employees = await layDanhSachNhanVien();
    console.log("Danh sách nhân viên:", employees);
    console.log("Số lượng nhân viên:", employees?.length || 0);
    
    if (employees && employees.length > 0) {
      console.log("Cấu trúc dữ liệu nhân viên đầu tiên:", employees[0]);
      console.log("Các trường có sẵn:", Object.keys(employees[0]));
    }
    
    // Test 2: Thêm nhân viên mới (comment để tránh tạo dữ liệu test)
    /*
    console.log("\n2. Test thêm nhân viên mới...");
    const newEmployee = {
      taiKhoanDN: "test001",
      nguoiThem: "admin",
      roleQuyen: "5",
      ten: "Nguyễn Test",
      quyenHan: "5",
      matKhau: "123456"
    };
    
    const addResult = await themNhanVien(newEmployee);
    console.log("Kết quả thêm nhân viên:", addResult);
    */
    
    // Test 3: Mapping dữ liệu từ API sang form
    if (employees && employees.length > 0) {
      console.log("\n3. Test mapping dữ liệu API sang form...");
      const apiEmployee = employees[0];
      
      // Mapping như trong EmployeePermissionDialog
      const nameParts = (apiEmployee.ten || "").split(" ");
      const formData = {
        lv001: apiEmployee.taiKhoanDN || "",      // taiKhoanDN -> User ID
        lv002: apiEmployee.roleQuyen || "",       // roleQuyen -> User Group ID
        lv003: nameParts[0] || "",                // First name from ten
        lv004: nameParts.slice(1).join(" ") || "", // Last name from ten
        lv005: "", // Never show password
        lv006: apiEmployee.taiKhoanDN || "",      // Use taiKhoanDN as employee ID for now
        lv095: "1", // Default active status
        lv099: "default", // Default theme
        lv900: "" // Default notes
      };
      
      console.log("Dữ liệu gốc từ API:", apiEmployee);
      console.log("Dữ liệu sau khi mapping:", formData);
    }
    
    console.log("\n=== KẾT THÚC TEST EMPLOYEE API ===");
    return true;
    
  } catch (error) {
    console.error("Lỗi khi test Employee API:", error);
    return false;
  }
}

/**
 * Test mapping ngược từ form data sang API format
 */
export function testFormToAPIMapping() {
  console.log("=== TEST MAPPING FORM -> API ===");
  
  const formData = {
    lv001: "user001",
    lv002: "1", // Nhân Viên QL Vào
    lv003: "Nguyễn",
    lv004: "Văn Test",
    lv005: "newpassword",
    lv006: "EMP001",
    lv095: "1",
    lv099: "default",
    lv900: "Ghi chú test"
  };
  
  // Mapping như trong handleSave
  const employeeData = {
    taiKhoanDN: formData.lv001,    // User ID -> taiKhoanDN
    nguoiThem: "admin",           // Current user (could be dynamic)
    roleQuyen: formData.lv002,    // User Group ID -> roleQuyen
    ten: formData.lv003 + (formData.lv004 ? " " + formData.lv004 : ""), // Combine first + last name
    quyenHan: formData.lv002,     // Use same as roleQuyen for now
    // Only include password if it's being changed
    ...(formData.lv005 ? { matKhau: formData.lv005 } : {})
  };
  
  console.log("Form data input:", formData);
  console.log("API data output:", employeeData);
  console.log("=== KẾT THÚC TEST MAPPING ===");
  
  return employeeData;
}

// Export để có thể gọi từ console
window.testEmployeeAPI = testEmployeeAPI;
window.testFormToAPIMapping = testFormToAPIMapping;
