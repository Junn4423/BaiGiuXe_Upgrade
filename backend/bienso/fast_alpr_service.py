"""
Fast ALPR micro-service for real-time licence-plate detection.

The service wraps the `fast_alpr` python package behind a small FastAPI
HTTP server so that the Electron/React frontend can send frames and obtain
bounding-box + plate text information in ~15 fps real-time.

Endpoints
---------
POST /detect
    Multipart/form-data with an image file field named `file`. Returns JSON::
        {
            "success": true,
            "results": [
                {
                    "plate": "30A-123.45",
                    "bbox": [x, y, w, h],   # pixels
                    "confidence": 0.92
                },
                ...
            ]
        }

GET  /healthz
    Liveness probe – always returns {"status": "ok"}.

Run standalone::

    python fast_alpr_service.py  # serve on http://127.0.0.1:5001

Notes
-----
1.  The model is loaded **once** at start-up then kept in memory so each
    request is lightweight.
2.  CORS is fully open because the Electron frontend is served from the
    `file://` protocol in production and from `http://localhost:3000` in
    development.
3.  For best performance on Windows you should install `fast_alpr` with GPU
    support and run inside the existing `backend/bienso/venv` virtualenv.
"""

from __future__ import annotations

import io
import os
import sys
from typing import List, Tuple, Dict, Any

import cv2  # type: ignore
import numpy as np  # type: ignore
from fastapi import FastAPI, File, UploadFile, Response
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel

try:
    # Importing fast_alpr – depending on exact package name the user installed.
    # We first try `fast_alpr` then fall back to `fastalpr` for compatibility.
    from fast_alpr import ALPR  # type: ignore
except ModuleNotFoundError:
    try:
        from fastalpr import ALPR  # type: ignore
    except ModuleNotFoundError as exc:
        print("❌  Could not import fast_alpr / fastalpr. Make sure it is installed in the Python environment.", file=sys.stderr)
        raise exc

################################################################################
# Configuration
################################################################################

# Country code. Adjust to your locale, e.g. "vn" for Vietnam if supported by the
# underlying model. Most generic models use "us".
COUNTRY = os.getenv("ALPR_COUNTRY", "vn")
# Region or config folder – leave blank for default
CONFIG = os.getenv("ALPR_CONFIG", "")
# Should we try to use GPU? Set environment variable USE_GPU=1
USE_GPU = os.getenv("USE_GPU", "0") == "1"

# Load ALPR once at startup
print("🚀 Loading ALPR model…", file=sys.stderr)
alpr = ALPR(
    detector_model='yolo-v9-t-384-license-plate-end2end',
    ocr_model='cct-xs-v1-global-model',
    detector_conf_thresh=0.2,  # Lower threshold for Vietnamese plates
    ocr_device='auto'
)
print("✅ ALPR initialised", file=sys.stderr)

################################################################################
# FastAPI application
################################################################################

app = FastAPI(title="Fast ALPR Service", version="1.0.0")

# Allow the Electron frontend and dev server to call the API unrestricted.
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)


class Box(BaseModel):
    x: int
    y: int
    w: int
    h: int


class Detection(BaseModel):
    plate: str
    confidence: float
    bbox: Box


@app.get("/healthz")
def healthz():
    """Simple liveness probe."""
    return {"status": "ok"}


