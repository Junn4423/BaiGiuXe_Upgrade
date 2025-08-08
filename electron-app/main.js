const { app, BrowserWindow, ipcMain, dialog } = require("electron")
const path = require("path")
const fs = require("fs").promises
const RTSPStreamingServer = require("./rtsp-streaming-server")
const { spawn } = require("child_process");
let alprProcess;
let pythonInstallProcess;

/**
 * Check if Python is installed and accessible
 */
function checkPythonInstallation() {
  return new Promise((resolve) => {
    const pythonCheck = spawn("python", ["--version"], { stdio: "pipe" });
    
    pythonCheck.on("close", (code) => {
      if (code === 0) {
        console.log("✅ Python is installed and accessible");
        resolve(true);
      } else {
        console.log("❌ Python is not installed or not in PATH");
        resolve(false);
      }
    });
    
    pythonCheck.on("error", () => {
      console.log("❌ Python command not found");
      resolve(false);
    });
  });
}

/**
 * Install Python dependencies if needed
 */
async function installPythonDependencies() {
  console.log("🐍 Checking Python virtual environment...");
  
  // Determine virtual environment path based on app packaging
  let venvPath;
  let biensoDirPath;
  
  const devVenvPath = path.join(__dirname, "..", "backend", "bienso", "venv");
  const prodVenvPath = path.join(__dirname, "backend", "bienso", "venv");
  const devBiensoDirPath = path.join(__dirname, "..", "backend", "bienso");
  const prodBiensoDirPath = path.join(__dirname, "backend", "bienso");
  
  // Check which virtual environment exists
  try {
    await fs.access(prodVenvPath);
    venvPath = prodVenvPath;
    biensoDirPath = prodBiensoDirPath;
    console.log("📄 Found virtual environment in app bundle");
  } catch {
    try {
      await fs.access(devVenvPath);
      venvPath = devVenvPath;
      biensoDirPath = devBiensoDirPath;
      console.log("📄 Found virtual environment in development structure");
    } catch {
      console.error("❌ Virtual environment not found in either location");
      console.log("🔧 Creating virtual environment...");
      
      // Try to create virtual environment
      try {
        await fs.access(prodBiensoDirPath);
        biensoDirPath = prodBiensoDirPath;
        venvPath = prodVenvPath;
      } catch {
        biensoDirPath = devBiensoDirPath;
        venvPath = devVenvPath;
      }
      
      // Create virtual environment
      const createVenv = spawn("python", ["-m", "venv", "venv"], {
        cwd: biensoDirPath,
        stdio: "inherit"
      });
      
      await new Promise((resolve) => {
        createVenv.on("close", (code) => {
          if (code === 0) {
            console.log("✅ Virtual environment created successfully");
          } else {
            console.error("❌ Failed to create virtual environment");
          }
          resolve();
        });
      });
    }
  }
  
  // Check if virtual environment is properly set up
  const pythonExePath = path.join(venvPath, "Scripts", "python.exe");
  const pipExePath = path.join(venvPath, "Scripts", "pip.exe");
  
  try {
    await fs.access(pythonExePath);
    await fs.access(pipExePath);
    console.log("✅ Virtual environment is properly set up");
  } catch {
    console.error("❌ Virtual environment is not properly set up");
    return false;
  }
  
  return new Promise((resolve) => {
    console.log(`📦 Installing Python dependencies in virtual environment: ${venvPath}`);
    
    // Install required packages directly instead of using requirements.txt
    const packages = ["fastapi", "uvicorn", "fast_alpr", "opencv-python", "numpy", "requests", "onnxruntime", "python-multipart"];
    
    pythonInstallProcess = spawn(pipExePath, ["install", "--upgrade", "pip"], {
      stdio: "inherit",
      env: { 
        ...process.env,
        VIRTUAL_ENV: venvPath,
        PATH: `${path.join(venvPath, "Scripts")};${process.env.PATH}`
      }
    });
    
    pythonInstallProcess.on("close", (code) => {
      if (code === 0) {
        console.log("✅ Pip upgraded successfully");
        
        // Install packages
        const installPackages = spawn(pipExePath, ["install", ...packages], {
          stdio: "inherit",
          env: { 
            ...process.env,
            VIRTUAL_ENV: venvPath,
            PATH: `${path.join(venvPath, "Scripts")};${process.env.PATH}`
          }
        });
        
        installPackages.on("close", (installCode) => {
          if (installCode === 0) {
            console.log("✅ Python dependencies installed successfully in virtual environment");
            resolve(true);
          } else {
            console.error("❌ Failed to install Python dependencies in virtual environment");
            resolve(false);
          }
        });
        
        installPackages.on("error", (err) => {
          console.error("❌ Error installing Python dependencies:", err);
          resolve(false);
        });
        
      } else {
        console.error("❌ Failed to upgrade pip");
        resolve(false);
      }
    });
    
    pythonInstallProcess.on("error", (err) => {
      console.error("❌ Error upgrading pip:", err);
      resolve(false);
    });
  });
}

