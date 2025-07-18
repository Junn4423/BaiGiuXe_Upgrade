"use client";

import { useState, useEffect } from "react";
import {
  layDanhSachNhanVien,
  themNhanVien,
  capNhatNhanVien,
  xoaNhanVien,
} from "../../api/api";

const EmployeePermissionDialog = ({ onClose }) => {
  // States for employees data
  const [employees, setEmployees] = useState([]);
  const [userGroups, setUserGroups] = useState([]);
  const [selectedEmployee, setSelectedEmployee] = useState(null);
  const [isEditing, setIsEditing] = useState(false);
  const [isLoading, setIsLoading] = useState(false);
  const [isSubmitting, setIsSubmitting] = useState(false);

  // Form data state - mapping trực tiếp với API response
  const [formData, setFormData] = useState({
    taiKhoanDN: "", // User ID - field name từ API
    roleQuyen: "", // Role Quyền - field name từ API (sử dụng làm field chính)
    ten: "", // Tên nhân viên - field name từ API
    matKhau: "", // Password - field name từ API
  });

  // Search and filter states
  const [searchTerm, setSearchTerm] = useState("");
  const [groupFilter, setGroupFilter] = useState("all");
  const [statusFilter, setStatusFilter] = useState("all");
  const [errors, setErrors] = useState({});

  // Permission groups options
  const PERMISSION_GROUPS = [
    { value: "0", label: "Toàn quyền", description: "Toàn quyền hệ thống" },
    {
      value: "1",
      label: "Nhân Viên QL Vào",
      description: "Quản lý xe vào bãi",
    },
    {
      value: "2",
      label: "Nhân Viên QL Ra",
      description: "Quản lý xe ra khỏi bãi",
    },
    {
      value: "3",
      label: "Nhân Viên QL Vào Ra",
      description: "Quản lý xe vào và ra",
    },
  ];

  // Status options for filtering
  const STATUS_OPTIONS = [
    { value: "all", label: "Tất cả", color: "gray" },
    { value: "active", label: "Hoạt động", color: "green" },
    { value: "inactive", label: "Tạm khóa", color: "red" },
  ];

  // Load data when component mounts
  useEffect(() => {
    loadData();
  }, []);

  // Filter employees when search/filter changes
  const filteredEmployees = employees.filter((emp) => {
    const matchesSearch =
      emp.taiKhoanDN?.toLowerCase().includes(searchTerm.toLowerCase()) || // taiKhoanDN
      emp.ten?.toLowerCase().includes(searchTerm.toLowerCase()); // ten

    const matchesGroup = groupFilter === "all" || emp.roleQuyen === groupFilter; // roleQuyen
    const matchesStatus = statusFilter === "all"; // Status filtering not implemented in API yet

    return matchesSearch && matchesGroup && matchesStatus;
  });

  const loadData = async () => {
    setIsLoading(true);
    try {
      await Promise.all([loadEmployees(), loadUserGroups()]);
    } catch (error) {
      console.error("Lỗi tải dữ liệu:", error);
    } finally {
      setIsLoading(false);
    }
  };

  const loadEmployees = async () => {
    try {
      const data = await layDanhSachNhanVien();
      console.log("Dữ liệu nhân viên từ API:", data);
      setEmployees(data || []);
    } catch (error) {
      console.error("Lỗi tải danh sách nhân viên:", error);
      setEmployees([]);
    }
  };

  const loadUserGroups = async () => {
    try {
      // Load user groups if needed from another table
      setUserGroups(PERMISSION_GROUPS);
    } catch (error) {
      console.error("Lỗi tải nhóm quyền:", error);
    }
  };

  const handleSelectEmployee = (employee) => {
    setSelectedEmployee(employee);
    // Map API response to form data - sử dụng trực tiếp field names từ API
    setFormData({
      taiKhoanDN: employee.taiKhoanDN || "", // taiKhoanDN từ API
      roleQuyen: employee.roleQuyen || "", // roleQuyen từ API
      ten: employee.ten || "", // ten từ API
      matKhau: "", // Never show password
    });
    setIsEditing(false);
    setErrors({});
  };

  const handleNewEmployee = () => {
    setSelectedEmployee(null);
    setFormData({
      taiKhoanDN: "", // taiKhoanDN
      roleQuyen: "", // roleQuyen
      ten: "", // ten
      matKhau: "", // matKhau
    });
    setIsEditing(true);
    setErrors({});
  };

  const handleEdit = () => {
    setIsEditing(true);
    setErrors({});
  };

  const validateForm = () => {
    const newErrors = {};

    if (!formData.taiKhoanDN.trim()) {
      newErrors.taiKhoanDN = "Tài khoản đăng nhập không được trống";
    }

    if (!formData.ten.trim()) {
      newErrors.ten = "Tên nhân viên không được trống";
    }

    if (!selectedEmployee && !formData.matKhau.trim()) {
      newErrors.matKhau = "Mật khẩu không được trống khi tạo mới";
    }

    if (!formData.roleQuyen) {
      newErrors.roleQuyen = "Chọn role quyền";
    }

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSave = async () => {
    if (!validateForm()) return;

    setIsSubmitting(true);
    try {
      // Sử dụng trực tiếp formData vì đã match với API structure
      const employeeData = {
        taiKhoanDN: formData.taiKhoanDN,
        nguoiThem: "admin", // Current user (fixed for now)
        roleQuyen: formData.roleQuyen,
        ten: formData.ten,
        quyenHan: formData.roleQuyen, // Set quyenHan = roleQuyen để đồng bộ
        // Only include password if it's being changed
        ...(formData.matKhau ? { matKhau: formData.matKhau } : {}),
      };

      console.log("Dữ liệu gửi lên API:", employeeData);

      if (selectedEmployee) {
        // Update existing employee
        const result = await capNhatNhanVien(employeeData);
        console.log("Kết quả cập nhật:", result);
      } else {
        // Create new employee
        const result = await themNhanVien(employeeData);
        console.log("Kết quả thêm mới:", result);
      }

      await loadEmployees();
      setIsEditing(false);
      setErrors({});
    } catch (error) {
      console.error("Lỗi lưu nhân viên:", error);
      setErrors({ submit: "Lỗi lưu dữ liệu: " + error.message });
    } finally {
      setIsSubmitting(false);
    }
  };

  const handleDelete = async () => {
    if (!selectedEmployee) return;

    if (
      !window.confirm(
        `Bạn có chắc muốn xóa nhân viên "${selectedEmployee.ten}"?`
      )
    ) {
      return;
    }

    setIsSubmitting(true);
    try {
      await xoaNhanVien(selectedEmployee.taiKhoanDN);
      await loadEmployees();
      clearForm();
    } catch (error) {
      console.error("Lỗi xóa nhân viên:", error);
      setErrors({ submit: "Lỗi xóa nhân viên: " + error.message });
    } finally {
      setIsSubmitting(false);
    }
  };

  const clearForm = () => {
    setSelectedEmployee(null);
    setFormData({
      taiKhoanDN: "", // taiKhoanDN
      roleQuyen: "", // roleQuyen
      ten: "", // ten
      matKhau: "", // matKhau
    });
    setIsEditing(false);
    setErrors({});
  };

  const handleCancel = () => {
    if (selectedEmployee) {
      handleSelectEmployee(selectedEmployee);
    } else {
      clearForm();
    }
  };

  const updateField = (field, value) => {
    setFormData((prev) => ({
      ...prev,
      [field]: value,
    }));
    // Clear error when user starts typing
    if (errors[field]) {
      setErrors((prev) => {
        const newErrors = { ...prev };
        delete newErrors[field];
        return newErrors;
      });
    }
  };

  const getGroupLabel = (groupId) => {
    const group = PERMISSION_GROUPS.find((g) => g.value === groupId);
    return group ? group.label : "Không xác định";
  };

  const getStatusLabel = (status) => {
    const statusObj = STATUS_OPTIONS.find((s) => s.value === status);
    return statusObj ? statusObj.label : "Không xác định";
  };

  const getStatusColor = (status) => {
    const statusObj = STATUS_OPTIONS.find((s) => s.value === status);
    return statusObj ? statusObj.color : "gray";
  };

  const resetPassword = async () => {
    if (!selectedEmployee) return;

    if (
      !window.confirm(
        `Bạn có chắc muốn đặt lại mật khẩu cho "${selectedEmployee.ten}"?`
      )
    ) {
      return;
    }

    const newPassword = prompt("Nhập mật khẩu mới:");
    if (!newPassword) return;

    setIsSubmitting(true);
    try {
      // Use the update employee API to change password
      const employeeData = {
        taiKhoanDN: selectedEmployee.taiKhoanDN,
        nguoiThem: "admin",
        roleQuyen: selectedEmployee.roleQuyen,
        ten: selectedEmployee.ten,
        quyenHan: selectedEmployee.roleQuyen, // Set quyenHan = roleQuyen
        matKhau: newPassword,
      };

      await capNhatNhanVien(employeeData);
      alert("Đặt lại mật khẩu thành công");
    } catch (error) {
      console.error("Lỗi đặt lại mật khẩu:", error);
      alert("Lỗi đặt lại mật khẩu: " + error.message);
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div className="employee-permission-overlay">
      <div className="employee-permission-dialog">
        <div className="employee-permission-header">
          <h2>Quản Lý Phân Quyền Nhân Viên</h2>
          <button className="close-btn" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="employee-permission-content">
          {/* Left Panel - Employee List */}
          <div className="employee-list-panel">
            <div className="panel-header">
              <h3>Danh Sách Nhân Viên</h3>
              <button
                className="add-btn"
                onClick={handleNewEmployee}
                disabled={isSubmitting}
              >
                + Thêm Nhân Viên
              </button>
            </div>

            {/* Search and Filter */}
            <div className="search-filter-section">
              <input
                type="text"
                placeholder="Tìm kiếm nhân viên..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="search-input"
              />

              <select
                value={groupFilter}
                onChange={(e) => setGroupFilter(e.target.value)}
                className="filter-select"
              >
                <option value="all">Tất cả nhóm</option>
                {PERMISSION_GROUPS.map((group) => (
                  <option key={group.value} value={group.value}>
                    {group.label}
                  </option>
                ))}
              </select>

              <select
                value={statusFilter}
                onChange={(e) => setStatusFilter(e.target.value)}
                className="filter-select"
              >
                <option value="all">Tất cả trạng thái</option>
                {STATUS_OPTIONS.map((status) => (
                  <option key={status.value} value={status.value}>
                    {status.label}
                  </option>
                ))}
              </select>
            </div>

            {/* Employee List */}
            <div className="employee-list">
              {isLoading ? (
                <div className="loading">Đang tải...</div>
              ) : filteredEmployees.length === 0 ? (
                <div className="no-data">Không có nhân viên nào</div>
              ) : (
                filteredEmployees.map((emp) => (
                  <div
                    key={emp.taiKhoanDN}
                    className={`employee-item ${
                      selectedEmployee?.taiKhoanDN === emp.taiKhoanDN
                        ? "selected"
                        : ""
                    }`}
                    onClick={() => handleSelectEmployee(emp)}
                  >
                    <div className="employee-info">
                      <div className="employee-name">{emp.ten}</div>
                      <div className="employee-details">
                        <span className="employee-id">
                          ID: {emp.taiKhoanDN}
                        </span>
                        <span className="employee-code">
                          Quyền: {getGroupLabel(emp.roleQuyen)}
                        </span>
                      </div>
                      <div className="employee-meta">
                        <span className="group-badge">
                          {getGroupLabel(emp.roleQuyen)}
                        </span>
                        <span className={`status-badge status-green`}>
                          Hoạt động
                        </span>
                      </div>
                    </div>
                  </div>
                ))
              )}
            </div>
          </div>

          {/* Right Panel - Employee Details */}
          <div className="employee-details-panel">
            {selectedEmployee || isEditing ? (
              <>
                <div className="panel-header">
                  <h3>
                    {isEditing
                      ? selectedEmployee
                        ? "Chỉnh Sửa"
                        : "Thêm Mới"
                      : "Thông Tin"}{" "}
                    Nhân Viên
                  </h3>
                  {!isEditing && selectedEmployee && (
                    <div className="action-buttons">
                      <button
                        className="edit-btn"
                        onClick={handleEdit}
                        disabled={isSubmitting}
                      >
                        Chỉnh Sửa
                      </button>
                      <button
                        className="reset-password-btn"
                        onClick={resetPassword}
                        disabled={isSubmitting}
                      >
                        Đặt Lại Mật Khẩu
                      </button>
                      <button
                        className="delete-btn"
                        onClick={handleDelete}
                        disabled={isSubmitting}
                      >
                        Xóa
                      </button>
                    </div>
                  )}
                </div>

                <div className="employee-form">
                  {errors.submit && (
                    <div className="error-message">{errors.submit}</div>
                  )}

                  <div className="form-row">
                    <div className="form-group">
                      <label>Tài Khoản Đăng Nhập *</label>
                      <input
                        type="text"
                        value={formData.taiKhoanDN}
                        onChange={(e) =>
                          updateField("taiKhoanDN", e.target.value)
                        }
                        disabled={!isEditing || selectedEmployee}
                        className={errors.taiKhoanDN ? "error" : ""}
                        placeholder="Nhập tài khoản đăng nhập"
                      />
                      {errors.taiKhoanDN && (
                        <span className="field-error">{errors.taiKhoanDN}</span>
                      )}
                    </div>

                    <div className="form-group">
                      <label>Tên Nhân Viên *</label>
                      <input
                        type="text"
                        value={formData.ten}
                        onChange={(e) => updateField("ten", e.target.value)}
                        disabled={!isEditing}
                        className={errors.ten ? "error" : ""}
                        placeholder="Nhập tên nhân viên"
                      />
                      {errors.ten && (
                        <span className="field-error">{errors.ten}</span>
                      )}
                    </div>
                  </div>

                  {isEditing && (
                    <div className="form-row">
                      <div className="form-group">
                        <label>Mật Khẩu {!selectedEmployee && "*"}</label>
                        <input
                          type="password"
                          value={formData.matKhau}
                          onChange={(e) =>
                            updateField("matKhau", e.target.value)
                          }
                          placeholder={
                            selectedEmployee
                              ? "Để trống nếu không đổi"
                              : "Nhập mật khẩu"
                          }
                          className={errors.matKhau ? "error" : ""}
                        />
                        {errors.matKhau && (
                          <span className="field-error">{errors.matKhau}</span>
                        )}
                      </div>
                    </div>
                  )}

                  <div className="form-row">
                    <div className="form-group">
                      <label>Role Quyền *</label>
                      <select
                        value={formData.roleQuyen}
                        onChange={(e) =>
                          updateField("roleQuyen", e.target.value)
                        }
                        disabled={!isEditing}
                        className={errors.roleQuyen ? "error" : ""}
                      >
                        <option value="">Chọn role quyền</option>
                        {PERMISSION_GROUPS.map((group) => (
                          <option key={group.value} value={group.value}>
                            {group.label} - {group.description}
                          </option>
                        ))}
                      </select>
                      {errors.roleQuyen && (
                        <span className="field-error">{errors.roleQuyen}</span>
                      )}
                    </div>
                  </div>

                  {isEditing && (
                    <div className="form-actions">
                      <button
                        className="save-btn"
                        onClick={handleSave}
                        disabled={isSubmitting}
                      >
                        {isSubmitting ? "Đang lưu..." : "Lưu"}
                      </button>
                      <button
                        className="cancel-btn"
                        onClick={handleCancel}
                        disabled={isSubmitting}
                      >
                        Hủy
                      </button>
                    </div>
                  )}
                </div>
              </>
            ) : (
              <div className="no-selection">
                <p>
                  Chọn nhân viên để xem chi tiết hoặc nhấn "Thêm Nhân Viên" để
                  tạo mới.
                </p>
              </div>
            )}
          </div>
        </div>

        {/* Statistics Panel */}
        <div className="employee-stats">
          <div className="stat-card">
            <span className="stat-number">{employees.length}</span>
            <span className="stat-label">Tổng nhân viên</span>
          </div>
          <div className="stat-card">
            <span className="stat-number">{employees.length}</span>
            <span className="stat-label">Đang hoạt động</span>
          </div>
          <div className="stat-card">
            <span className="stat-number">
              {employees.filter((emp) => emp.roleQuyen === "0").length}
            </span>
            <span className="stat-label">Toàn quyền</span>
          </div>
          <div className="stat-card">
            <span className="stat-number">{filteredEmployees.length}</span>
            <span className="stat-label">Kết quả lọc</span>
          </div>
        </div>
      </div>

      <style jsx>{`
        .employee-permission-overlay {
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background: rgba(0, 0, 0, 0.5);
          display: flex;
          justify-content: center;
          align-items: center;
          z-index: 1000;
        }

        .employee-permission-dialog {
          background: white;
          width: 95%;
          height: 90%;
          max-width: 1400px;
          border-radius: 8px;
          display: flex;
          flex-direction: column;
          overflow: hidden;
        }

        .employee-permission-header {
          background: #f5f5f5;
          padding: 20px;
          border-bottom: 1px solid #ddd;
          display: flex;
          justify-content: space-between;
          align-items: center;
        }

        .employee-permission-header h2 {
          margin: 0;
          color: #333;
        }

        .close-btn {
          background: none;
          border: none;
          font-size: 24px;
          cursor: pointer;
          color: #666;
          padding: 0;
          width: 30px;
          height: 30px;
          display: flex;
          align-items: center;
          justify-content: center;
        }

        .close-btn:hover {
          color: #333;
        }

        .employee-permission-content {
          flex: 1;
          display: flex;
          overflow: hidden;
        }

        .employee-list-panel {
          width: 40%;
          border-right: 1px solid #ddd;
          display: flex;
          flex-direction: column;
          overflow: hidden;
          min-width: 0; /* Prevents flex item from overflowing */
        }

        .employee-details-panel {
          width: 60%;
          display: flex;
          flex-direction: column;
        }

        .panel-header {
          background: #f8f9fa;
          padding: 15px 20px;
          border-bottom: 1px solid #ddd;
          display: flex;
          justify-content: space-between;
          align-items: center;
        }

        .panel-header h3 {
          margin: 0;
          color: #333;
        }

        .add-btn {
          background: #28a745;
          color: white;
          border: none;
          padding: 8px 16px;
          border-radius: 4px;
          cursor: pointer;
          font-size: 14px;
        }

        .add-btn:hover {
          background: #218838;
        }

        .add-btn:disabled {
          background: #6c757d;
          cursor: not-allowed;
        }

        .action-buttons {
          display: flex;
          gap: 8px;
        }

        .edit-btn,
        .reset-password-btn,
        .delete-btn {
          padding: 6px 12px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          font-size: 12px;
        }

        .edit-btn {
          background: #007bff;
          color: white;
        }

        .edit-btn:hover {
          background: #0056b3;
        }

        .reset-password-btn {
          background: #ffc107;
          color: #212529;
        }

        .reset-password-btn:hover {
          background: #e0a800;
        }

        .delete-btn {
          background: #dc3545;
          color: white;
        }

        .delete-btn:hover {
          background: #c82333;
        }

        .search-filter-section {
          padding: 15px 20px;
          border-bottom: 1px solid #ddd;
          background: #fafafa;
          display: flex;
          flex-direction: column;
          gap: 12px;
          box-sizing: border-box;
        }

        .search-input,
        .filter-select {
          width: 100%;
          max-width: 100%;
          padding: 8px 12px;
          border: 1px solid #ddd;
          border-radius: 4px;
          font-size: 14px;
          box-sizing: border-box;
          flex-shrink: 0;
          transition: border-color 0.2s ease;
        }

        .search-input:focus,
        .filter-select:focus {
          outline: none;
          border-color: #007bff;
          box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }

        .search-input {
          margin-bottom: 0;
        }

        .filter-select {
          margin-bottom: 0;
          cursor: pointer;
        }

        .employee-list {
          flex: 1;
          overflow-y: auto;
          padding: 10px;
        }

        .employee-item {
          padding: 12px;
          border: 1px solid #ddd;
          border-radius: 6px;
          margin-bottom: 8px;
          cursor: pointer;
          transition: all 0.2s;
        }

        .employee-item:hover {
          background: #f8f9fa;
          border-color: #007bff;
        }

        .employee-item.selected {
          background: #e3f2fd;
          border-color: #007bff;
        }

        .employee-name {
          font-weight: bold;
          color: #333;
          margin-bottom: 4px;
        }

        .employee-details {
          font-size: 12px;
          color: #666;
          margin-bottom: 6px;
        }

        .employee-details span {
          margin-right: 12px;
        }

        .employee-meta {
          display: flex;
          gap: 6px;
        }

        .group-badge,
        .status-badge {
          padding: 2px 6px;
          border-radius: 3px;
          font-size: 11px;
          font-weight: bold;
        }

        .group-badge {
          background: #e9ecef;
          color: #495057;
        }

        .status-badge.status-green {
          background: #d4edda;
          color: #155724;
        }

        .status-badge.status-red {
          background: #f8d7da;
          color: #721c24;
        }

        .loading,
        .no-data,
        .no-selection {
          text-align: center;
          padding: 40px;
          color: #666;
        }

        .employee-form {
          padding: 20px;
          overflow-y: auto;
          flex: 1;
        }

        .form-row {
          display: flex;
          gap: 20px;
          margin-bottom: 20px;
        }

        .form-group {
          flex: 1;
        }

        .form-group label {
          display: block;
          margin-bottom: 5px;
          font-weight: bold;
          color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
          width: 100%;
          padding: 8px 12px;
          border: 1px solid #ddd;
          border-radius: 4px;
          font-size: 14px;
        }

        .form-group input:disabled,
        .form-group select:disabled,
        .form-group textarea:disabled {
          background: #f8f9fa;
          color: #6c757d;
        }

        .form-group input.error,
        .form-group select.error {
          border-color: #dc3545;
        }

        .field-error {
          color: #dc3545;
          font-size: 12px;
          margin-top: 4px;
          display: block;
        }

        .error-message {
          background: #f8d7da;
          color: #721c24;
          padding: 12px;
          border-radius: 4px;
          margin-bottom: 20px;
        }

        .form-actions {
          display: flex;
          gap: 12px;
          margin-top: 30px;
          padding-top: 20px;
          border-top: 1px solid #ddd;
        }

        .save-btn,
        .cancel-btn {
          padding: 10px 20px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          font-size: 14px;
        }

        .save-btn {
          background: #28a745;
          color: white;
        }

        .save-btn:hover {
          background: #218838;
        }

        .save-btn:disabled {
          background: #6c757d;
          cursor: not-allowed;
        }

        .cancel-btn {
          background: #6c757d;
          color: white;
        }

        .cancel-btn:hover {
          background: #545b62;
        }

        .employee-stats {
          background: #f8f9fa;
          padding: 15px 20px;
          border-top: 1px solid #ddd;
          display: flex;
          gap: 20px;
        }

        .stat-card {
          flex: 1;
          text-align: center;
          padding: 12px;
          background: white;
          border-radius: 6px;
          border: 1px solid #ddd;
        }

        .stat-number {
          display: block;
          font-size: 24px;
          font-weight: bold;
          color: #007bff;
        }

        .stat-label {
          display: block;
          font-size: 12px;
          color: #666;
          margin-top: 4px;
        }

        @media (max-width: 1024px) {
          .employee-permission-content {
            flex-direction: column;
          }

          .employee-list-panel {
            width: 100%;
            height: 50%;
          }

          .employee-details-panel {
            width: 100%;
            height: 50%;
          }

          .form-row {
            flex-direction: column;
            gap: 0;
          }

          .search-filter-section {
            padding: 12px 15px;
          }

          .search-input,
          .filter-select {
            font-size: 16px; /* Prevent zoom on mobile */
            padding: 10px 12px;
          }
        }

        @media (max-width: 480px) {
          .search-filter-section {
            padding: 10px 12px;
            gap: 10px;
          }

          .search-input,
          .filter-select {
            padding: 12px;
            font-size: 16px;
          }
        }
      `}</style>
    </div>
  );
};

export default EmployeePermissionDialog;
