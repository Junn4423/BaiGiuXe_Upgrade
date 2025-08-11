const { app, BrowserWindow, ipcMain, dialog } = require("electron");
const path = require("path");
const fs = require("fs").promises;
const RTSPStreamingServer = require("./rtsp-streaming-server");
const { spawn } = require("child_process");
let alprProcess;
let pythonInstallProcess;

// Import USB Relay Control
let RelayControlAPI;
try {
  RelayControlAPI = require("../frontend/src/services/relayControl.js");
  console.log("✅ USB Relay Control module loaded");
} catch (error) {
  console.warn("⚠️ USB Relay Control module not available:", error.message);
  RelayControlAPI = null;
}

// Global error handlers to prevent app crashes
process.on("uncaughtException", (error) => {
  console.error("❌ Uncaught Exception:", error);
  console.error("Stack:", error.stack);
  // Don't exit the app, just log the error
});

process.on("unhandledRejection", (reason, promise) => {
  console.error("❌ Unhandled Rejection at:", promise, "reason:", reason);
  console.error("Stack:", reason?.stack);
  // Don't exit the app, just log the error
});

/**
 * Run the Fast ALPR service using the batch file
 */
async function startALPRServiceViaBatch() {
  console.log("🚀 Starting Fast ALPR service via batch file...");

  // Determine batch file path based on app packaging
  let batPath;

  // Production path (when packaged) - use silent version for production
  const prodBatPath = path.join(
    __dirname,
    "backend",
    "bienso",
    "run_fast_alpr_service_silent.bat"
  );
  const prodBatPathVerbose = path.join(
    __dirname,
    "backend",
    "bienso",
    "run_fast_alpr_service.bat"
  );

  // Development path
  const devBatPath = path.join(
    __dirname,
    "..",
    "backend",
    "bienso",
    "run_fast_alpr_service.bat"
  );

  // Check which batch file exists
  try {
    await fs.access(prodBatPath);
    batPath = prodBatPath;
    console.log("🔧 Using production silent batch file");
  } catch {
    try {
      await fs.access(prodBatPathVerbose);
      batPath = prodBatPathVerbose;
      console.log("🔧 Using production verbose batch file");
    } catch {
      try {
        await fs.access(devBatPath);
        batPath = devBatPath;
        console.log("🔧 Using development batch file");
      } catch {
        console.error(
          "❌ run_fast_alpr_service batch file not found in any location"
        );
        return false;
      }
    }
  }

  console.log("🎯 Batch file path:", batPath);

  try {
    // Stop any existing ALPR process first
    if (alprProcess) {
      console.log("🛑 Stopping existing ALPR service...");
      alprProcess.kill();
      alprProcess = null;
    }

    // Run the batch file
    alprProcess = spawn("cmd", ["/c", batPath], {
      stdio: "pipe", // Capture output for logging
      cwd: path.dirname(batPath),
      env: {
        ...process.env,
      },
    });

    // Log output for debugging
    alprProcess.stdout.on("data", (data) => {
      const output = data.toString().trim();
      if (output) {
        console.log(`ALPR: ${output}`);
      }
    });

    alprProcess.stderr.on("data", (data) => {
      const output = data.toString().trim();
      if (output) {
        console.error(`ALPR Error: ${output}`);
      }
    });

    alprProcess.on("error", (err) => {
      console.error("❌ Failed to launch Fast ALPR service via batch:", err);
      if (err.code === "ENOENT") {
        console.error("💡 Batch file not found or cmd.exe not available");
      }
      alprProcess = null;
    });

    alprProcess.on("exit", (code, signal) => {
      console.log(
        `ℹ️ Fast ALPR batch service exited with code=${code} signal=${signal}`
      );
      alprProcess = null;

      // Auto-restart if exit was unexpected
      if (code !== 0 && signal !== "SIGTERM" && signal !== "SIGKILL") {
        console.log("🔄 Attempting to restart ALPR service in 10 seconds...");
        setTimeout(() => {
          startALPRServiceViaBatch().catch((err) => {
            console.error("❌ ALPR restart failed:", err.message);
          });
        }, 10000);
      }
    });

    // Give the process a moment to start
    await new Promise((resolve) => setTimeout(resolve, 3000));

    console.log("✅ Fast ALPR service batch started successfully");
    return true;
  } catch (err) {
    console.error("❌ Exception while running ALPR batch:", err);
    alprProcess = null;
    return false;
  }
}

