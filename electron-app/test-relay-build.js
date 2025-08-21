const fs = require("fs");
const path = require("path");

console.log("==============================================");
console.log("  RELAY SERVICE BUILD VERIFICATION TEST");
console.log("==============================================");

const buildPath = path.join(
  __dirname,
  "dist",
  "win-unpacked",
  "resources",
  "app.asar.unpacked",
  "backend",
  "relay"
);

const requiredFiles = [
  "fast_relay_service.py",
  "start_relay_service.bat",
  "stop_relay_service.bat",
  "SETUP_RELAY_SERVICE.bat",
  "requirements_relay_service.txt",
];

console.log(`\nChecking build path: ${buildPath}`);

let allFilesPresent = true;

requiredFiles.forEach((file) => {
  const filePath = path.join(buildPath, file);
  if (fs.existsSync(filePath)) {
    console.log(`✅ ${file} - FOUND`);
  } else {
    console.log(`❌ ${file} - MISSING`);
    allFilesPresent = false;
  }
});

console.log("\n==============================================");
if (allFilesPresent) {
  console.log("✅ ALL RELAY SERVICE FILES PRESENT IN BUILD");
  console.log("✅ RELAY SERVICE BUILD VERIFICATION PASSED");
} else {
  console.log("❌ SOME RELAY SERVICE FILES MISSING");
  console.log("❌ RELAY SERVICE BUILD VERIFICATION FAILED");
}
console.log("==============================================");
