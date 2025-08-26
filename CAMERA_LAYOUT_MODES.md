# Camera Layout Modes - Implementation Guide

## Overview

The parking system now supports 3 different camera layout modes based on user configuration selected in WorkConfigDialog.

## Mode Configurations

### 1. XE VÀO (Entry Mode) - `"vao"`

**Purpose**: Focused on vehicle entry processing
**Layout**: 2x2 Grid (4 panels)

**Components**:

- 1 Camera Biển Số (License Plate Camera)
- 1 Camera Khuôn Mặt (Face Recognition Camera)
- 1 Panel Ảnh Chụp Biển Số (License Plate Capture Panel)
- 1 Panel Ảnh Chụp Khuôn Mặt (Face Capture Panel)

**Behavior**:

- currentMode is locked to "vao"
- Spacebar switching is disabled
- Only entry cameras are active
- Images are captured to capture panels

### 2. XE RA (Exit Mode) - `"ra"`

**Purpose**: Focused on vehicle exit processing with entry reference
**Layout**: 3x2 Grid (6 panels)

**Components**:

- 1 Camera Biển Số (License Plate Camera - for exit)
- 1 Camera Khuôn Mặt (Face Recognition Camera - for exit)
- 2 Panel Ảnh Chụp Ra (Exit Capture Panels)
- 2 Panel Ảnh Vào (Entry Reference Panels)

**Behavior**:

- currentMode is locked to "ra"
- Spacebar switching is disabled
- Only exit cameras are active
- Exit images go to capture panels
- Entry reference images are shown in reference panels

### 3. 2 LUỒNG (Dual Lane Mode) - `"2luong"` (Default)

**Purpose**: Maintains current system behavior for dual-lane operation
**Layout**: 3x2 Grid (6 panels)

**Components**:

- 4 Cameras (2 for each lane: entry + exit, each with plate + face)
- 2 Panel Ảnh (Shared capture panels)

**Behavior**:

- Dynamic mode switching with spacebar (vao ↔ ra)
- All cameras available
- Current active mode determines which cameras are highlighted

## Implementation Details

### File Changes

#### 1. WorkConfigDialog.jsx

- Added 3 mode radio buttons with visual styling
- Saves selected mode to `localStorage.work_config.default_mode`

#### 2. CameraComponent.jsx

- Added `workConfig` prop
- Implemented 3 different render layouts:
  - `renderEntryModeLayout()` - 2x2 grid
  - `renderExitModeLayout()` - 3x2 grid with reference panels
  - `renderDualLaneLayout()` - 3x2 grid (original)
- Added state for reference images (`entryPlateReference`, `entryFaceReference`)
- Updated `displayEntryImagesAfterExit()` to handle reference panels

#### 3. CameraComponent.css

- Added CSS classes for new layouts:
  - `.camera-grid-entry-mode` - 2x2 grid
  - `.camera-grid-exit-mode` - 3x2 grid
  - `.camera-grid-dual-lane` - 3x2 grid
- Updated responsive breakpoints for all layouts

#### 4. main_UI.jsx

- Passed `workConfig` to CameraComponent
- Added useEffect to set currentMode from workConfig
- Updated spacebar handler to disable switching for entry/exit modes
- Added toast notification when spacebar is pressed in locked modes

### Configuration Storage

```javascript
// localStorage structure
work_config: {
  zone: "Zone Name",
  vehicle_type: "Vehicle Type Name",
  loai_xe: "oto|xe_may",
  ma_khu_vuc: "zone_code",
  default_mode: "vao|ra|2luong"  // NEW
}
```

### CSS Classes

```css
/* Mode-specific layouts */
.camera-grid-entry-mode    /* 2x2 grid for entry mode */
/* 2x2 grid for entry mode */
.camera-grid-exit-mode     /* 3x2 grid for exit mode */
.camera-grid-dual-lane     /* 3x2 grid for dual lane mode */

/* Mode selection styling */
.mode-option.selected.vao       /* Entry mode - green theme */
.mode-option.selected.ra        /* Exit mode - red theme */
.mode-option.selected.hai-luong; /* Dual lane - purple theme */
```

## User Experience

### Mode Selection

1. User opens WorkConfigDialog
2. Selects zone, vehicle type, and layout mode
3. Clicks "BẮT ĐẦU LÀM VIỆC"
4. System saves configuration and applies layout

### Mode Switching Constraints

- **Entry/Exit Modes**: Spacebar disabled, must restart to change
- **Dual Lane Mode**: Spacebar enabled for vao ↔ ra switching

### Visual Feedback

- Each mode has distinct color coding
- Clear descriptions for each mode
- Toast notification when spacebar is pressed in locked modes

## Testing

To test the implementation:

1. **Entry Mode Test**:

   - Select "XE VÀO" in WorkConfigDialog
   - Verify 2x2 layout with only entry cameras
   - Test spacebar blocking

2. **Exit Mode Test**:

   - Select "XE RA" in WorkConfigDialog
   - Verify 3x2 layout with exit cameras + reference panels
   - Test spacebar blocking

3. **Dual Lane Test**:

   - Select "2 LUỒNG" in WorkConfigDialog
   - Verify 3x2 layout with all cameras
   - Test spacebar switching vao ↔ ra

4. **Reference Image Test**:
   - In exit mode, process a vehicle exit
   - Verify entry images appear in reference panels
