const { app, BrowserWindow, ipcMain, dialog } = require("electron")
const path = require("path")
const fs = require("fs").promises
const RTSPStreamingServer = require("./rtsp-streaming-server")

let mainWindow
let rtspServer

function createWindow() {
  // Create the browser window
  mainWindow = new BrowserWindow({
    width: 1920,
    height: 1080,
    fullscreen: true, // Mở mặc định full màn hình
    webPreferences: {
      nodeIntegration: false,
      contextIsolation: true,
      enableRemoteModule: false,
      webSecurity: false, // Allow RTSP connections
      preload: path.join(__dirname, "preload.js"),
    },
    // Show window only when ready to prevent white screen
    show: false
  })

  // Show window when ready
  mainWindow.once('ready-to-show', () => {
    mainWindow.show()
  })

  // Handle navigation errors
  mainWindow.webContents.on('did-fail-load', (event, errorCode, errorDescription) => {
    console.error('Failed to load:', errorCode, errorDescription)
  })

  // Load the React app
  const isDev = process.env.NODE_ENV === "development"

  if (isDev) {
    mainWindow.loadURL("http://localhost:3000")
    mainWindow.webContents.openDevTools()
  } else {
    // In production build, frontend is copied to build/ directory
    const indexPath = path.join(__dirname, "build", "index.html")
    console.log("Loading index.html from:", indexPath)
    
    // Check if file exists first
    const fs = require('fs')
    if (fs.existsSync(indexPath)) {
      console.log("✅ Index file exists, loading...")
      mainWindow.loadFile(indexPath)
    } else {
      console.error("❌ Index file not found at:", indexPath)
      // Try alternative path
      const altPath = path.join(__dirname, "../frontend/build/index.html")
      console.log("Trying alternative path:", altPath)
      if (fs.existsSync(altPath)) {
        mainWindow.loadFile(altPath)
      } else {
        console.error("❌ No index.html found in either location")
      }
    }
    
    // Enable DevTools in production for debugging
    mainWindow.webContents.openDevTools()
  }

  // Start RTSP streaming server
  startRTSPStreamingServer()
}

function startRTSPStreamingServer() {
  console.log("Starting RTSP streaming server...")

  try {
    rtspServer = new RTSPStreamingServer(9999)
    rtspServer.start()
    console.log("RTSP streaming server started successfully")
  } catch (err) {
    console.error("Failed to start RTSP streaming server:", err)
  }
}

// This method will be called when Electron has finished initialization
app.whenReady().then(() => {
  createWindow()

  app.on("activate", () => {
    if (BrowserWindow.getAllWindows().length === 0) createWindow()
  })
})

// Quit when all windows are closed
app.on("window-all-closed", () => {
  // Stop RTSP streaming server
  if (rtspServer) {
    console.log("Stopping RTSP streaming server...")
    rtspServer.stop()
  }

  if (process.platform !== "darwin") app.quit()
})

app.on("before-quit", () => {
  // Stop RTSP streaming server before quitting
  if (rtspServer) {
    console.log("Stopping RTSP streaming server before quit...")
    rtspServer.stop()
  }
})

// ==================== IPC HANDLERS FOR IMAGE SAVING ====================

// IPC Handler for saving images automatically
ipcMain.handle('save-image', async (event, { data, fileName, folder }) => {
  try {
    // Get app data directory or user documents
    const documentsPath = app.getPath('documents')
    const appFolderPath = path.join(documentsPath, 'ParkingLotApp')
    const fullFolderPath = path.join(appFolderPath, folder)
    
    // Create directory if it doesn't exist
    await fs.mkdir(fullFolderPath, { recursive: true })
    
    // Full file path
    const filePath = path.join(fullFolderPath, fileName)
    
    // Convert array back to buffer
    const buffer = Buffer.from(data)
    
    // Write file
    await fs.writeFile(filePath, buffer)
    
    console.log(`✅ Image auto-saved to: ${filePath}`)
    return filePath
  } catch (error) {
    console.error('❌ Error auto-saving image:', error)
    throw error
  }
})

// IPC Handler for choosing custom save directory
ipcMain.handle('choose-save-directory', async () => {
  try {
    const result = await dialog.showOpenDialog(mainWindow, {
      properties: ['openDirectory', 'createDirectory'],
      title: 'Chọn thư mục lưu ảnh',
      buttonLabel: 'Chọn thư mục'
    })
    
    if (!result.canceled && result.filePaths.length > 0) {
      return result.filePaths[0]
    }
    return null
  } catch (error) {
    console.error('❌ Error choosing directory:', error)
    throw error
  }
})

// IPC Handler for getting app paths
ipcMain.handle('get-app-paths', async () => {
  const documentsPath = app.getPath('documents')
  const appFolderPath = path.join(documentsPath, 'ParkingLotApp')
  
  return {
    userData: app.getPath('userData'),
    documents: documentsPath,
    downloads: app.getPath('downloads'),
    desktop: app.getPath('desktop'),
    appFolder: appFolderPath,
    defaultImageFolder: path.join(appFolderPath, 'assets', 'imgAnhChup')
  }
})

// IPC Handler for opening file explorer to show saved files
ipcMain.handle('show-in-explorer', async (event, filePath) => {
  try {
    const { shell } = require('electron')
    await shell.showItemInFolder(filePath)
    return true
  } catch (error) {
    console.error('❌ Error opening explorer:', error)
    return false
  }
})
