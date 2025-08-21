"""
Fast Relay Control Service for USB relay control.

This service provides a lightweight FastAPI HTTP server for controlling USB relays
that can be used by the Electron/React frontend.

Author: Assistant
Date: August 21, 2025
"""

import asyncio
import logging
import os
import threading
import time
from contextlib import asynccontextmanager
from datetime import datetime
from typing import Optional

import hid
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel

# Configure logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s'
)
logger = logging.getLogger("fast_relay_service")

# Global relay device handle
relay_device = None

# USB Relay constants
RELAY_VID = 0x16C0  # Vendor ID
RELAY_PID = 0x05DF  # Product ID

@asynccontextmanager
async def lifespan(app: FastAPI):
    """Manage startup and shutdown events."""
    global relay_device
    
    # Startup
    logger.info("Starting Fast Relay Service...")
    
    # Try to connect to relay device
    try:
        relay_device = await asyncio.to_thread(init_relay_device)
        if relay_device:
            logger.info("Connected to USB Relay device (0x16C0:0x05DF)")
        else:
            logger.warning("Could not connect to USB Relay device on startup")
    except Exception as e:
        logger.error(f"Error during startup: {e}")
    
    yield
    
    # Shutdown
    logger.info("Shutting down Fast Relay Service...")
    
    if relay_device:
        try:
            # Turn off all relays
            await asyncio.to_thread(control_multiple_relays_sync, 0)
            # Close device
            await asyncio.to_thread(relay_device.close)
        except Exception as e:
            logger.error(f"Error during shutdown: {e}")
        finally:
            relay_device = None

app = FastAPI(
    title="Fast Relay Service",
    description="USB Relay Control API",
    version="1.0.0",
    lifespan=lifespan
)

# Request/Response models
class RelayControlRequest(BaseModel):
    relay: int
    state: bool

class RelayBitmaskRequest(BaseModel):
    bitmask: int

class RelayTestRequest(BaseModel):
    cycles: int = 1
    delay_ms: int = 800

################################################################################
# USB Relay low-level functions
################################################################################

def init_relay_device():
    """Initialize and connect to USB relay device."""
    global relay_device
    
    try:
        # Find the relay device
        devices = hid.enumerate(RELAY_VID, RELAY_PID)
        if not devices:
            logger.error(f"No USB Relay device found (VID: 0x{RELAY_VID:04X}, PID: 0x{RELAY_PID:04X})")
            return None
        
        device_info = devices[0]
        logger.info(f"Found USB Relay device: {device_info}")
        
        # Open the device
        device = hid.device()
        device.open(RELAY_VID, RELAY_PID)
        device.set_nonblocking(1)
        
        logger.info(f"Connected to USB Relay device (0x{RELAY_VID:04X}:0x{RELAY_PID:04X})")
        return device
        
    except Exception as e:
        logger.error(f"Failed to initialize relay device: {e}")
        return None

def control_relay_sync(relay_num: int, state: bool) -> bool:
    """Control a single relay synchronously using correct format."""
    global relay_device
    
    if not relay_device:
        return False
    
    try:
        if state:
            # Turn ON: [0x00, 0xFF, relay_num, 0x01, 0x00, 0x00, 0x00, 0x00, 0x00]
            feature_data = [0x00, 0xFF, relay_num, 0x01, 0x00, 0x00, 0x00, 0x00, 0x00]
        else:
            # Turn OFF: [0x00, 0xFD, relay_num, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00]
            feature_data = [0x00, 0xFD, relay_num, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00]
        
        result = relay_device.send_feature_report(feature_data)
        time.sleep(0.01)  # Small delay for relay response
        
        logger.debug(f"Relay {relay_num} {'ON' if state else 'OFF'} - Result: {result} bytes")
        return result > 0
        
    except Exception as e:
        logger.error(f"Error controlling relay {relay_num}: {e}")
        return False

def control_multiple_relays_sync(bitmask: int) -> bool:
    """Control multiple relays using bitmask synchronously."""
    global relay_device
    
    if not relay_device:
        return False
    
    try:
        if bitmask == 0:
            # Special case: Turn off all relays
            feature_data = [0x00, 0xFC, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00]
        else:
            # Bitmask control: [0x00, 0xFF, bitmask, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00]
            feature_data = [0x00, 0xFF, bitmask, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00]
        
        result = relay_device.send_feature_report(feature_data)
        time.sleep(0.01)  # Small delay for relay response
        
        logger.debug(f"Bitmask 0x{bitmask:02X} - Result: {result} bytes")
        return result > 0
        
    except Exception as e:
        logger.error(f"Error controlling multiple relays: {e}")
        return False

