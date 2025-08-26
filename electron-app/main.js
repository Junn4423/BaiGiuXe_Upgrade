const { app, BrowserWindow, ipcMain, dialog } = require("electron");
const path = require("path");
const fs = require("fs").promises;
const RTSPStreamingServer = require("./rtsp-streaming-server");
const { spawn } = require("child_process");
let alprProcess;
let faceRecognitionProcess; // Face Recognition service process
let relayServiceProcess; // Relay service process
let pythonInstallProcess;

// Import USB Relay Control HTTP API
let RelayControlAPI;
try {
  RelayControlAPI = require("../frontend/src/services/relayControlHTTP.js");
  console.log("✅ USB Relay Control HTTP module loaded");
} catch (error) {
  console.warn(
    "⚠️ USB Relay Control HTTP module not available:",
    error.message
  );
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
 * Start Face Recognition Service
 */
async function startFaceRecognitionService() {
  try {
    console.log("▶️ Starting Face Recognition service...");

    // Check if already running
    if (faceRecognitionProcess) {
      console.log("ℹ️ Face Recognition service already running");
      return true;
    }

    // Determine paths based on app packaging
    const devScriptPath = path.join(
      __dirname,
      "..",
      "backend",
      "khuonmat",
      "manage_face_recognition.bat"
    );
    const prodScriptPath = path.join(
      __dirname,
      "backend",
      "khuonmat",
      "manage_face_recognition.bat"
    );

    let scriptPath = fs.existsSync(devScriptPath)
      ? devScriptPath
      : prodScriptPath;

    if (!fs.existsSync(scriptPath)) {
      console.error("❌ Face Recognition script not found:", scriptPath);
      return false;
    }

    console.log("📄 Using Face Recognition script:", scriptPath);

    // Start Face Recognition service
    faceRecognitionProcess = spawn(scriptPath, ["start"], {
      cwd: path.dirname(scriptPath),
      stdio: ["ignore", "pipe", "pipe"],
      shell: true,
      detached: false,
    });

    faceRecognitionProcess.stdout.on("data", (data) => {
      console.log(`[Face Recognition] ${data.toString().trim()}`);
    });

    faceRecognitionProcess.stderr.on("data", (data) => {
      console.error(`[Face Recognition Error] ${data.toString().trim()}`);
    });

    faceRecognitionProcess.on("close", (code) => {
      console.log(`Face Recognition service exited with code ${code}`);
      faceRecognitionProcess = null;
    });

    faceRecognitionProcess.on("error", (error) => {
      console.error("❌ Failed to start Face Recognition service:", error);
      faceRecognitionProcess = null;
    });

    console.log("✅ Face Recognition service started successfully");
    return true;
  } catch (error) {
    console.error("❌ Error starting Face Recognition service:", error);
    return false;
  }
}

/**
 * Start Relay Service
 */
async function startRelayService() {
  try {
    console.log("Starting Fast Relay service...");

    // Check if already running
    if (relayServiceProcess) {
      console.log("Fast Relay service already running");
      return true;
    }

    // Determine batch file path based on app packaging
    let batPath;

    // Production path (when packaged) - use silent version for production
    const prodBatPath = path.join(
      __dirname,
      "backend",
      "relay",
      "run_fast_relay_service_silent.bat"
    );
    const prodBatPathVerbose = path.join(
      __dirname,
      "backend",
      "relay",
      "start_relay_service.bat"
    );

    // Development path
    const devBatPath = path.join(
      __dirname,
      "..",
      "backend",
      "relay",
      "start_relay_service.bat"
    );

    // Check which batch file exists
    try {
      await fs.access(prodBatPath);
      batPath = prodBatPath;
      console.log("Using production silent batch file");
    } catch {
      try {
        await fs.access(prodBatPathVerbose);
        batPath = prodBatPathVerbose;
        console.log("Using production verbose batch file");
      } catch {
        try {
          await fs.access(devBatPath);
          batPath = devBatPath;
          console.log("Using development batch file");
        } catch {
          console.error(
            "start_relay_service batch file not found in any location"
          );
          return false;
        }
      }
    }

    console.log("Relay service batch file path:", batPath);

    // Stop any existing relay service first
    if (relayServiceProcess) {
      console.log("Stopping existing relay service...");
      relayServiceProcess.kill();
      relayServiceProcess = null;
    }

    // Run the batch file
    relayServiceProcess = spawn("cmd", ["/c", batPath], {
      cwd: path.dirname(batPath),
      stdio: ["ignore", "pipe", "pipe"],
      shell: true,
      detached: false,
    });

    relayServiceProcess.stdout.on("data", (data) => {
      const output = data.toString().trim();
      if (output) {
        console.log(`[Relay Service] ${output}`);
      }
    });

    relayServiceProcess.stderr.on("data", (data) => {
      const output = data.toString().trim();
      if (output && !output.includes("WARNING") && !output.includes("INFO")) {
        console.error(`[Relay Service Error] ${output}`);
      }
    });

    relayServiceProcess.on("close", (code) => {
      console.log(`Fast Relay service exited with code ${code}`);
      relayServiceProcess = null;
    });

    relayServiceProcess.on("error", (error) => {
      console.error("Failed to start Fast Relay service:", error);
      relayServiceProcess = null;
    });

    // Wait a bit for the service to start
    await new Promise((resolve) => setTimeout(resolve, 3000));

    console.log("Fast Relay service started successfully");
    console.log("API documentation: http://127.0.0.1:5003/docs");
    return true;
  } catch (error) {
    console.error("Error starting Fast Relay service:", error);
    return false;
  }
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

    // Start Face Recognition service
    console.log("👤 Starting Face Recognition service...");
    try {
      const faceStarted = await startFaceRecognitionService();
      if (faceStarted) {
        console.log("✅ Face Recognition service started successfully");
      } else {
        console.warn(
          "⚠️ Face Recognition service failed to start - continuing without face recognition"
        );
      }
    } catch (faceError) {
      console.error("❌ Face Recognition service error:", faceError.message);
      console.warn("⚠️ Continuing without face recognition");
    }

    // Start Fast Relay service
    console.log("Starting Fast Relay service...");
    try {
      const relayStarted = await startRelayService();
      if (relayStarted) {
        console.log("Fast Relay service started successfully");
      } else {
        console.warn(
          "Fast Relay service failed to start - continuing without relay control"
        );
      }
    } catch (relayError) {
      console.error("Fast Relay service error:", relayError.message);
      console.warn("Continuing without relay control");
    }

    // Create the main window (always proceed)
    console.log("Creating main window...");
    createWindow();
    console.log("Application started successfully");
  } catch (error) {
    console.error("Critical error during startup:", error);

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
      console.error("Failed to create window:", windowError);
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

  if (faceRecognitionProcess) {
    console.log("Stopping Face Recognition service...");
    faceRecognitionProcess.kill();
  }

  if (relayServiceProcess) {
    console.log("Stopping Fast Relay service...");
    relayServiceProcess.kill();
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

  if (faceRecognitionProcess) {
    console.log("🛑 Stopping Face Recognition service before quit...");
    faceRecognitionProcess.kill("SIGTERM");

    // Force kill if not responsive
    setTimeout(() => {
      if (faceRecognitionProcess && !faceRecognitionProcess.killed) {
        console.log("🛑 Force killing Face Recognition service...");
        faceRecognitionProcess.kill("SIGKILL");
      }
    }, 3000);
  }

  if (relayServiceProcess) {
    console.log("🛑 Stopping Fast Relay service before quit...");
    relayServiceProcess.kill("SIGTERM");

    // Force kill if not responsive
    setTimeout(() => {
      if (relayServiceProcess && !relayServiceProcess.killed) {
        console.log("🛑 Force killing Fast Relay service...");
        relayServiceProcess.kill("SIGKILL");
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

// IPC Handler for reading image file as base64
ipcMain.handle("read-image-file", async (event, filePath) => {
  try {
    console.log(`📖 Reading image file: ${filePath}`);

    // Check if file exists
    await fs.access(filePath);

    // Read file and convert to base64
    const fileBuffer = await fs.readFile(filePath);
    const base64Data = fileBuffer.toString("base64");

    console.log(
      `✅ Successfully read image file: ${filePath} (${fileBuffer.length} bytes)`
    );
    return base64Data;
  } catch (error) {
    console.error(`❌ Error reading image file ${filePath}:`, error);
    throw new Error(`Cannot read image file: ${error.message}`);
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
      "Fast Relay Service không khả dụng. Hãy đảm bảo service đã được khởi động."
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

// Sequence test (new HTTP API endpoint)
ipcMain.handle(
  "relay-sequence-test",
  async (event, cycles = 1, delayMs = 1000) => {
    try {
      checkRelayControlAvailable();
      const result = await RelayControlAPI.sequenceTest(cycles, delayMs);
      console.log(
        `🧪 Sequence test completed via IPC (${cycles} cycles, ${delayMs}ms delay)`
      );
      return { success: true, result };
    } catch (error) {
      console.error("❌ Sequence test error via IPC:", error);
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

// ==================== CAMERA SYSTEM MANAGEMENT IPC HANDLERS ====================

// Restart entire camera system
ipcMain.handle("restart-camera-system", async () => {
  try {
    console.log("🔄 IPC: Restarting entire camera system...");

    const results = [];

    // Restart RTSP server
    try {
      if (rtspServer) {
        console.log("🛑 Stopping RTSP server...");
        rtspServer.stop();
        await new Promise((resolve) => setTimeout(resolve, 2000));
      }
      console.log("▶️ Starting RTSP server...");
      rtspServer = new RTSPStreamingServer();
      results.push("✅ RTSP server restarted");
    } catch (error) {
      results.push("❌ RTSP server error: " + error.message);
    }

    // Restart Face Recognition service
    try {
      if (faceRecognitionProcess) {
        console.log("🛑 Stopping Face Recognition service...");
        faceRecognitionProcess.kill("SIGTERM");
        await new Promise((resolve) => setTimeout(resolve, 3000));
        faceRecognitionProcess = null;
      }
      console.log("▶️ Starting Face Recognition service...");
      await startFaceRecognitionService();
      results.push("✅ Face Recognition service restarted");
    } catch (error) {
      results.push("❌ Face Recognition error: " + error.message);
    }

    // Restart ALPR service
    try {
      if (alprProcess) {
        console.log("🛑 Stopping ALPR service...");
        alprProcess.kill("SIGTERM");
        await new Promise((resolve) => setTimeout(resolve, 3000));
        alprProcess = null;
      }
      console.log("▶️ Starting ALPR service...");
      await startALPRService();
      results.push("✅ ALPR service restarted");
    } catch (error) {
      results.push("❌ ALPR error: " + error.message);
    }

    // Restart Fast Relay service
    try {
      if (relayServiceProcess) {
        console.log("🛑 Stopping Fast Relay service...");
        relayServiceProcess.kill("SIGTERM");
        await new Promise((resolve) => setTimeout(resolve, 3000));
        relayServiceProcess = null;
      }
      console.log("▶️ Starting Fast Relay service...");
      await startRelayService();
      results.push("✅ Fast Relay service restarted");
    } catch (error) {
      results.push("❌ Fast Relay error: " + error.message);
    }

    console.log("✅ Camera system restart completed");
    return {
      success: true,
      message: "Hệ thống camera đã được khởi động lại thành công",
      details: results,
    };
  } catch (error) {
    console.error("❌ Error restarting camera system:", error);
    return { success: false, error: error.message };
  }
});

// Restart RTSP Streaming Server
ipcMain.handle("restart-rtsp-server", async () => {
  try {
    console.log("🔄 IPC: Restarting RTSP streaming server...");

    if (rtspServer) {
      console.log("🛑 Stopping current RTSP server...");
      rtspServer.stop();
      await new Promise((resolve) => setTimeout(resolve, 2000)); // Wait 2s for cleanup
    }

    // Start new RTSP server
    console.log("▶️ Starting new RTSP server...");
    rtspServer = new RTSPStreamingServer();

    console.log("✅ RTSP server restarted successfully");
    return { success: true, message: "RTSP server restarted successfully" };
  } catch (error) {
    console.error("❌ Error restarting RTSP server:", error);
    return { success: false, error: error.message };
  }
});

// Stop RTSP Streaming Server
ipcMain.handle("stop-rtsp-server", async () => {
  try {
    console.log("🛑 IPC: Stopping RTSP streaming server...");

    if (rtspServer) {
      rtspServer.stop();
      rtspServer = null;
      console.log("✅ RTSP server stopped successfully");
    } else {
      console.log("ℹ️ RTSP server was not running");
    }

    return { success: true, message: "RTSP server stopped successfully" };
  } catch (error) {
    console.error("❌ Error stopping RTSP server:", error);
    return { success: false, error: error.message };
  }
});

// Restart Application
ipcMain.on("app-restart", () => {
  console.log("🔄 IPC: Restarting application...");

  // Cleanup before restart
  if (rtspServer) {
    rtspServer.stop();
  }
  if (alprProcess) {
    alprProcess.kill();
  }
  if (faceRecognitionProcess) {
    faceRecognitionProcess.kill();
  }
  if (relayServiceProcess) {
    relayServiceProcess.kill();
  }

  // Relaunch app and quit current instance
  app.relaunch();
  app.exit(0);
});

// Start RTSP Streaming Server
ipcMain.handle("start-rtsp-server", async () => {
  try {
    console.log("▶️ IPC: Starting RTSP streaming server...");

    if (rtspServer) {
      console.log("ℹ️ RTSP server already running");
    } else {
      rtspServer = new RTSPStreamingServer();
      console.log("✅ RTSP server started successfully");
    }

    return { success: true, message: "RTSP server started successfully" };
  } catch (error) {
    console.error("❌ Error starting RTSP server:", error);
    return { success: false, error: error.message };
  }
});

// Restart Face Recognition Service
ipcMain.handle("restart-face-service", async () => {
  try {
    console.log("🔄 IPC: Restarting Face Recognition service...");

    // Stop current face service if running
    if (faceRecognitionProcess) {
      console.log("🛑 Stopping current Face Recognition service...");
      faceRecognitionProcess.kill("SIGTERM");
      await new Promise((resolve) => setTimeout(resolve, 3000)); // Wait 3s for cleanup
      faceRecognitionProcess = null;
    }

    // Start new face service
    console.log("▶️ Starting new Face Recognition service...");
    await startFaceRecognitionService();

    console.log("✅ Face Recognition service restarted successfully");
    return {
      success: true,
      message: "Face Recognition service restarted successfully",
    };
  } catch (error) {
    console.error("❌ Error restarting Face Recognition service:", error);
    return { success: false, error: error.message };
  }
});

// Stop Face Recognition Service
ipcMain.handle("stop-face-service", async () => {
  try {
    console.log("🛑 IPC: Stopping Face Recognition service...");

    if (faceRecognitionProcess) {
      faceRecognitionProcess.kill("SIGTERM");
      faceRecognitionProcess = null;
      console.log("✅ Face Recognition service stopped successfully");
    } else {
      console.log("ℹ️ Face Recognition service was not running");
    }

    return {
      success: true,
      message: "Face Recognition service stopped successfully",
    };
  } catch (error) {
    console.error("❌ Error stopping Face Recognition service:", error);
    return { success: false, error: error.message };
  }
});

// Start Face Recognition Service
ipcMain.handle("start-face-service", async () => {
  try {
    console.log("▶️ IPC: Starting Face Recognition service...");

    if (faceRecognitionProcess) {
      console.log("ℹ️ Face Recognition service already running");
    } else {
      await startFaceRecognitionService();
      console.log("✅ Face Recognition service started successfully");
    }

    return {
      success: true,
      message: "Face Recognition service started successfully",
    };
  } catch (error) {
    console.error("❌ Error starting Face Recognition service:", error);
    return { success: false, error: error.message };
  }
});

// Restart ALPR Service
ipcMain.handle("restart-alpr-service", async () => {
  try {
    console.log("🔄 IPC: Restarting ALPR service...");

    // Stop current ALPR service if running
    if (alprProcess) {
      console.log("🛑 Stopping current ALPR service...");
      alprProcess.kill("SIGTERM");
      await new Promise((resolve) => setTimeout(resolve, 3000)); // Wait 3s for cleanup
      alprProcess = null;
    }

    // Start new ALPR service
    console.log("▶️ Starting new ALPR service...");
    await startALPRService();

    console.log("✅ ALPR service restarted successfully");
    return { success: true, message: "ALPR service restarted successfully" };
  } catch (error) {
    console.error("❌ Error restarting ALPR service:", error);
    return { success: false, error: error.message };
  }
});

// Stop ALPR Service
ipcMain.handle("stop-alpr-service", async () => {
  try {
    console.log("🛑 IPC: Stopping ALPR service...");

    if (alprProcess) {
      alprProcess.kill("SIGTERM");
      alprProcess = null;
      console.log("✅ ALPR service stopped successfully");
    } else {
      console.log("ℹ️ ALPR service was not running");
    }

    return { success: true, message: "ALPR service stopped successfully" };
  } catch (error) {
    console.error("❌ Error stopping ALPR service:", error);
    return { success: false, error: error.message };
  }
});

// Start ALPR Service
ipcMain.handle("start-alpr-service", async () => {
  try {
    console.log("▶️ IPC: Starting ALPR service...");

    if (alprProcess) {
      console.log("ℹ️ ALPR service already running");
    } else {
      await startALPRService();
      console.log("✅ ALPR service started successfully");
    }

    return { success: true, message: "ALPR service started successfully" };
  } catch (error) {
    console.error("❌ Error starting ALPR service:", error);
    return { success: false, error: error.message };
  }
});

// IPC Handler for checking if path exists