@app.post("/detect", response_model=Dict[str, Any])
async def detect(file: UploadFile = File(...)):
    """Detect licence-plates on a single image.

    The image is read into an OpenCV array and passed through FastALPR.
    """
    print(f"🔍 Received file: {file.filename}, size: {file.size if hasattr(file, 'size') else 'unknown'}", file=sys.stderr)
    
    image_bytes = await file.read()
    print(f"📦 Image bytes read: {len(image_bytes)} bytes", file=sys.stderr)
    
    img_array = np.frombuffer(image_bytes, dtype=np.uint8)
    image = cv2.imdecode(img_array, cv2.IMREAD_COLOR)

    if image is None:
        print("❌ Failed to decode image", file=sys.stderr)
        return {"success": False, "error": "Invalid image data"}

    print(f"🖼️ Image decoded successfully: {image.shape}", file=sys.stderr)

    # Perform detection. The API of FastALPR may vary; we normalise output.
    raw_results: List[Dict[str, Any]] = alpr.predict(image)
    print(f"🎯 Raw ALPR results: {raw_results}", file=sys.stderr)

    detections: List[Dict[str, Any]] = []
    for i, det in enumerate(raw_results):
        print(f"🔍 Processing detection {i}: {det}", file=sys.stderr)
        
        try:
            # Handle both dict-like objects and ALPRResult objects
            if hasattr(det, 'get'):
                # Dict-like object
                plate_text = det.get("plate") or det.get("text") or det.get("value")
                conf = float(det.get("confidence", det.get("score", 0.0)))
                bbox = det.get("bbox") or det.get("box") or det.get("coordinates")
            else:
                # ALPRResult object - access attributes properly
                plate_text = None
                conf = 0.0
                bbox = None
                
                # Extract OCR text
                if hasattr(det, 'ocr') and det.ocr:
                    plate_text = det.ocr.text
                    if hasattr(det.ocr, 'confidence'):
                        conf = float(det.ocr.confidence)
                
                # Extract detection confidence and bbox
                if hasattr(det, 'detection') and det.detection:
                    if hasattr(det.detection, 'confidence'):
                        # Use detection confidence if OCR confidence is not available
                        if conf == 0.0:
                            conf = float(det.detection.confidence)
                    
                    if hasattr(det.detection, 'bounding_box'):
                        bb = det.detection.bounding_box
                        if hasattr(bb, 'x1') and hasattr(bb, 'y1') and hasattr(bb, 'x2') and hasattr(bb, 'y2'):
                            # Convert from x1,y1,x2,y2 to x,y,w,h format
                            x = int(bb.x1)
                            y = int(bb.y1)
                            w = int(bb.x2 - bb.x1)
                            h = int(bb.y2 - bb.y1)
                            bbox = [x, y, w, h]
            
            print(f"📋 Plate: {plate_text}, Conf: {conf}, BBox: {bbox}", file=sys.stderr)
            
            # Skip if no plate text detected
            if not plate_text:
                print(f"❌ No plate text found for detection {i}", file=sys.stderr)
                continue
            
            # Process bbox
            x, y, w, h = None, None, None, None
            if bbox and len(bbox) == 4:
                x, y, w, h = map(int, bbox)
            elif bbox and len(bbox) == 2 and all(len(pt) == 2 for pt in bbox):
                # List of corner points [[x1,y1],[x2,y2]] → derive w/h
                x1, y1 = bbox[0]
                x2, y2 = bbox[1]
                x, y = int(x1), int(y1)
                w, h = int(x2 - x1), int(y2 - y1)
            else:
                # Skip invalid bbox
                print(f"❌ Invalid bbox format for detection {i}: {bbox}", file=sys.stderr)
                continue

            # Ensure all bbox values are valid
            if x is None or y is None or w is None or h is None or w <= 0 or h <= 0:
                print(f"❌ Invalid bbox dimensions for detection {i}: x={x}, y={y}, w={w}, h={h}", file=sys.stderr)
                continue

            detections.append({
                "plate": plate_text,
                "confidence": round(conf, 4),
                "bbox": {"x": x, "y": y, "w": w, "h": h},
            })
        except Exception as e:
            print(f"❌ Error processing detection {i}: {e}", file=sys.stderr)
            continue

    print(f"✅ Final detections: {len(detections)} plates found", file=sys.stderr)
    return {"success": True, "results": detections}


################################################################################
# Entrypoint
################################################################################

def main():
    import argparse

    parser = argparse.ArgumentParser(description="Fast ALPR detection service")
    parser.add_argument("--host", default="127.0.0.1", help="Bind host (default 127.0.0.1)")
    parser.add_argument("--port", type=int, default=5001, help="Bind port (default 5001)")
    parser.add_argument("--workers", type=int, default=1, help="Uvicorn worker processes")
    args = parser.parse_args()

    # Run with UVicorn
    uvicorn_kwargs = dict(
        host=args.host,
        port=args.port,
        workers=args.workers,
        log_level="info",
    )
    try:
        import uvicorn  # type: ignore
    except ImportError:
        print("❌  uvicorn is required. Install with `pip install uvicorn fastapi`.", file=sys.stderr)
        sys.exit(1)

    uvicorn.run("fast_alpr_service:app", **uvicorn_kwargs, factory=False, reload=False)


if __name__ == "__main__":
    main()
