"use client"

import { useState } from "react"
import "../assets/styles/Login.css"
import { taoBangChoPhienLamViec } from "../api/api"
import { url_login_api } from "../api/url"
import WorkConfigDialog from "./dialogs/WorkConfigDialog"
import MainUI from "./main/main_UI"
import sofLogo from "../assets/img/sof.png"
import { useUser } from "../utils/userContext"

const LOGIN_API = url_login_api

const LoadingOverlay = ({ percent }) => (
  <div className="login-loading-overlay">
    <div className="login-loading-box">
      <div className="login-spinner"></div>
      <div className="login-loading-text">Đang khởi tạo hệ thống... {percent}%</div>
    </div>
  </div>
)

const Login = ({ onLoginSuccess }) => {
  const [username, setUsername] = useState("")
  const [password, setPassword] = useState("")
  const [error, setError] = useState("")
  const [loading, setLoading] = useState(false)
  const [percent, setPercent] = useState(0)
  const [showConfig, setShowConfig] = useState(false)
  const [loggedIn, setLoggedIn] = useState(false)
  const [showContinueDialog, setShowContinueDialog] = useState(false)
  const [loginData, setLoginData] = useState(null) // Lưu trữ thông tin đăng nhập

  // Sử dụng user context để quản lý đăng nhập
  const userContext = useUser()

  const handleSubmit = async (e) => {
    e.preventDefault()
    if (username === "" || password === "") {
      setError("Vui lòng nhập đầy đủ thông tin")
      return
    }
    setError("")
    setLoading(true)
    setPercent(0)
    let progress = 0
    const interval = setInterval(() => {
      progress += 2
      setPercent(progress)
      if (progress >= 90) clearInterval(interval)
    }, 15)
    try {
      const res = await fetch(LOGIN_API, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ txtUserName: username, txtPassword: password }),
      })
      const data = await res.json()
      if (res.status === 200 && data.code && data.token) {
        // Đăng nhập qua UserContext để lấy quyền hạn
        console.log('🔐 Đang đăng nhập và load quyền hạn cho user:', data.code)
        const loginResult = await userContext.login({
          username: username,
          userCode: data.code
        }, data.token)
        
        if (loginResult.success) {
          // Lưu thông tin đăng nhập để sử dụng sau
          setLoginData({ 
            username: username, 
            userCode: data.code,
            token: data.token
          })
          setShowConfig(true)
        } else {
          setError(loginResult.message || 'Không thể lấy thông tin quyền hạn')
          setLoading(false)
          setPercent(0)
          return
        }
        setLoading(false)
        setPercent(100)
        setTimeout(() => setPercent(0), 500)
      } else {
        setError("Tài khoản hoặc mật khẩu không đúng!")
        setLoading(false)
        setPercent(0)
      }
    } catch (err) {
      setError("Không thể kết nối đến máy chủ: " + err.message)
      setLoading(false)
      setPercent(0)
    }
  }

  const handleConfigSaved = async (config) => {
    try {
      console.log("Đang tạo phiên làm việc...")
      const taoPhien = await taoBangChoPhienLamViec()
      console.log("Kết quả tạo phiên:", taoPhien)

      if (taoPhien && taoPhien.success === true) {
        console.log("Tạo phiên thành công")
        setShowConfig(false)
        setLoggedIn(true)
        // Truyền thông tin đăng nhập vào onLoginSuccess
        onLoginSuccess && onLoginSuccess(loginData)
        return
      }

      const errorMessage = taoPhien?.message || ""
      console.log("Error message:", errorMessage)

      if (
        errorMessage.includes("đã tồn tại") ||
        errorMessage.includes("already exists") ||
        errorMessage.toLowerCase().includes("duplicate") ||
        errorMessage.includes("pm_nc0009_")
      ) {
        console.log("Phiên làm việc đã tồn tại, hiển thị dialog xác nhận")
        setShowContinueDialog(true)
        setShowConfig(false)
        return
      }

      console.log("Lỗi khác:", errorMessage)
      setError("Không thể tạo phiên làm việc mới: " + errorMessage)
      setShowConfig(false)
    } catch (e) {
      console.log("Exception:", e)
      const errorMessage = e.message || e.toString()

      if (
        errorMessage.includes("đã tồn tại") ||
        errorMessage.includes("already exists") ||
        errorMessage.toLowerCase().includes("duplicate") ||
        errorMessage.includes("pm_nc0009_")
      ) {
        console.log("Exception - Phiên làm việc đã tồn tại")
        setShowContinueDialog(true)
        setShowConfig(false)
        return
      }

      setError("Không thể tạo phiên làm việc mới: " + errorMessage)
      setShowConfig(false)
    }
  }

  const handleContinueSession = (agree) => {
    setShowContinueDialog(false)
    if (agree) {
      console.log("Người dùng chọn tiếp tục phiên làm việc")
      setLoggedIn(true)
      // Truyền thông tin đăng nhập vào onLoginSuccess
      onLoginSuccess && onLoginSuccess(loginData)
    } else {
      console.log("Người dùng hủy tiếp tục phiên làm việc")
      setShowConfig(true)
    }
  }

  const handleCancel = () => {
    setUsername("")
    setPassword("")
    setError("")
    setLoginData(null)
  }

  if (loggedIn) return <MainUI />

  return (
    <div className="login-container">
      {/* Left Panel */}
      <div className="login-left-panel">
        <div className="login-logo-section">
          <img src={sofLogo || "/placeholder.svg"} alt="SOF Logo" className="login-logo" />
          <h1 className="login-brand-title">HỆ THỐNG QUẢN LÝ BÃI XE</h1>
          <p className="login-brand-subtitle">Giải pháp thông minh cho việc quản lý bãi đỗ xe hiện đại</p>
          <ul className="login-features">
            <li>Quản lý ra vào tự động</li>
            <li>Nhận diện biển số xe</li>
            <li>Báo cáo thống kê chi tiết</li>
            <li>Hệ thống camera giám sát</li>
          </ul>
        </div>
      </div>

      {/* Right Panel */}
      <div className="login-right-panel">
        <div className="login-form-container">
          <div className="login-form-header">
            <h2 className="login-form-title">Đăng Nhập</h2>
            <p className="login-form-subtitle">Vui lòng đăng nhập để tiếp tục sử dụng hệ thống</p>
          </div>

          <form onSubmit={handleSubmit} className="login-form">
            <div className="login-form-group">
              <label className="login-label">Tài khoản</label>
              <input
                type="text"
                value={username}
                onChange={(e) => setUsername(e.target.value)}
                className="login-input"
                placeholder="Nhập tên đăng nhập"
                autoFocus
              />
            </div>

            <div className="login-form-group">
              <label className="login-label">Mật khẩu</label>
              <input
                type="password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                className="login-input"
                placeholder="Nhập mật khẩu"
              />
            </div>

            {error && <div className="login-error">{error}</div>}

            <button type="submit" className="login-button" disabled={loading}>
              {loading ? "Đang đăng nhập..." : "Đăng nhập"}
            </button>

            <button type="button" className="login-cancel-btn" onClick={handleCancel} disabled={loading}>
              Hủy
            </button>
          </form>
        </div>
      </div>

      {loading && <LoadingOverlay percent={percent} />}
      {showConfig && <WorkConfigDialog onConfigSaved={handleConfigSaved} onClose={() => setShowConfig(false)} />}
      {showContinueDialog && (
        <div className="login-confirm-overlay">
          <div className="login-confirm-box">
            <div className="login-confirm-title">Phiên làm việc đã tồn tại</div>
            <div className="login-confirm-message">
              Hệ thống phát hiện phiên làm việc hôm nay đã được tạo trước đó. Bạn có muốn tiếp tục với phiên làm việc
              hiện tại không?
            </div>
            <div className="login-confirm-actions">
              <button className="login-confirm-btn" onClick={() => handleContinueSession(true)}>
                Tiếp tục
              </button>
              <button className="login-cancel-btn" onClick={() => handleContinueSession(false)}>
                Hủy
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  )
}

export default Login
