// relayControlHTTP.js - HTTP Client for Fast Relay Service
// Replaces direct node-hid USB control with HTTP API calls

const axios = require("axios");

class HTTPRelayController {
  constructor() {
    this.baseURL = "http://127.0.0.1:5003";
    this.isConnected = false;
    this.timeout = 5000; // 5 second timeout
  }

  /**
   * Check if relay service is available
   */
  async connect() {
    try {
      console.log("Đang kết nối Fast Relay Service...");

      // Check health endpoint
      const response = await axios.get(`${this.baseURL}/healthz`, {
        timeout: this.timeout,
      });

      if (response.data.status === "ok") {
        // Check relay status
        const statusResponse = await axios.get(`${this.baseURL}/relay/status`, {
          timeout: this.timeout,
        });

        this.isConnected = statusResponse.data.connected;

        console.log("✅ Fast Relay Service kết nối thành công");
        console.log(`   - Service URL: ${this.baseURL}`);
        console.log(
          `   - Device Status: ${this.isConnected ? "Connected" : "Mock Mode"}`
        );
        console.log(`   - Device Info: ${statusResponse.data.device_info}`);

        return true;
      }

      throw new Error("Relay service không phản hồi đúng");
    } catch (error) {
      console.error("❌ Lỗi kết nối Fast Relay Service:", error.message);
      this.isConnected = false;

      if (error.code === "ECONNREFUSED") {
        throw new Error(
          "Fast Relay Service chưa được khởi động. Hãy chạy start_relay_service.bat"
        );
      }

      throw error;
    }
  }

  /**
   * Disconnect (just mark as disconnected)
   */
  disconnect() {
    try {
      console.log("🔌 Ngắt kết nối Fast Relay Service");
      this.isConnected = false;
    } catch (error) {
      console.error("Lỗi ngắt kết nối:", error.message);
    }
  }

  /**
   * Check connection status
   */
  checkConnection() {
    if (!this.isConnected) {
      throw new Error("Fast Relay Service chưa được kết nối");
    }
  }

  /**
   * Control individual relay
   * @param {number} relayNum - Relay number (1-4)
   * @param {boolean} state - true=ON, false=OFF
   */
  async controlRelay(relayNum, state) {
    try {
      this.checkConnection();

      if (relayNum < 1 || relayNum > 4) {
        throw new Error("Relay number phải từ 1-4");
      }

      const response = await axios.post(
        `${this.baseURL}/relay/control`,
        {
          relay_num: relayNum,
          state: state,
        },
        {
          timeout: this.timeout,
        }
      );

      if (response.data.success) {
        const action = state ? "BẬT" : "TẮT";
        const color = state ? "🔴" : "⚫";
        console.log(`${color} ${action} Relay ${relayNum} via HTTP API`);
        return true;
      }

      throw new Error(response.data.message || "Relay control failed");
    } catch (error) {
      if (error.response?.data?.detail) {
        throw new Error(error.response.data.detail);
      }
      console.error(`❌ Lỗi điều khiển Relay ${relayNum}:`, error.message);
      throw error;
    }
  }

  /**
   * Turn on relay
   * @param {number} relayNum - Relay number (1-4)
   */
  async turnOn(relayNum) {
    return await this.controlRelay(relayNum, true);
  }

  /**
   * Turn off relay
   * @param {number} relayNum - Relay number (1-4)
   */
  async turnOff(relayNum) {
    return await this.controlRelay(relayNum, false);
  }

  /**
   * Turn off all relays
   */
  async turnOffAll() {
    try {
      this.checkConnection();

      const response = await axios.post(
        `${this.baseURL}/relay/all-off`,
        {},
        {
          timeout: this.timeout,
        }
      );

      if (response.data.success) {
        console.log("⚫ TẮT TẤT CẢ relay via HTTP API");
        return true;
      }

      throw new Error(response.data.message || "Turn off all relays failed");
    } catch (error) {
      if (error.response?.data?.detail) {
        throw new Error(error.response.data.detail);
      }
      console.error("❌ Lỗi tắt tất cả relay:", error.message);
      throw error;
    }
  }

  /**
   * Control multiple relays with bitmask
   * @param {number} bitmask - Bitmask (0-15)
   */
  async controlBitmask(bitmask) {
    try {
      this.checkConnection();

      if (bitmask < 0 || bitmask > 15) {
        throw new Error("Bitmask phải từ 0-15");
      }

      const response = await axios.post(
        `${this.baseURL}/relay/control-multiple`,
        {
          bitmask: bitmask,
        },
        {
          timeout: this.timeout,
        }
      );

      if (response.data.success) {
        console.log(
          `🎯 Set bitmask 0x${bitmask.toString(16).toUpperCase()} via HTTP API`
        );
        return true;
      }

      throw new Error(response.data.message || "Bitmask control failed");
    } catch (error) {
      if (error.response?.data?.detail) {
        throw new Error(error.response.data.detail);
      }
      console.error(`❌ Lỗi bitmask 0x${bitmask.toString(16)}:`, error.message);
      throw error;
    }
  }

  /**
   * Get status
   */
  getStatus() {
    return {
      connected: this.isConnected,
      serviceURL: this.baseURL,
      type: "HTTP API",
    };
  }