/**
 * Check if Python is installed and accessible
 */
function checkPythonInstallation() {
  return new Promise((resolve) => {
    // Try multiple Python commands
    const pythonCommands = ["python", "python3", "py"];
    let commandIndex = 0;

    function tryNextCommand() {
      if (commandIndex >= pythonCommands.length) {
        console.log("❌ No Python installation found");
        resolve(false);
        return;
      }

      const command = pythonCommands[commandIndex];
      console.log(`🐍 Trying Python command: ${command}`);

      const pythonCheck = spawn(command, ["--version"], { stdio: "pipe" });

      pythonCheck.on("close", (code) => {
        if (code === 0) {
          console.log(`✅ Python is accessible via: ${command}`);
          resolve(true);
        } else {
          commandIndex++;
          tryNextCommand();
        }
      });

      pythonCheck.on("error", (err) => {
        console.log(`❌ ${command} command failed:`, err.code || err.message);
        commandIndex++;
        tryNextCommand();
      });
    }

    tryNextCommand();
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
      const pythonCommands = ["python", "python3", "py"];
      let venvCreated = false;

      for (const pythonCmd of pythonCommands) {
        try {
          console.log(`🔧 Trying to create venv with: ${pythonCmd}`);
          const createVenv = spawn(pythonCmd, ["-m", "venv", "venv"], {
            cwd: biensoDirPath,
            stdio: "inherit",
          });

          await new Promise((resolve, reject) => {
            createVenv.on("close", (code) => {
              if (code === 0) {
                console.log("✅ Virtual environment created successfully");
                venvCreated = true;
                resolve();
              } else {
                reject(new Error(`Exit code: ${code}`));
              }
            });

            createVenv.on("error", (err) => {
              reject(err);
            });
          });

          if (venvCreated) break;
        } catch (err) {
          console.log(
            `❌ Failed to create venv with ${pythonCmd}:`,
            err.message
          );
        }
      }

      if (!venvCreated) {
        console.error(
          "❌ Failed to create virtual environment with any Python command"
        );
      }
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
    console.log(
      `📦 Installing Python dependencies in virtual environment: ${venvPath}`
    );

    // Install required packages directly instead of using requirements.txt
    const packages = [
      "fastapi",
      "uvicorn",
      "fast_alpr",
      "opencv-python",
      "numpy",
      "requests",
      "onnxruntime",
      "python-multipart",
    ];

    pythonInstallProcess = spawn(pipExePath, ["install", "--upgrade", "pip"], {
      stdio: "inherit",
      env: {
        ...process.env,
        VIRTUAL_ENV: venvPath,
        PATH: `${path.join(venvPath, "Scripts")};${process.env.PATH}`,
      },
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
            PATH: `${path.join(venvPath, "Scripts")};${process.env.PATH}`,
          },
        });

        installPackages.on("close", (installCode) => {
          if (installCode === 0) {
            console.log(
              "✅ Python dependencies installed successfully in virtual environment"
            );
            resolve(true);
          } else {
            console.error(
              "❌ Failed to install Python dependencies in virtual environment"
            );
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
  const devScriptPath = path.join(
    __dirname,
    "..",
    "backend",
    "bienso",
    "fast_alpr_service.py"
  );
  const prodScriptPath = path.join(
    __dirname,
    "backend",
    "bienso",
    "fast_alpr_service.py"
  );

  // Check for virtual environment and script paths
  try {
    await fs.access(prodVenvPath);
    await fs.access(prodScriptPath);
    venvPath = prodVenvPath;
    scriptPath = prodScriptPath;
    pythonExePath = path.join(prodVenvPath, "Scripts", "python.exe");
    console.log(
      "🔧 Using production ALPR service path with virtual environment"
    );
  } catch {
    try {
      await fs.access(devVenvPath);
      await fs.access(devScriptPath);
      venvPath = devVenvPath;
      scriptPath = devScriptPath;
      pythonExePath = path.join(devVenvPath, "Scripts", "python.exe");
      console.log(
        "🔧 Using development ALPR service path with virtual environment"
      );
    } catch {
      console.error(
        "❌ ALPR service script or virtual environment not found in either location"
      );
      return false;
    }
  }

  // Check if Python executable exists in virtual environment
  try {
    await fs.access(pythonExePath);
    console.log(
      "✅ Virtual environment Python executable found:",
      pythonExePath
    );
  } catch {
    console.error(
      "❌ Python executable not found in virtual environment:",
      pythonExePath
    );
    console.log("🔄 Falling back to system Python...");

    // Try different Python commands
    const pythonCommands = ["python", "python3", "py"];
    let foundPython = false;

    for (const cmd of pythonCommands) {
      try {
        const testProcess = spawn(cmd, ["--version"], { stdio: "pipe" });
        await new Promise((resolve, reject) => {
          testProcess.on("close", (code) => {
            if (code === 0) {
              pythonExePath = cmd;
              foundPython = true;
              console.log(`✅ Found system Python: ${cmd}`);
              resolve();
            } else {
              reject(new Error(`Exit code: ${code}`));
            }
          });
          testProcess.on("error", reject);
        });
        if (foundPython) break;
      } catch (err) {
        console.log(`❌ ${cmd} not available:`, err.message);
      }
    }

    if (!foundPython) {
      console.error(
        "❌ No Python installation found! ALPR service cannot start."
      );
      return false;
    }
  }

  console.log("🚀 Spawning Fast ALPR service:");
  console.log("   Script:", scriptPath);
  console.log("   Python:", pythonExePath);

  try {
    alprProcess = spawn(
      pythonExePath,
      [scriptPath, "--host", "127.0.0.1", "--port", "5001"],
      {
        stdio: "inherit",
        env: {
          ...process.env,
          PYTHONUNBUFFERED: "1",
          VIRTUAL_ENV: venvPath,
          PATH: `${path.join(venvPath, "Scripts")};${process.env.PATH}`,
        },
      }
    );

    alprProcess.on("error", (err) => {
      console.error("❌ Failed to launch Fast ALPR service:", err);
      if (err.code === "ENOENT") {
        console.error(
          "💡 Python executable not found. Please ensure Python is installed and in PATH."
        );
        console.error("💡 Tried to use:", pythonExePath);
      }
      alprProcess = null; // Reset to prevent hanging references
    });

    alprProcess.on("exit", (code, signal) => {
      console.log(
        `ℹ️ Fast ALPR service exited with code=${code} signal=${signal}`
      );
      alprProcess = null; // Reset to prevent hanging references

      // Auto-restart if exit was unexpected (but not too frequently)
      if (code !== 0 && signal !== "SIGTERM" && signal !== "SIGKILL") {
        console.log("🔄 Attempting to restart ALPR service in 10 seconds...");
        setTimeout(() => {
          startALPRService().catch((err) => {
            console.error("❌ ALPR restart failed:", err.message);
          });
        }, 10000); // Increased delay to prevent rapid restart loops
      }
    });

    // Give the process a moment to start and verify it's running
    await new Promise((resolve) => setTimeout(resolve, 2000));

    return true;
  } catch (err) {
    console.error("❌ Exception while spawning ALPR service:", err);
    return false;
  }
}

let mainWindow;
let rtspServer;

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
    show: false,
  });

  // Show window when ready
  mainWindow.once("ready-to-show", () => {
    mainWindow.show();
  });

  // Handle navigation errors
  mainWindow.webContents.on(
    "did-fail-load",
    (event, errorCode, errorDescription) => {
      console.error("Failed to load:", errorCode, errorDescription);
    }
  );

  // Debug FFmpeg in production
  if (process.env.NODE_ENV !== "development") {
    try {
      const { debugFFmpegPath } = require("./debug-ffmpeg");
      debugFFmpegPath();
    } catch (e) {
      console.error("Debug FFmpeg error:", e);
    }
  }

  // Load the React app
  const isDev = process.env.NODE_ENV === "development";

  if (isDev) {
    mainWindow.loadURL("http://localhost:3000");
  } else {
    // In production build, frontend is copied to build/ directory
    const indexPath = path.join(__dirname, "build", "index.html");
    console.log("Loading index.html from:", indexPath);

    // Check if file exists first
    const fs = require("fs");
    if (fs.existsSync(indexPath)) {
      console.log("✅ Index file exists, loading...");
      mainWindow.loadFile(indexPath);
    } else {
      console.error("❌ Index file not found at:", indexPath);
      // Try alternative path
      const altPath = path.join(__dirname, "../frontend/build/index.html");
      console.log("Trying alternative path:", altPath);
      if (fs.existsSync(altPath)) {
        mainWindow.loadFile(altPath);
      } else {
        console.error("❌ No index.html found in either location");
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
  startRTSPStreamingServer();
}

function startRTSPStreamingServer() {
  console.log("🔍 [DEBUG] Starting RTSP streaming server...");
  console.log("🔍 [DEBUG] Environment:", process.env.NODE_ENV);
  console.log("🔍 [DEBUG] App path:", __dirname);
  console.log("🔍 [DEBUG] Process:", process.execPath);

  try {
    rtspServer = new RTSPStreamingServer(9999);
    rtspServer.start();
    console.log("✅ RTSP streaming server started successfully on port 9999");
    console.log("🔍 [DEBUG] Server instance created and started");
  } catch (err) {
    console.error("❌ Failed to start RTSP streaming server:", err);
    console.error("🔍 [DEBUG] Error details:", {
      message: err.message,
      stack: err.stack,
    });
  }
}

// This method will be called when Electron has finished initialization
app.whenReady().then(async () => {
  try {
    console.log("🚀 Starting Parking Lot Management System...");

    // Start ALPR service using batch file (for end users)
    console.log("🐍 Starting Fast ALPR service...");
    try {
      const alprStarted = await startALPRServiceViaBatch();

      if (alprStarted) {
        console.log("✅ ALPR service started successfully via batch file");
      } else {
        console.warn(
          "⚠️ ALPR service failed to start via batch - trying direct method..."
        );

        // Fallback to direct Python method if batch fails
        console.log("🔄 Attempting direct Python method as fallback...");
        const pythonAvailable = await checkPythonInstallation();

        if (pythonAvailable) {
          const depsInstalled = await installPythonDependencies();
          if (depsInstalled) {
            const directStarted = await startALPRService();
            if (directStarted) {
              console.log(
                "✅ ALPR service started successfully via direct method"
              );
            } else {
              console.warn(
                "⚠️ Both batch and direct methods failed - continuing without license plate recognition"
              );
            }
          } else {
            console.warn("⚠️ Python dependencies installation failed");
          }
        } else {
          console.warn("⚠️ Python not available for fallback method");
        }
      }
    } catch (alprError) {
      console.error("❌ ALPR service error:", alprError.message);
      console.warn("⚠️ Continuing without license plate recognition");
    }

    // Create the main window (always proceed)
    console.log("🖥️ Creating main window...");
    createWindow();
    console.log("✅ Application started successfully");
  } catch (error) {
    console.error("❌ Critical error during startup:", error);

    // Show error dialog to user
    const { dialog } = require("electron");
    dialog.showErrorBox(
      "Startup Error",
      `Application failed to start properly:\n\n${error.message}\n\nThe app will continue to run but some features may not work.`
    );

    // Still try to create window
    try {
      createWindow();
    } catch (windowError) {
      console.error("❌ Failed to create window:", windowError);
      app.quit();
    }
  }

  app.on("activate", () => {
    if (BrowserWindow.getAllWindows().length === 0) createWindow();
  });
});

// Quit when all windows are closed
app.on("window-all-closed", () => {
  // Stop RTSP streaming server
  if (rtspServer) {
    console.log("Stopping RTSP streaming server...");
    rtspServer.stop();
  }

  if (alprProcess) {
    console.log("Stopping Fast ALPR service...");
    alprProcess.kill();
  }

  if (process.platform !== "darwin") app.quit();
});

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
});

// ==================== IPC HANDLERS FOR IMAGE SAVING ====================

// IPC Handler for saving images automatically
ipcMain.handle("save-image", async (event, { data, fileName, folder }) => {
  try {
    let fullFolderPath;

    // Check if folder is an absolute path
    if (path.isAbsolute(folder)) {
      fullFolderPath = folder;
    } else {
      // Use relative path from app documents folder
      const documentsPath = app.getPath("documents");
      const appFolderPath = path.join(documentsPath, "ParkingLotApp");
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
    console.error("❌ Error auto-saving image:", error);
    throw error;
  }
});

// IPC Handler for creating directories
ipcMain.handle("create-directory", async (event, dirPath) => {
  try {
    await fs.mkdir(dirPath, { recursive: true });
    console.log(`✅ Directory created: ${dirPath}`);
    return true;
  } catch (error) {
    console.error("❌ Error creating directory:", error);
    throw error;
  }
});

// IPC Handler for checking if path exists
ipcMain.handle("path-exists", async (event, pathToCheck) => {
  try {
    await fs.access(pathToCheck);
    return true;
  } catch (error) {
    return false;
  }
});

// IPC Handler for choosing custom save directory
ipcMain.handle("choose-save-directory", async () => {
  try {
    const result = await dialog.showOpenDialog(mainWindow, {
      properties: ["openDirectory", "createDirectory"],
      title: "Chọn thư mục lưu ảnh",
      buttonLabel: "Chọn thư mục",
    });

    if (!result.canceled && result.filePaths.length > 0) {
      return result.filePaths[0];
    }
    return null;
  } catch (error) {
    console.error("❌ Error choosing directory:", error);
    throw error;
  }
});

// IPC Handler for getting app paths
ipcMain.handle("get-app-paths", async () => {
  const documentsPath = app.getPath("documents");
  const appFolderPath = path.join(documentsPath, "ParkingLotApp");

  return {
    userData: app.getPath("userData"),
    documents: documentsPath,
    downloads: app.getPath("downloads"),
    desktop: app.getPath("desktop"),
    appFolder: appFolderPath,
    defaultImageFolder: path.join(appFolderPath, "assets", "imgAnhChup"),
  };
});

// IPC Handler for opening file explorer to show saved files
ipcMain.handle("show-in-explorer", async (event, filePath) => {
  try {
    const { shell } = require("electron");
    await shell.showItemInFolder(filePath);
    return true;
  } catch (error) {
    console.error("❌ Error opening explorer:", error);
    throw error;
  }
});

// ==================== USB RELAY CONTROL IPC HANDLERS ====================

// Helper function to check if relay control is available
function checkRelayControlAvailable() {
  if (!RelayControlAPI) {
    throw new Error(
      "USB Relay Control không khả dụng. Cần cài đặt node-hid package."
    );
  }
}

// Connect to USB Relay
ipcMain.handle("relay-connect", async () => {
  try {
    checkRelayControlAvailable();
    const result = await RelayControlAPI.connect();
    console.log("🔌 USB Relay connected via IPC");
    return { success: true, result };
  } catch (error) {
    console.error("❌ USB Relay connect error via IPC:", error);
    return { success: false, error: error.message };
  }
});

// Disconnect USB Relay
ipcMain.handle("relay-disconnect", async () => {
  try {
    checkRelayControlAvailable();
    RelayControlAPI.disconnect();
    console.log("🔌 USB Relay disconnected via IPC");
    return { success: true };
  } catch (error) {
    console.error("❌ USB Relay disconnect error via IPC:", error);
    return { success: false, error: error.message };
  }
});

// Control single relay
ipcMain.handle("relay-control", async (event, relayNum, state) => {
  try {
    checkRelayControlAvailable();
    const result = await RelayControlAPI.controlRelay(relayNum, state);
    console.log(`🎛️ Relay ${relayNum} ${state ? "ON" : "OFF"} via IPC`);
    return { success: true, result };
  } catch (error) {
    console.error(
      `❌ Relay control error via IPC (${relayNum}, ${state}):`,
      error
    );
    return { success: false, error: error.message };
  }
});

// Turn on relay
ipcMain.handle("relay-turn-on", async (event, relayNum) => {
  try {
    checkRelayControlAvailable();
    const result = await RelayControlAPI.turnOn(relayNum);
    console.log(`🔴 Relay ${relayNum} ON via IPC`);
    return { success: true, result };
  } catch (error) {
    console.error(`❌ Relay turn on error via IPC (${relayNum}):`, error);
    return { success: false, error: error.message };
  }
});

// Turn off relay
ipcMain.handle("relay-turn-off", async (event, relayNum) => {
  try {
    checkRelayControlAvailable();
    const result = await RelayControlAPI.turnOff(relayNum);
    console.log(`⚫ Relay ${relayNum} OFF via IPC`);
    return { success: true, result };
  } catch (error) {
    console.error(`❌ Relay turn off error via IPC (${relayNum}):`, error);
    return { success: false, error: error.message };
  }
});

// Turn off all relays
ipcMain.handle("relay-turn-off-all", async () => {
  try {
    checkRelayControlAvailable();
    const result = await RelayControlAPI.turnOffAll();
    console.log("⚫ All relays OFF via IPC");
    return { success: true, result };
  } catch (error) {
    console.error("❌ Turn off all relays error via IPC:", error);
    return { success: false, error: error.message };
  }
});

// Control relay with bitmask
ipcMain.handle("relay-control-bitmask", async (event, bitmask) => {
  try {
    checkRelayControlAvailable();
    const result = await RelayControlAPI.controlBitmask(bitmask);
    console.log(`🎯 Bitmask 0x${bitmask.toString(16).toUpperCase()} via IPC`);
    return { success: true, result };
  } catch (error) {
    console.error(
      `❌ Bitmask control error via IPC (0x${bitmask.toString(16)}):`,
      error
    );
    return { success: false, error: error.message };
  }
});

// Test sequence
ipcMain.handle(
  "relay-test-sequence",
  async (event, cycles = 1, delayMs = 1000) => {
    try {
      checkRelayControlAvailable();
      const result = await RelayControlAPI.testSequence(cycles, delayMs);
      console.log(`🧪 Test sequence completed via IPC (${cycles} cycles)`);
      return { success: true, result };
    } catch (error) {
      console.error("❌ Test sequence error via IPC:", error);
      return { success: false, error: error.message };
    }
  }
);

// Test bitmask patterns
ipcMain.handle(
  "relay-test-bitmask-patterns",
  async (event, cycles = 1, delayMs = 1500) => {
    try {
      checkRelayControlAvailable();
      const result = await RelayControlAPI.testBitmaskPatterns(cycles, delayMs);
      console.log(
        `🎯 Test bitmask patterns completed via IPC (${cycles} cycles)`
      );
      return { success: true, result };
    } catch (error) {
      console.error("❌ Test bitmask patterns error via IPC:", error);
      return { success: false, error: error.message };
    }
  }
);

// Get relay status
ipcMain.handle("relay-get-status", async () => {
  try {
    checkRelayControlAvailable();
    const result = RelayControlAPI.getStatus();
    return { success: true, result };
  } catch (error) {
    console.error("❌ Get relay status error via IPC:", error);
    return { success: false, error: error.message };
  }
});

// IPC Handler for checking if path exists
