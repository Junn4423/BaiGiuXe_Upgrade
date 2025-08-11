// relayControl.js - Node.js USB Relay Control Service
// Converted from Python relaycontrol.py

const HID = require("node-hid");

class USBRelayController {
  constructor() {
    this.device = null;
    this.vendorId = 0x16c0;
    this.productId = 0x05df;
    this.isConnected = false;
  }

  /**
   * Kết nối với USB Relay device
   */
  async connect() {
    try {
      console.log("🔌 Đang kết nối USB Relay...");

      // Tìm thiết bị
      const devices = HID.devices();
      const targetDevice = devices.find(
        (d) => d.vendorId === this.vendorId && d.productId === this.productId
      );

      if (!targetDevice) {
        throw new Error("USB Relay device không tìm thấy");
      }

      // Mở kết nối
      this.device = new HID.HID(this.vendorId, this.productId);
      this.isConnected = true;

      console.log("✅ Đã kết nối với USBRelay4");
      console.log(
        `   - Vendor ID: 0x${this.vendorId.toString(16).toUpperCase()}`
      );
      console.log(
        `   - Product ID: 0x${this.productId.toString(16).toUpperCase()}`
      );

      return true;
    } catch (error) {
      console.error("❌ Lỗi kết nối USB Relay:", error.message);
      this.isConnected = false;
      throw error;
    }
  }

  /**
   * Ngắt kết nối
   */
  disconnect() {
    try {
      if (this.device) {
        // Tắt tất cả relay trước khi ngắt kết nối
        this.turnOffAllRelays();
        this.device.close();
        this.device = null;
      }
      this.isConnected = false;
      console.log("🔌 Đã ngắt kết nối USB Relay");
    } catch (error) {
      console.error("❌ Lỗi ngắt kết nối:", error.message);
    }
  }

  /**
   * Kiểm tra kết nối
   */
  checkConnection() {
    if (!this.isConnected || !this.device) {
      throw new Error("USB Relay chưa được kết nối");
    }
  }

  /**
   * Điều khiển relay đơn lẻ
   * @param {number} relayNum - Số relay (1-4)
   * @param {boolean} state - true=ON, false=OFF
   */
  async controlRelay(relayNum, state) {
    try {
      this.checkConnection();

      if (relayNum < 1 || relayNum > 4) {
        throw new Error("Relay number phải từ 1-4");
      }

      let featureData;
      let action, color;

      if (state) {
        featureData = [
          0x00,
          0xff,
          relayNum,
          0x01,
          0x00,
          0x00,
          0x00,
          0x00,
          0x00,
        ];
        action = "BẬT";
        color = "🔴";
      } else {
        featureData = [
          0x00,
          0xfd,
          relayNum,
          0x00,
          0x00,
          0x00,
          0x00,
          0x00,
          0x00,
        ];
        action = "TẮT";
        color = "⚫";
      }

      // Gửi lệnh điều khiển
      const result = this.device.sendFeatureReport(featureData);
      console.log(
        `${color} ${action} Relay ${relayNum} - Result: ${result} bytes`
      );

      return {
        success: result > 0,
        relayNum,
        state,
        action,
        result,
      };
    } catch (error) {
      console.error(`❌ Lỗi điều khiển relay ${relayNum}:`, error.message);
      throw error;
    }
  }

  /**
   * Tắt tất cả relay
   */
  async turnOffAllRelays() {
    try {
      this.checkConnection();

      const featureData = [
        0x00, 0xfc, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00,
      ];
      const result = this.device.sendFeatureReport(featureData);

      console.log(`⚫ TẮT TẤT CẢ relay - Result: ${result} bytes`);

      return {
        success: result > 0,
        action: "TURN_OFF_ALL",
        result,
      };
    } catch (error) {
      console.error("❌ Lỗi tắt tất cả relay:", error.message);
      throw error;
    }
  }

  /**
   * Điều khiển relay bằng bitmask
   * @param {number} bitmask - Bitmask (bit 0=relay1, bit 1=relay2, bit 2=relay3, bit 3=relay4)
   */
  async controlRelayBitmask(bitmask) {
    try {
      this.checkConnection();

      if (bitmask < 0 || bitmask > 15) {
        throw new Error("Bitmask phải từ 0-15 (0x00-0x0F)");
      }

      const featureData = [
        0x00,
        0xff,
        bitmask,
        0x00,
        0x00,
        0x00,
        0x00,
        0x00,
        0x00,
      ];
      const result = this.device.sendFeatureReport(featureData);

      console.log(
        `🎯 Set bitmask 0x${bitmask
          .toString(16)
          .toUpperCase()
          .padStart(2, "0")} - Result: ${result} bytes`
      );

      return {
        success: result > 0,
        bitmask,
        action: "BITMASK_CONTROL",
        result,
      };
    } catch (error) {
      console.error(`❌ Lỗi bitmask control:`, error.message);
      throw error;
    }
  }