/**
 * Spawn the Fast ALPR Python micro-service so that licence-plate
 * detection is available for the React/Electron frontend.
 */
async function startALPRService() {
  // Check Python installation first
  const pythonAvailable = await checkPythonInstallation();
  if (!pythonAvailable) {
    console.error("❌ Cannot start ALPR service: Python not available");
    return false;
  }
  
  // Determine paths based on app packaging
  let venvPath;
  let scriptPath;
  let pythonExePath;
  
  const devVenvPath = path.join(__dirname, "..", "backend", "bienso", "venv");
  const prodVenvPath = path.join(__dirname, "backend", "bienso", "venv");
  const devScriptPath = path.join(__dirname, "..", "backend", "bienso", "fast_alpr_service.py");
  const prodScriptPath = path.join(__dirname, "backend", "bienso", "fast_alpr_service.py");
  
  // Check for virtual environment and script paths
  try {
    await fs.access(prodVenvPath);
    await fs.access(prodScriptPath);
    venvPath = prodVenvPath;
    scriptPath = prodScriptPath;
    pythonExePath = path.join(prodVenvPath, "Scripts", "python.exe");
    console.log("🔧 Using production ALPR service path with virtual environment");
  } catch {
    try {
      await fs.access(devVenvPath);
      await fs.access(devScriptPath);
      venvPath = devVenvPath;
      scriptPath = devScriptPath;
      pythonExePath = path.join(devVenvPath, "Scripts", "python.exe");
      console.log("🔧 Using development ALPR service path with virtual environment");
    } catch {
      console.error("❌ ALPR service script or virtual environment not found in either location");
      return false;
    }
  }

  // Check if Python executable exists in virtual environment
  try {
    await fs.access(pythonExePath);
    console.log("✅ Virtual environment Python executable found:", pythonExePath);
  } catch {
    console.error("❌ Python executable not found in virtual environment:", pythonExePath);
    console.log("🔄 Falling back to system Python...");
    pythonExePath = "python";
  }

  console.log("🚀 Spawning Fast ALPR service with virtual environment:");
  console.log("   Script:", scriptPath);
  console.log("   Python:", pythonExePath);

  alprProcess = spawn(pythonExePath, [scriptPath, "--host", "127.0.0.1", "--port", "5001"], {
    stdio: "inherit",
    env: { 
      ...process.env, 
      PYTHONUNBUFFERED: "1",
      VIRTUAL_ENV: venvPath,
      PATH: `${path.join(venvPath, "Scripts")};${process.env.PATH}`
    },
  });

  alprProcess.on("error", (err) => {
    console.error("❌ Failed to launch Fast ALPR service:", err);
  });

  alprProcess.on("exit", (code, signal) => {
    console.log(`ℹ️ Fast ALPR service exited with code=${code} signal=${signal}`);
    // Auto-restart if exit was unexpected
    if (code !== 0 && signal !== "SIGTERM" && signal !== "SIGKILL") {
      console.log("🔄 Attempting to restart ALPR service...");
      setTimeout(() => startALPRService(), 5000);
    }
  });
  
  return true;
}

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

  // Debug FFmpeg in production
  if (process.env.NODE_ENV !== 'development') {
    try {
      const { debugFFmpegPath } = require('./debug-ffmpeg')
      debugFFmpegPath()
    } catch (e) {
      console.error('Debug FFmpeg error:', e)
    }
  }

  // Load the React app
  const isDev = process.env.NODE_ENV === "development"

  if (isDev) {
    mainWindow.loadURL("http://localhost:3000")
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
  }
  // // Disable DevTools
  // mainWindow.webContents.on('devtools-opened', () => {
  //   mainWindow.webContents.closeDevTools();
  // });
  // mainWindow.webContents.on('before-input-event', (event, input) => {
  //   // Block F12, Cmd+Opt+I, Ctrl+Shift+I
  //   if (
  //     (input.key === 'F12') ||
  //     (input.control && input.shift && input.key.toUpperCase() === 'I') ||
  //     (input.meta && input.alt && input.key.toUpperCase() === 'I')
  //   ) {
  //     event.preventDefault();
  //   }
  // });

  // Start RTSP streaming server
  startRTSPStreamingServer()
}

