import React, { useState, useEffect } from 'react';
import { getTodayAttendanceRecords, cleanupOldAttendanceData } from '../api/apiChamCong.js';
import '../assets/styles/AttendanceDialog.css';

const AttendanceDialog = ({ isOpen, onClose }) => {
  const [attendanceRecords, setAttendanceRecords] = useState([]);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    if (isOpen) {
      loadAttendanceRecords();
    }
  }, [isOpen]);

  const loadAttendanceRecords = () => {
    setLoading(true);
    try {
      const records = getTodayAttendanceRecords();
      setAttendanceRecords(records);
      // Cleanup dữ liệu cũ
      cleanupOldAttendanceData();
    } catch (error) {
      console.error('Lỗi tải dữ liệu chấm công:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleClearRecords = () => {
    if (window.confirm('Bạn có chắc chắn muốn xóa tất cả dữ liệu chấm công hôm nay?')) {
      // Xóa đúng key localStorage mà getTodayAttendanceRecords sử dụng
      const today = new Date().toDateString();
      const storageKey = `attendance_records_${today}`;
      localStorage.removeItem(storageKey);
      setAttendanceRecords([]);
    }
  };

  const formatDateTime = (timestamp) => {
    try {
      const date = new Date(timestamp);
      return date.toLocaleString('vi-VN', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
      });
    } catch (error) {
      return timestamp;
    }
  };

  const getStatusColor = (status) => {
    switch (status) {
      case 'present':
        return '#10b981'; // green
      case 'late':
        return '#f59e0b'; // yellow
      case 'early':
        return '#3b82f6'; // blue
      default:
        return '#6b7280'; // gray
    }
  };

  const getStatusText = (status) => {
    switch (status) {
      case 'present':
        return 'Đúng giờ';
      case 'late':
        return 'Đi muộn';
      case 'early':
        return 'Đi sớm';
      default:
        return status || 'Không xác định';
    }
  };

  if (!isOpen) return null;

  return (
    <div className="attendance-dialog-overlay">
      <div className="attendance-dialog">
        <div className="attendance-dialog-header">
          <h2>
            Chấm Công Hôm Nay
            <span className="record-count">({attendanceRecords.length} lượt)</span>
          </h2>
          <div className="header-actions">
            <button 
              className="refresh-btn" 
              onClick={loadAttendanceRecords}
              disabled={loading}
            >
              ↻ Làm mới
            </button>
            <button 
              className="clear-btn" 
              onClick={handleClearRecords}
              disabled={attendanceRecords.length === 0}
            >
                Xóa tất cả
            </button>
            <button className="close-btn" onClick={onClose}>
              X
            </button>
          </div>
        </div>

        <div className="attendance-dialog-content">
          {loading ? (
            <div className="loading-container">
              <div className="loading-spinner">⏳</div>
              <p>Đang tải dữ liệu...</p>
            </div>
          ) : attendanceRecords.length === 0 ? (
            <div className="empty-state">
              <div className="empty-icon"></div>
              <h3>Chưa có dữ liệu chấm công</h3>
              <p>Hôm nay chưa có nhân viên nào chấm công thông qua hệ thống.</p>
            </div>
          ) : (
            <div className="attendance-table-container">
              <table className="attendance-table">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã NV</th>
                    <th>Họ Tên</th>
                    <th>Phòng Ban</th>
                    <th>Chức Vụ</th>
                    <th>Trạng Thái</th>
                    <th>Biển Số</th>
                    <th>Thời Gian</th>
                  </tr>
                </thead>
                <tbody>
                  {attendanceRecords.map((record, index) => (
                    <tr key={index} className="attendance-row">
                      <td className="stt-cell">{index + 1}</td>
                      <td className="employee-id-cell">
                        <span className="employee-id">{record.user?.employee_id || 'N/A'}</span>
                      </td>
                      <td className="name-cell">
                        <span className="employee-name">{record.user?.name || 'Không có'}</span>
                      </td>
                      <td className="department-cell">
                        <span className="department">{record.user?.department || 'Không có'}</span>
                      </td>
                      <td className="position-cell">
                        <span className="position">{record.user?.position || 'Không có'}</span>
                      </td>
                      <td className="status-cell">
                        <span 
                          className="status-badge"
                          style={{ backgroundColor: getStatusColor(record.status) }}
                        >
                          {getStatusText(record.status)}
                        </span>
                      </td>
                      <td className="license-plate-cell">
                        <span className="license-plate">{record.licensePlate || 'Không có'}</span>
                      </td>
                      <td className="timestamp-cell">
                        <span className="timestamp">{formatDateTime(record.timestamp)}</span>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          )}
        </div>

        <div className="attendance-dialog-footer">
          <div className="footer-info">
            <span className="today-date">
              📅 {new Date().toLocaleDateString('vi-VN', {
                weekday: 'long',
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
              })}
            </span>
          </div>
          <button className="close-footer-btn" onClick={onClose}>
            Đóng
          </button>
        </div>
      </div>
    </div>
  );
};

export default AttendanceDialog;