  /**
   * Test sequence - turn on/off each relay sequentially
   * @param {number} cycles - Number of cycles
   * @param {number} delayMs - Delay between operations
   */
  async testSequence(cycles = 1, delayMs = 1000) {
    try {
      this.checkConnection();
      console.log(`🧪 Bắt đầu test sequence ${cycles} cycles...`);

      for (let cycle = 1; cycle <= cycles; cycle++) {
        console.log(`--- Cycle ${cycle}/${cycles} ---`);

        for (let relayNum = 1; relayNum <= 4; relayNum++) {
          console.log(`Testing Relay ${relayNum}...`);

          // Turn on
          await this.turnOn(relayNum);
          await this.delay(delayMs);

          // Turn off
          await this.turnOff(relayNum);
          await this.delay(delayMs);
        }

        if (cycle < cycles) {
          console.log("Nghỉ giữa các cycles...");
          await this.delay(delayMs * 2);
        }
      }

      // Turn off all at the end
      await this.turnOffAll();
      console.log("✅ Test sequence hoàn thành");
      return true;
    } catch (error) {
      console.error("❌ Test sequence lỗi:", error.message);
      throw error;
    }
  }

  /**
   * Test bitmask patterns
   * @param {number} cycles - Number of cycles
   * @param {number} delayMs - Delay between patterns
   */
  async testBitmaskPatterns(cycles = 1, delayMs = 1500) {
    try {
      this.checkConnection();
      console.log(`🎯 Bắt đầu test bitmask patterns ${cycles} cycles...`);

      const patterns = [
        { bitmask: 0x01, description: "Chỉ Relay 1" }, // 0001
        { bitmask: 0x02, description: "Chỉ Relay 2" }, // 0010
        { bitmask: 0x04, description: "Chỉ Relay 3" }, // 0100
        { bitmask: 0x08, description: "Chỉ Relay 4" }, // 1000
        { bitmask: 0x03, description: "Relay 1+2" }, // 0011
        { bitmask: 0x0c, description: "Relay 3+4" }, // 1100
        { bitmask: 0x05, description: "Relay 1+3" }, // 0101
        { bitmask: 0x0a, description: "Relay 2+4" }, // 1010
        { bitmask: 0x0f, description: "Tất cả relay" }, // 1111
        { bitmask: 0x00, description: "Tắt tất cả" }, // 0000
      ];

      for (let cycle = 1; cycle <= cycles; cycle++) {
        console.log(`--- Pattern Cycle ${cycle}/${cycles} ---`);

        for (const pattern of patterns) {
          console.log(
            `${pattern.description} (0x${pattern.bitmask
              .toString(16)
              .toUpperCase()}):`
          );
          await this.controlBitmask(pattern.bitmask);
          await this.delay(delayMs);
        }

        if (cycle < cycles) {
          console.log("Nghỉ giữa các pattern cycles...");
          await this.delay(delayMs * 2);
        }
      }

      // Turn off all at the end
      await this.turnOffAll();
      console.log("✅ Test bitmask patterns hoàn thành");
      return true;
    } catch (error) {
      console.error("❌ Test bitmask patterns lỗi:", error.message);
      throw error;
    }
  }

  /**
   * Utility delay function
   * @param {number} ms - Milliseconds to delay
   */
  async delay(ms) {
    return new Promise((resolve) => setTimeout(resolve, ms));
  }

  /**
   * Run sequence test - turn on/off each relay sequentially
   * @param {number} cycles - Number of cycles (default: 1)
   * @param {number} delayMs - Delay between operations in milliseconds (default: 1000)
   */
  async sequenceTest(cycles = 1, delayMs = 1000) {
    try {
      this.checkConnection();

      if (cycles < 1 || cycles > 10) {
        throw new Error("Cycles phải từ 1-10");
      }

      if (delayMs < 100 || delayMs > 10000) {
        throw new Error("Delay phải từ 100-10000ms");
      }

      console.log(
        `🧪 Bắt đầu sequence test ${cycles} cycles, delay ${delayMs}ms...`
      );

      const response = await axios.post(
        `${this.baseURL}/relay/sequence-test`,
        {
          cycles: cycles,
          delay_ms: delayMs,
        },
        {
          timeout: cycles * 4 * delayMs + 10000, // Dynamic timeout based on expected duration
        }
      );

      if (response.data.success) {
        console.log(`✅ ${response.data.message}`);
        return true;
      }

      throw new Error(response.data.message || "Sequence test failed");
    } catch (error) {
      if (error.response?.data?.detail) {
        throw new Error(error.response.data.detail);
      }
      console.error("❌ Sequence test lỗi:", error.message);
      throw error;
    }
  }
}

// Create singleton instance
const relayController = new HTTPRelayController();

// Export functions that match the original API
module.exports = {
  connect: () => relayController.connect(),
  disconnect: () => relayController.disconnect(),
  controlRelay: (relayNum, state) =>
    relayController.controlRelay(relayNum, state),
  turnOn: (relayNum) => relayController.turnOn(relayNum),
  turnOff: (relayNum) => relayController.turnOff(relayNum),
  turnOffAll: () => relayController.turnOffAll(),
  controlBitmask: (bitmask) => relayController.controlBitmask(bitmask),
  testSequence: (cycles, delayMs) =>
    relayController.testSequence(cycles, delayMs),
  testBitmaskPatterns: (cycles, delayMs) =>
    relayController.testBitmaskPatterns(cycles, delayMs),
  sequenceTest: (cycles, delayMs) =>
    relayController.sequenceTest(cycles, delayMs),
  getStatus: () => relayController.getStatus(),
};
