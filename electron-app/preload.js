// preload.js - Electron preload script
const { contextBridge, ipcRenderer } = require('electron')

// Expose APIs to renderer process
contextBridge.exposeInMainWorld('electronAPI', {
  // Save image automatically
  saveImage: async (imageData) => {
    return await ipcRenderer.invoke('save-image', imageData)
  },
  
  // Create directory
  createDirectory: async (dirPath) => {
    return await ipcRenderer.invoke('create-directory', dirPath)
  },
  
  // Choose custom save directory
  chooseSaveDirectory: async () => {
    return await ipcRenderer.invoke('choose-save-directory')
  },
  
  // Get app paths
  getAppPaths: async () => {
    return await ipcRenderer.invoke('get-app-paths')
  },
  
  // Show file in explorer
  showInExplorer: async (filePath) => {
    return await ipcRenderer.invoke('show-in-explorer', filePath)
  },
  
  // Check if running in Electron
  isElectron: true,
  
  // Platform info
  platform: process.platform
})
