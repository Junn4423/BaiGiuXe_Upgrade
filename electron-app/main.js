const { app, BrowserWindow } = require("electron")
const path = require("path")
const { spawn } = require("child_process")

let mainWindow
let rtspServer

function createWindow() {
  // Create the browser window
  mainWindow = new BrowserWindow({
    width: 1920,
    height: 1080,
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

  // Start RTSP server
  startRTSPServer()
}

function startRTSPServer() {
  console.log("Starting RTSP WebSocket server...")

  rtspServer = spawn("node", [path.join(__dirname, "rtsp-server.js")], {
    stdio: "inherit",
  })

  rtspServer.on("error", (err) => {
    console.error("Failed to start RTSP server:", err)
  })

  rtspServer.on("exit", (code, signal) => {
    console.log(`RTSP server exited with code ${code}, signal ${signal}`)
  })
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
  // Kill RTSP server
  if (rtspServer && !rtspServer.killed) {
    console.log("Killing RTSP server...")
    rtspServer.kill("SIGKILL")
  }

  if (process.platform !== "darwin") app.quit()
})

app.on("before-quit", () => {
  // Kill RTSP server before quitting
  if (rtspServer && !rtspServer.killed) {
    console.log("Killing RTSP server before quit...")
    rtspServer.kill("SIGKILL")
  }
})
