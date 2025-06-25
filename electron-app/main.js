const { app, BrowserWindow } = require("electron")
const path = require("path")
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
    },
  })

  // Load the React app
  const isDev = process.env.NODE_ENV === "development"

  if (isDev) {
    mainWindow.loadURL("http://localhost:3000")
    mainWindow.webContents.openDevTools()
  } else {
    mainWindow.loadFile(path.join(__dirname, "../frontend/build/index.html"))
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