  /**
   * Bật relay (wrapper function)
   */
  async turnOn(relayNum) {
    return await this.controlRelay(relayNum, true);
  }

  /**
   * Tắt relay (wrapper function)
   */
  async turnOff(relayNum) {
    return await this.controlRelay(relayNum, false);
  }

  /**
   * Test sequence - bật/tắt tuần tự tất cả relay
   */
  async testSequence(cycles = 1, delayMs = 1000) {
    try {
      console.log(`🧪 Bắt đầu test sequence (${cycles} cycles)...`);

      for (let cycle = 1; cycle <= cycles; cycle++) {
        console.log(`\n--- Cycle ${cycle}/${cycles} ---`);

        for (let relayNum = 1; relayNum <= 4; relayNum++) {
          console.log(`Testing Relay ${relayNum}:`);

          // Bật
          await this.controlRelay(relayNum, true);
          await this.delay(delayMs);

          // Tắt
          await this.controlRelay(relayNum, false);
          await this.delay(delayMs);
        }

        if (cycle < cycles) {
          console.log(`Nghỉ ${delayMs * 2}ms...`);
          await this.delay(delayMs * 2);
        }
      }

      // Tắt tất cả cuối test
      await this.turnOffAllRelays();
      console.log("✅ Test sequence hoàn thành");
    } catch (error) {
      console.error("❌ Lỗi test sequence:", error.message);
      throw error;
    }
  }

  /**
   * Test bitmask patterns
   */
  async testBitmaskPatterns(cycles = 1, delayMs = 1500) {
    try {
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

      console.log(`🎯 Bắt đầu test bitmask patterns (${cycles} cycles)...`);

      for (let cycle = 1; cycle <= cycles; cycle++) {
        console.log(`\n--- Pattern Cycle ${cycle}/${cycles} ---`);

        for (const pattern of patterns) {
          console.log(
            `\n${pattern.description} (0x${pattern.bitmask
              .toString(16)
              .toUpperCase()
              .padStart(2, "0")}):`
          );
          await this.controlRelayBitmask(pattern.bitmask);
          await this.delay(delayMs);
        }

        if (cycle < cycles) {
          console.log(`Nghỉ ${delayMs * 2}ms...`);
          await this.delay(delayMs * 2);
        }
      }

      // Tắt tất cả cuối test
      await this.turnOffAllRelays();
      console.log("✅ Test bitmask patterns hoàn thành");
    } catch (error) {
      console.error("❌ Lỗi test bitmask patterns:", error.message);
      throw error;
    }
  }

  /**
   * Lấy trạng thái hiện tại (simulation - hardware không hỗ trợ read back)
   */
  getStatus() {
    return {
      connected: this.isConnected,
      device: this.device ? "USBRelay4" : null,
      vendorId: this.vendorId,
      productId: this.productId,
    };
  }

  /**
   * Delay helper function
   */
  async delay(ms) {
    return new Promise((resolve) => setTimeout(resolve, ms));
  }
}

// Singleton instance
let relayController = null;

/**
 * Lấy instance của relay controller
 */
function getRelayController() {
  if (!relayController) {
    relayController = new USBRelayController();
  }
  return relayController;
}

/**
 * API functions for frontend
 */
const RelayControlAPI = {
  /**
   * Kết nối với USB Relay
   */
  async connect() {
    const controller = getRelayController();
    return await controller.connect();
  },

  /**
   * Ngắt kết nối
   */
  disconnect() {
    const controller = getRelayController();
    controller.disconnect();
  },

  /**
   * Điều khiển relay đơn lẻ
   */
  async controlRelay(relayNum, state) {
    const controller = getRelayController();
    return await controller.controlRelay(relayNum, state);
  },

  /**
   * Bật relay
   */
  async turnOn(relayNum) {
    const controller = getRelayController();
    return await controller.turnOn(relayNum);
  },

  /**
   * Tắt relay
   */
  async turnOff(relayNum) {
    const controller = getRelayController();
    return await controller.turnOff(relayNum);
  },

  /**
   * Tắt tất cả relay
   */
  async turnOffAll() {
    const controller = getRelayController();
    return await controller.turnOffAllRelays();
  },

  /**
   * Điều khiển bằng bitmask
   */
  async controlBitmask(bitmask) {
    const controller = getRelayController();
    return await controller.controlRelayBitmask(bitmask);
  },

  /**
   * Test sequence
   */
  async testSequence(cycles = 1, delayMs = 1000) {
    const controller = getRelayController();
    return await controller.testSequence(cycles, delayMs);
  },

  /**
   * Test bitmask patterns
   */
  async testBitmaskPatterns(cycles = 1, delayMs = 1500) {
    const controller = getRelayController();
    return await controller.testBitmaskPatterns(cycles, delayMs);
  },

  /**
   * Lấy trạng thái
   */
  getStatus() {
    const controller = getRelayController();
    return controller.getStatus();
  },
};

module.exports = RelayControlAPI;