################################################################################
# API Endpoints
################################################################################

@app.get("/healthz")
async def healthz():
    """Simple health check endpoint for service monitoring."""
    return {"status": "ok", "timestamp": datetime.utcnow().isoformat()}

@app.get("/health")
async def health():
    """Health check with relay connection status."""
    global relay_device
    connected = relay_device is not None
    return {
        "status": "ok",
        "connected": connected,
        "timestamp": datetime.utcnow().isoformat(),
        "service": "Fast Relay Service"
    }

@app.get("/device-info")
async def device_info():
    """Get USB relay device information."""
    global relay_device
    if relay_device:
        return {
            "success": True,
            "connected": True,
            "device": "USB Relay 4-Channel",
            "vendor_id": "0x16C0",
            "product_id": "0x05DF",
            "description": "USBRelay4 (HIDRelay)"
        }
    else:
        return {
            "success": False,
            "connected": False,
            "message": "No relay device connected"
        }

@app.post("/connect")
async def connect():
    """Connect to USB relay device."""
    global relay_device
    
    if relay_device:
        return {
            "success": True,
            "message": "Already connected to USB Relay",
            "connected": True
        }
    
    # Try to initialize connection
    try:
        relay_device = await asyncio.to_thread(init_relay_device)
        if relay_device:
            return {
                "success": True,
                "message": "Connected to USB Relay successfully",
                "connected": True
            }
        else:
            return {
                "success": False,
                "message": "Failed to connect to USB Relay device",
                "connected": False
            }
    except Exception as e:
        logger.error(f"Error connecting to relay: {e}")
        return {
            "success": False,
            "message": f"Connection error: {str(e)}",
            "connected": False
        }

@app.post("/disconnect")
async def disconnect():
    """Disconnect from USB relay device."""
    global relay_device
    
    if not relay_device:
        return {
            "success": True,
            "message": "Already disconnected",
            "connected": False
        }
    
    try:
        # Turn off all relays before disconnect
        await asyncio.to_thread(control_multiple_relays_sync, 0)
        await asyncio.to_thread(relay_device.close)
        relay_device = None
        return {
            "success": True,
            "message": "Disconnected from USB Relay",
            "connected": False
        }
    except Exception as e:
        logger.error(f"Error disconnecting relay: {e}")
        relay_device = None  # Force disconnect
        return {
            "success": True,
            "message": "Disconnected (with errors)",
            "connected": False
        }

@app.post("/control")
async def control_relay(request: RelayControlRequest):
    """Control individual relay."""
    global relay_device
    
    if not relay_device:
        raise HTTPException(
            status_code=503,
            detail="USB Relay device not connected"
        )
    
    if not 1 <= request.relay <= 4:
        raise HTTPException(
            status_code=400,
            detail="Relay number must be between 1 and 4"
        )
    
    try:
        success = await asyncio.to_thread(
            control_relay_sync, 
            request.relay, 
            request.state
        )
        
        if success:
            state_str = "ON" if request.state else "OFF"
            return {
                "success": True,
                "message": f"Relay {request.relay} turned {state_str}",
                "relay": request.relay,
                "state": request.state
            }
        else:
            raise HTTPException(
                status_code=500,
                detail=f"Failed to control relay {request.relay}"
            )
            
    except Exception as e:
        logger.error(f"Error controlling relay {request.relay}: {e}")
        raise HTTPException(
            status_code=500,
            detail=f"Relay control error: {str(e)}"
        )

@app.post("/control-bitmask")
async def control_bitmask(request: RelayBitmaskRequest):
    """Control multiple relays with bitmask."""
    global relay_device
    
    if not relay_device:
        raise HTTPException(
            status_code=503,
            detail="USB Relay device not connected"
        )
    
    if not 0 <= request.bitmask <= 15:
        raise HTTPException(
            status_code=400,
            detail="Bitmask must be between 0 and 15"
        )
    
    try:
        success = await asyncio.to_thread(
            control_multiple_relays_sync, 
            request.bitmask
        )
        
        if success:
            return {
                "success": True,
                "message": f"Relays controlled with bitmask 0x{request.bitmask:02X}",
                "bitmask": request.bitmask
            }
        else:
            raise HTTPException(
                status_code=500,
                detail="Failed to control relays with bitmask"
            )
            
    except Exception as e:
        logger.error(f"Error controlling relays with bitmask {request.bitmask}: {e}")
        raise HTTPException(
            status_code=500,
            detail=f"Bitmask control error: {str(e)}"
        )

