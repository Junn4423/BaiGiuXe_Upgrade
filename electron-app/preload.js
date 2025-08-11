// preload.js - Electron preload script
const { contextBridge, ipcRenderer } = require("electron");

// Expose APIs to renderer process
contextBridge.exposeInMainWorld("electronAPI", {
  // Save image automatically
  saveImage: async (imageData) => {
    return await ipcRenderer.invoke("save-image", imageData);
  },

  // Create directory
  createDirectory: async (dirPath) => {
    return await ipcRenderer.invoke("create-directory", dirPath);
  },

  // Choose custom save directory
  chooseSaveDirectory: async () => {
    return await ipcRenderer.invoke("choose-save-directory");
  },

  // Get app paths
  getAppPaths: async () => {
    return await ipcRenderer.invoke("get-app-paths");
  },

  // Show file in explorer
  showInExplorer: async (filePath) => {
    return await ipcRenderer.invoke("show-in-explorer", filePath);
  },

  // Check if path exists
  pathExists: async (pathToCheck) => {
    return await ipcRenderer.invoke("path-exists", pathToCheck);
  },

  // USB Relay Control APIs
  relayControl: {
    // Connect to USB Relay
    connect: async () => {
      const result = await ipcRenderer.invoke("relay-connect");
      if (!result.success) throw new Error(result.error);
      return result.result;
    },

    // Disconnect USB Relay
    disconnect: async () => {
      const result = await ipcRenderer.invoke("relay-disconnect");
      if (!result.success) throw new Error(result.error);
      return result.result;
    },

    // Control single relay
    controlRelay: async (relayNum, state) => {
      const result = await ipcRenderer.invoke("relay-control", relayNum, state);
      if (!result.success) throw new Error(result.error);
      return result.result;
    },

    // Turn on relay
    turnOn: async (relayNum) => {
      const result = await ipcRenderer.invoke("relay-turn-on", relayNum);
      if (!result.success) throw new Error(result.error);
      return result.result;
    },

    // Turn off relay
    turnOff: async (relayNum) => {
      const result = await ipcRenderer.invoke("relay-turn-off", relayNum);
      if (!result.success) throw new Error(result.error);
      return result.result;
    },

    // Turn off all relays
    turnOffAll: async () => {
      const result = await ipcRenderer.invoke("relay-turn-off-all");
      if (!result.success) throw new Error(result.error);
      return result.result;
    },

    // Control with bitmask
    controlBitmask: async (bitmask) => {
      const result = await ipcRenderer.invoke("relay-control-bitmask", bitmask);
      if (!result.success) throw new Error(result.error);
      return result.result;
    },

    // Test sequence
    testSequence: async (cycles = 1, delayMs = 1000) => {
      const result = await ipcRenderer.invoke(
        "relay-test-sequence",
        cycles,
        delayMs
      );
      if (!result.success) throw new Error(result.error);
      return result.result;
    },

    // Test bitmask patterns
    testBitmaskPatterns: async (cycles = 1, delayMs = 1500) => {
      const result = await ipcRenderer.invoke(
        "relay-test-bitmask-patterns",
        cycles,
        delayMs
      );
      if (!result.success) throw new Error(result.error);
      return result.result;
    },

    // Get status
    getStatus: async () => {
      const result = await ipcRenderer.invoke("relay-get-status");
      if (!result.success) throw new Error(result.error);
      return result.result;
    },
  },

  // Check if running in Electron
  isElectron: true,

  // Platform info
  platform: process.platform,
});