function startRTSPStreamingServer() {
  console.log("🔍 [DEBUG] Starting RTSP streaming server...")
  console.log("🔍 [DEBUG] Environment:", process.env.NODE_ENV)
  console.log("🔍 [DEBUG] App path:", __dirname)
  console.log("🔍 [DEBUG] Process:", process.execPath)

  try {
    rtspServer = new RTSPStreamingServer(9999)
    rtspServer.start()
    console.log("✅ RTSP streaming server started successfully on port 9999")
    console.log("🔍 [DEBUG] Server instance created and started")
  } catch (err) {
    console.error("❌ Failed to start RTSP streaming server:", err)
    console.error("🔍 [DEBUG] Error details:", {
      message: err.message,
      stack: err.stack
    })
  }
}

// This method will be called when Electron has finished initialization
app.whenReady().then(async () => {
  console.log("🚀 Starting Parking Lot Management System...");
  
  // Install Python dependencies first
  console.log("🐍 Setting up Python environment...");
  const depsInstalled = await installPythonDependencies();
  
  if (depsInstalled) {
    console.log("✅ Python environment ready");
    
    // Start ALPR service
    console.log("🐍 Initializing Python ALPR service...");
    const alprStarted = await startALPRService();
    
    if (alprStarted) {
      console.log("✅ ALPR service started successfully");
    } else {
      console.warn("⚠️ ALPR service failed to start - continuing without license plate recognition");
    }
  } else {
    console.warn("⚠️ Python environment setup failed - continuing without license plate recognition");
  }
  
  // Create the main window
  createWindow();

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

  if (alprProcess) {
    console.log("Stopping Fast ALPR service...");
    alprProcess.kill();
  }

  if (process.platform !== "darwin") app.quit()
})

app.on("before-quit", () => {
  // Stop all processes before quitting
  if (rtspServer) {
    console.log("🛑 Stopping RTSP streaming server before quit...");
    rtspServer.stop();
  }
  
  if (pythonInstallProcess) {
    console.log("🛑 Stopping Python installation process...");
    pythonInstallProcess.kill();
  }
  
  if (alprProcess) {
    console.log("🛑 Stopping Fast ALPR service before quit...");
    alprProcess.kill("SIGTERM");
    
    // Force kill if not responsive
    setTimeout(() => {
      if (alprProcess && !alprProcess.killed) {
        console.log("🛑 Force killing ALPR service...");
        alprProcess.kill("SIGKILL");
      }
    }, 3000);
  }
})

// ==================== IPC HANDLERS FOR IMAGE SAVING ====================

// IPC Handler for saving images automatically
ipcMain.handle('save-image', async (event, { data, fileName, folder }) => {
  try {
    let fullFolderPath;
    
    // Check if folder is an absolute path
    if (path.isAbsolute(folder)) {
      fullFolderPath = folder;
    } else {
      // Use relative path from app documents folder
      const documentsPath = app.getPath('documents');
      const appFolderPath = path.join(documentsPath, 'ParkingLotApp');
      fullFolderPath = path.join(appFolderPath, folder);
    }
    
    // Create directory if it doesn't exist
    await fs.mkdir(fullFolderPath, { recursive: true });
    
    // Full file path
    const filePath = path.join(fullFolderPath, fileName);
    
    // Convert array back to buffer
    const buffer = Buffer.from(data);
    
    // Write file
    await fs.writeFile(filePath, buffer);
    
    console.log(`✅ Image auto-saved to: ${filePath}`);
    return filePath;
  } catch (error) {
    console.error('❌ Error auto-saving image:', error);
    throw error;
  }
});

// IPC Handler for creating directories
ipcMain.handle('create-directory', async (event, dirPath) => {
  try {
    await fs.mkdir(dirPath, { recursive: true })
    console.log(`✅ Directory created: ${dirPath}`)
    return true
  } catch (error) {
    console.error('❌ Error creating directory:', error)
    throw error
  }
})

// IPC Handler for checking if path exists
ipcMain.handle('path-exists', async (event, pathToCheck) => {
  try {
    await fs.access(pathToCheck)
    return true
  } catch (error) {
    return false
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

// IPC Handler for checking if path exists

