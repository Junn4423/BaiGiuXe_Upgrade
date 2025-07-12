#!/bin/bash

echo "Building Parking Lot Management for all platforms..."
echo ""

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    echo "Error: Node.js is not installed or not in PATH"
    exit 1
fi

# Check if npm is installed
if ! command -v npm &> /dev/null; then
    echo "Error: npm is not installed or not in PATH"
    exit 1
fi

echo "Step 1: Installing dependencies..."
npm install
if [ $? -ne 0 ]; then
    echo "Error: Failed to install dependencies"
    exit 1
fi

echo ""
echo "Step 2: Building React frontend..."
cd ../frontend
npm install
npm run build
if [ $? -ne 0 ]; then
    echo "Error: Failed to build frontend"
    exit 1
fi

echo ""
echo "Step 3: Building Electron app for all platforms..."
cd ../electron-app

echo "Building for Windows..."
npm run build-win
if [ $? -ne 0 ]; then
    echo "Warning: Failed to build for Windows"
fi

echo "Building for macOS..."
npm run build-mac
if [ $? -ne 0 ]; then
    echo "Warning: Failed to build for macOS"
fi

echo "Building for Linux..."
npm run build-linux
if [ $? -ne 0 ]; then
    echo "Warning: Failed to build for Linux"
fi

echo ""
echo "Build process completed!"
echo "Check the 'dist' folder for the installers."
echo ""