@app.post("/turn-off-all")
async def turn_off_all():
    """Turn off all relays."""
    global relay_device
    
    if not relay_device:
        raise HTTPException(
            status_code=503,
            detail="USB Relay device not connected"
        )
    
    try:
        success = await asyncio.to_thread(control_multiple_relays_sync, 0)
        
        if success:
            return {
                "success": True,
                "message": "All relays turned OFF"
            }
        else:
            raise HTTPException(
                status_code=500,
                detail="Failed to turn off all relays"
            )
            
    except Exception as e:
        logger.error(f"Error turning off all relays: {e}")
        raise HTTPException(
            status_code=500,
            detail=f"Turn off error: {str(e)}"
        )

@app.post("/test-sequence")
async def test_sequence(request: RelayTestRequest):
    """Test sequence - turn relays on/off sequentially."""
    global relay_device
    
    if not relay_device:
        raise HTTPException(
            status_code=503,
            detail="USB Relay device not connected"
        )
    
    try:
        for cycle in range(request.cycles):
            # Turn on each relay sequentially
            for relay_num in range(1, 5):
                await asyncio.to_thread(control_relay_sync, relay_num, True)
                await asyncio.sleep(request.delay_ms / 1000.0)
                await asyncio.to_thread(control_relay_sync, relay_num, False)
                await asyncio.sleep(request.delay_ms / 1000.0)
        
        return {
            "success": True,
            "message": f"Test sequence completed - {request.cycles} cycles"
        }
        
    except Exception as e:
        logger.error(f"Error in test sequence: {e}")
        raise HTTPException(
            status_code=500,
            detail=f"Test sequence error: {str(e)}"
        )

@app.post("/test-bitmask-patterns")
async def test_bitmask_patterns(request: RelayTestRequest):
    """Test various bitmask patterns."""
    global relay_device
    
    if not relay_device:
        raise HTTPException(
            status_code=503,
            detail="USB Relay device not connected"
        )
    
    patterns = [0x01, 0x02, 0x04, 0x08, 0x03, 0x0C, 0x0F, 0x00]
    
    try:
        for cycle in range(request.cycles):
            for pattern in patterns:
                await asyncio.to_thread(control_multiple_relays_sync, pattern)
                await asyncio.sleep(request.delay_ms / 1000.0)
        
        # Reset to all off
        await asyncio.to_thread(control_multiple_relays_sync, 0)
        
        return {
            "success": True,
            "message": f"Bitmask pattern test completed - {request.cycles} cycles"
        }
        
    except Exception as e:
        logger.error(f"Error in bitmask pattern test: {e}")
        raise HTTPException(
            status_code=500,
            detail=f"Bitmask test error: {str(e)}"
        )

@app.post("/sequence-test")
async def sequence_test():
    """Sequence test - loop open full relay sequentially once."""
    global relay_device
    
    if not relay_device:
        raise HTTPException(
            status_code=503,
            detail="USB Relay device not connected"
        )
    
    try:
        # Fixed sequence: Turn on all relays sequentially, then turn off all
        for relay_num in range(1, 5):
            await asyncio.to_thread(control_relay_sync, relay_num, True)
            await asyncio.sleep(0.5)  # 500ms delay
        
        # Wait a bit with all on
        await asyncio.sleep(1.0)
        
        # Turn off all
        await asyncio.to_thread(control_multiple_relays_sync, 0)
        
        return {
            "success": True,
            "message": "Sequence test completed - full relay loop"
        }
        
    except Exception as e:
        logger.error(f"Error in sequence test: {e}")
        raise HTTPException(
            status_code=500,
            detail=f"Sequence test error: {str(e)}"
        )

################################################################################
# Main entry point
################################################################################

if __name__ == "__main__":
    import uvicorn
    
    # Default port 5003 (after face=5002, alpr=5001)
    port = int(os.getenv("RELAY_SERVICE_PORT", 5003))
    host = os.getenv("RELAY_SERVICE_HOST", "127.0.0.1")

    print(f"Starting Fast Relay Service on http://{host}:{port}")
    print("API documentation available at: http://127.0.0.1:5003/docs")
    print("Make sure USB Relay device is connected")
    print("Press Ctrl+C to stop the service")
    
    uvicorn.run(
        "fast_relay_service:app",
        host=host,
        port=port,
        reload=False,
        log_level="info"
    )
