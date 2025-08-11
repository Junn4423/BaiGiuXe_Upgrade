// relayService.js - Electron IPC service cho relay control
// Wrapper để gọi từ renderer process

class RelayService {
  constructor() {
    this.isElectron = typeof window !== "undefined" && window.electronAPI;
  }

  /**
   * Kiểm tra xem có phải Electron environment không
   */
  checkElectronEnvironment() {
    if (!this.isElectron) {
      throw new Error("Relay control chỉ hoạt động trong Electron app");
    }
  }

  /**
   * Kết nối với USB Relay
   */
  async connect() {
    try {
      this.checkElectronEnvironment();
      const result = await window.electronAPI.relayControl.connect();
      console.log("🔌 Relay connected:", result);
      return result;
    } catch (error) {
      console.error("❌ Relay connect error:", error);
      throw error;
    }
  }

  /**
   * Ngắt kết nối
   */
  async disconnect() {
    try {
      this.checkElectronEnvironment();
      const result = await window.electronAPI.relayControl.disconnect();
      console.log("🔌 Relay disconnected:", result);
      return result;
    } catch (error) {
      console.error("❌ Relay disconnect error:", error);
      throw error;
    }
  }

  /**
   * Điều khiển relay đơn lẻ
   * @param {number} relayNum - Số relay (1-4)
   * @param {boolean} state - true=ON, false=OFF
   */
  async controlRelay(relayNum, state) {
    try {
      this.checkElectronEnvironment();
      const result = await window.electronAPI.relayControl.controlRelay(
        relayNum,
        state
      );
      console.log(`🎛️ Relay ${relayNum} ${state ? "ON" : "OFF"}:`, result);
      return result;
    } catch (error) {
      console.error(`❌ Relay control error (${relayNum}, ${state}):`, error);
      throw error;
    }
  }

  /**
   * Bật relay
   */
  async turnOn(relayNum) {
    return await this.controlRelay(relayNum, true);
  }

  /**
   * Tắt relay
   */
  async turnOff(relayNum) {
    return await this.controlRelay(relayNum, false);
  }

  /**
   * Tắt tất cả relay
   */
  async turnOffAll() {
    try {
      this.checkElectronEnvironment();
      const result = await window.electronAPI.relayControl.turnOffAll();
      console.log("⚫ All relays OFF:", result);
      return result;
    } catch (error) {
      console.error("❌ Turn off all relays error:", error);
      throw error;
    }
  }

  /**
   * Điều khiển bằng bitmask
   * @param {number} bitmask - Bitmask (0-15)
   */
  async controlBitmask(bitmask) {
    try {
      this.checkElectronEnvironment();
      const result = await window.electronAPI.relayControl.controlBitmask(
        bitmask
      );
      console.log(
        `🎯 Bitmask control (0x${bitmask.toString(16).toUpperCase()}):`,
        result
      );
      return result;
    } catch (error) {
      console.error(
        `❌ Bitmask control error (0x${bitmask.toString(16)}):`,
        error
      );
      throw error;
    }
  }

  /**
   * Test sequence
   */
  async testSequence(cycles = 1, delayMs = 1000) {
    try {
      this.checkElectronEnvironment();
      const result = await window.electronAPI.relayControl.testSequence(
        cycles,
        delayMs
      );
      console.log("🧪 Test sequence completed:", result);
      return result;
    } catch (error) {
      console.error("❌ Test sequence error:", error);
      throw error;
    }
  }

  /**
   * Test bitmask patterns
   */
  async testBitmaskPatterns(cycles = 1, delayMs = 1500) {
    try {
      this.checkElectronEnvironment();
      const result = await window.electronAPI.relayControl.testBitmaskPatterns(
        cycles,
        delayMs
      );
      console.log("🎯 Test bitmask patterns completed:", result);
      return result;
    } catch (error) {
      console.error("❌ Test bitmask patterns error:", error);
      throw error;
    }
  }

  /**
   * Lấy trạng thái
   */
  async getStatus() {
    try {
      this.checkElectronEnvironment();
      const result = await window.electronAPI.relayControl.getStatus();
      return result;
    } catch (error) {
      console.error("❌ Get status error:", error);
      throw error;
    }
  }

  /**
   * Kiểm tra kết nối
   */
  async isConnected() {
    try {
      const status = await this.getStatus();
      return status.connected;
    } catch (error) {
      return false;
    }
  }
}

// Export singleton instance
const relayService = new RelayService();
export default relayService;
