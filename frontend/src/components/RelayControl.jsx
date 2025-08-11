import React, { useState, useEffect } from "react";
import relayService from "../services/relayService";
import { useToast } from "./Toast";
import "../assets/styles/RelayControl.css";

const RelayControl = ({ isOpen, onClose }) => {
  const { showToast } = useToast();
  const [isConnected, setIsConnected] = useState(false);
  const [connecting, setConnecting] = useState(false);
  const [relayStates, setRelayStates] = useState({
    1: false,
    2: false,
    3: false,
    4: false,
  });
  const [testRunning, setTestRunning] = useState(false);
  const [bitmaskValue, setBitmaskValue] = useState(0);

  useEffect(() => {
    if (isOpen) {
      checkConnection();
    }
  }, [isOpen]);

  const checkConnection = async () => {
    try {
      const connected = await relayService.isConnected();
      setIsConnected(connected);
    } catch (error) {
      setIsConnected(false);
    }
  };

  const handleConnect = async () => {
    try {
      setConnecting(true);
      await relayService.connect();
      setIsConnected(true);
      showToast("Đã kết nối USB Relay thành công!", "success");
    } catch (error) {
      console.error("Connect error:", error);
      showToast(`Lỗi kết nối: ${error.message}`, "error");
    } finally {
      setConnecting(false);
    }
  };

  const handleDisconnect = async () => {
    try {
      await relayService.disconnect();
      setIsConnected(false);
      setRelayStates({ 1: false, 2: false, 3: false, 4: false });
      showToast("Đã ngắt kết nối USB Relay", "info");
    } catch (error) {
      console.error("Disconnect error:", error);
      showToast(`Lỗi ngắt kết nối: ${error.message}`, "error");
    }
  };

  const handleRelayToggle = async (relayNum) => {
    if (!isConnected) {
      showToast("Chưa kết nối USB Relay", "error");
      return;
    }

    try {
      const newState = !relayStates[relayNum];
      await relayService.controlRelay(relayNum, newState);

      setRelayStates((prev) => ({
        ...prev,
        [relayNum]: newState,
      }));

      const action = newState ? "BẬT" : "TẮT";
      const icon = newState ? "🔴" : "⚫";
      showToast(`${icon} ${action} Relay ${relayNum}`, "success");
    } catch (error) {
      console.error(`Relay ${relayNum} control error:`, error);
      showToast(`Lỗi điều khiển Relay ${relayNum}`, "error");
    }
  };

  const handleTurnOffAll = async () => {
    if (!isConnected) {
      showToast("Chưa kết nối USB Relay", "error");
      return;
    }

    try {
      await relayService.turnOffAll();
      setRelayStates({ 1: false, 2: false, 3: false, 4: false });
      setBitmaskValue(0);
      showToast("⚫ Đã tắt tất cả relay", "success");
    } catch (error) {
      console.error("Turn off all error:", error);
      showToast(`Lỗi tắt tất cả relay: ${error.message}`, "error");
    }
  };

  const handleBitmaskControl = async () => {
    if (!isConnected) {
      showToast("Chưa kết nối USB Relay", "error");
      return;
    }

    try {
      await relayService.controlBitmask(bitmaskValue);

      // Cập nhật UI state dựa trên bitmask
      const newStates = {
        1: (bitmaskValue & 0x01) !== 0,
        2: (bitmaskValue & 0x02) !== 0,
        3: (bitmaskValue & 0x04) !== 0,
        4: (bitmaskValue & 0x08) !== 0,
      };
      setRelayStates(newStates);

      showToast(
        `Bitmask 0x${bitmaskValue
          .toString(16)
          .toUpperCase()
          .padStart(2, "0")} applied`,
        "success"
      );
    } catch (error) {
      console.error("Bitmask control error:", error);
      showToast(`Lỗi bitmask control: ${error.message}`, "error");
    }
  };

  const handleTestSequence = async () => {
    if (!isConnected) {
      showToast("Chưa kết nối USB Relay", "error");
      return;
    }

    try {
      setTestRunning(true);
      showToast("Bắt đầu test sequence...", "info");

      await relayService.testSequence(1, 800);

      // Reset UI state sau test
      setRelayStates({ 1: false, 2: false, 3: false, 4: false });
      setBitmaskValue(0);

      showToast("Test sequence hoàn thành!", "success");
    } catch (error) {
      console.error("Test sequence error:", error);
      showToast(`Lỗi test sequence: ${error.message}`, "error");
    } finally {
      setTestRunning(false);
    }
  };

  const handleTestBitmaskPatterns = async () => {
    if (!isConnected) {
      showToast("Chưa kết nối USB Relay", "error");
      return;
    }

    try {
      setTestRunning(true);
      showToast("Bắt đầu test bitmask patterns...", "info");

      await relayService.testBitmaskPatterns(1, 1000);

      // Reset UI state sau test
      setRelayStates({ 1: false, 2: false, 3: false, 4: false });
      setBitmaskValue(0);

      showToast("Test bitmask patterns hoàn thành!", "success");
    } catch (error) {
      console.error("Test bitmask patterns error:", error);
      showToast(`Lỗi test bitmask patterns: ${error.message}`, "error");
    } finally {
      setTestRunning(false);
    }
  };

  const handleBitmaskPreset = (preset) => {
    setBitmaskValue(preset);
  };

  if (!isOpen) return null;

  return (
    <div className="relay-control-overlay">
      <div className="relay-control-container">
        <div className="relay-control-header">
          <h2>USB Relay Control</h2>
          <button className="close-btn" onClick={onClose}>
            ×
          </button>
        </div>

        <div className="relay-control-content">
          {/* Connection Section */}
          <div className="relay-section">
            <h3>Kết nối</h3>
            <div className="connection-controls">
              <div
                className={`connection-status ${
                  isConnected ? "connected" : "disconnected"
                }`}
              >
                <span className="status-indicator"></span>
                {isConnected ? "Đã kết nối" : "Chưa kết nối"}
              </div>

              {!isConnected ? (
                <button
                  className="btn btn-primary"
                  onClick={handleConnect}
                  disabled={connecting}
                >
                  {connecting ? "Đang kết nối..." : "Kết nối"}
                </button>
              ) : (
                <button
                  className="btn btn-secondary"
                  onClick={handleDisconnect}
                >
                  Ngắt kết nối
                </button>
              )}
            </div>
          </div>

          {/* Individual Relay Controls */}
          <div className="relay-section">
            <h3>Điều khiển từng Relay</h3>
            <div className="relay-controls">
              {[1, 2, 3, 4].map((relayNum) => (
                <div key={relayNum} className="relay-item">
                  <label>Relay {relayNum}</label>
                  <button
                    className={`relay-btn ${
                      relayStates[relayNum] ? "on" : "off"
                    }`}
                    onClick={() => handleRelayToggle(relayNum)}
                    disabled={!isConnected || testRunning}
                  >
                    {relayStates[relayNum] ? "🔴 ON" : "⚫ OFF"}
                  </button>
                </div>
              ))}
            </div>

            <div className="global-controls">
              <button
                className="btn btn-warning"
                onClick={handleTurnOffAll}
                disabled={!isConnected || testRunning}
              >
                Tắt tất cả
              </button>
            </div>
          </div>

          {/* Bitmask Control */}
          <div className="relay-section">
            <h3>Bitmask Control</h3>
            <div className="bitmask-controls">
              <div className="bitmask-input">
                <label>Bitmask (0-15):</label>
                <input
                  type="number"
                  min="0"
                  max="15"
                  value={bitmaskValue}
                  onChange={(e) =>
                    setBitmaskValue(parseInt(e.target.value) || 0)
                  }
                  disabled={!isConnected || testRunning}
                />
                <span className="bitmask-hex">
                  (0x{bitmaskValue.toString(16).toUpperCase().padStart(2, "0")})
                </span>
              </div>

              <button
                className="btn btn-primary"
                onClick={handleBitmaskControl}
                disabled={!isConnected || testRunning}
              >
                Áp dụng Bitmask
              </button>

              <div className="bitmask-presets">
                <span>Presets:</span>
                <button
                  className="preset-btn"
                  onClick={() => handleBitmaskPreset(1)}
                >
                  R1
                </button>
                <button
                  className="preset-btn"
                  onClick={() => handleBitmaskPreset(2)}
                >
                  R2
                </button>
                <button
                  className="preset-btn"
                  onClick={() => handleBitmaskPreset(4)}
                >
                  R3
                </button>
                <button
                  className="preset-btn"
                  onClick={() => handleBitmaskPreset(8)}
                >
                  R4
                </button>
                <button
                  className="preset-btn"
                  onClick={() => handleBitmaskPreset(3)}
                >
                  R1+2
                </button>
                <button
                  className="preset-btn"
                  onClick={() => handleBitmaskPreset(12)}
                >
                  R3+4
                </button>
                <button
                  className="preset-btn"
                  onClick={() => handleBitmaskPreset(15)}
                >
                  ALL
                </button>
                <button
                  className="preset-btn"
                  onClick={() => handleBitmaskPreset(0)}
                >
                  NONE
                </button>
              </div>
            </div>
          </div>

          {/* Test Functions */}
          <div className="relay-section">
            <h3>Test Functions</h3>
            <div className="test-controls">
              <button
                className="btn btn-info"
                onClick={handleTestSequence}
                disabled={!isConnected || testRunning}
              >
                {testRunning ? "Testing..." : "Test Sequence"}
              </button>

              <button
                className="btn btn-info"
                onClick={handleTestBitmaskPatterns}
                disabled={!isConnected || testRunning}
              >
                {testRunning ? "Testing..." : "Test Bitmask Patterns"}
              </button>
            </div>

            <div className="test-info">
              <p>
                <strong>Test Sequence:</strong> Bật/tắt tuần tự từng relay
              </p>
              <p>
                <strong>Test Bitmask:</strong> Thử các pattern khác nhau
              </p>
            </div>
          </div>

          {/* Relay State Visualization */}
          <div className="relay-section">
            <h3>Trạng thái Relay</h3>
            <div className="relay-visualization">
              {[1, 2, 3, 4].map((relayNum) => (
                <div
                  key={relayNum}
                  className={`relay-visual ${
                    relayStates[relayNum] ? "active" : "inactive"
                  }`}
                >
                  <div className="relay-label">R{relayNum}</div>
                  <div className="relay-indicator">
                    {relayStates[relayNum] ? "🔴" : "⚫"}
                  </div>
                </div>
              ))}
            </div>

            <div className="bitmask-display">
              <span>Current Bitmask: </span>
              <span className="bitmask-value">
                0x
                {(
                  (relayStates[4] ? 8 : 0) +
                  (relayStates[3] ? 4 : 0) +
                  (relayStates[2] ? 2 : 0) +
                  (relayStates[1] ? 1 : 0)
                )
                  .toString(16)
                  .toUpperCase()
                  .padStart(2, "0")}
              </span>
              <span className="binary-display">
                ({relayStates[4] ? "1" : "0"}
                {relayStates[3] ? "1" : "0"}
                {relayStates[2] ? "1" : "0"}
                {relayStates[1] ? "1" : "0"})
              </span>
            </div>
          </div>
        </div>

        <div className="relay-control-footer">
          <div className="device-info">
            <span>USB Relay 4-Channel (VID: 0x16C0, PID: 0x05DF)</span>
          </div>
        </div>
      </div>
    </div>
  );
};

export default RelayControl;
