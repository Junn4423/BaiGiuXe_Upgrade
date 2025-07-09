# MinIO Image Upload Integration Guide

## Overview

This integration replaces local image storage with MinIO object storage across multiple servers for redundancy and scalability in the parking lot management system.

## Files Created/Modified

### Backend Files
- **`upload.php`** - Main MinIO upload service with AWS4 authentication
- **`test_upload.html`** - Test interface for upload functionality

### Frontend Files
- **`api.js`** - Added MinIO upload functions
- **`imageUploadExamples.js`** - Example usage and utility functions

## Features

### ✅ Multiple Server Support
- Uploads to 3 MinIO servers simultaneously
- Returns success/failure status for each server
- Provides backup URLs for redundancy

### ✅ Filename Generation
- Automatic timestamp-based naming
- Format: `prefix_YYYY-MM-DDTHH-mm-ss-sssZ.ext`
- Examples:
  - `license_plate_2025-07-09T03-31-30-958Z.jpg`
  - `license_plate_out_2025-07-09T03-49-29-158Z.jpg`
  - `khuon_mat_2025-07-09T03-31-35-478Z.jpg`

### ✅ File Validation
- MIME type validation
- File size limits (10MB max)
- Security sanitization

### ✅ Error Handling
- Comprehensive error reporting
- Fallback mechanisms
- Detailed logging

## API Usage

### Frontend Functions

```javascript
import { 
  uploadLicensePlateImage, 
  uploadLicensePlateOutImage, 
  uploadFaceImage,
  uploadImageToMinIO 
} from '../api/api.js';

// Upload entry license plate image
const entryResult = await uploadLicensePlateImage(imageFile);

// Upload exit license plate image
const exitResult = await uploadLicensePlateOutImage(imageFile);

// Upload driver face image
const faceResult = await uploadFaceImage(imageFile);

// Custom upload with prefix
const customResult = await uploadImageToMinIO(imageFile, 'custom_prefix');
```

### Response Format

```javascript
{
  success: true,
  filename: "license_plate_2025-07-09T03-31-30-958Z.jpg",
  results: [
    {
      server: "MinIO-1",
      status: "success", 
      url: "http://192.168.1.19:9000/parking-lot-images/license_plate_2025-07-09T03-31-30-958Z.jpg"
    },
    {
      server: "MinIO-2",
      status: "success",
      url: "http://192.168.1.90:9000/parking-lot-images/license_plate_2025-07-09T03-31-30-958Z.jpg"
    },
    {
      server: "MinIO-3", 
      status: "success",
      url: "http://192.168.1.94:9000/parking-lot-images/license_plate_2025-07-09T03-31-30-958Z.jpg"
    }
  ],
  urls: ["http://192.168.1.19:9000/...", "http://192.168.1.90:9000/...", "http://192.168.1.94:9000/..."],
  primaryUrl: "http://192.168.1.19:9000/parking-lot-images/license_plate_2025-07-09T03-31-30-958Z.jpg"
}
```

## Integration with Existing Code

### 1. Replace Local Image Saving

**Before (Local Storage):**
```javascript
// Save image locally
const imagePath = saveImageLocally(imageBlob);
const sessionData = {
  anhVao: imagePath,
  // ...other data
};
```

**After (MinIO Storage):**
```javascript
// Upload to MinIO
const uploadResult = await uploadLicensePlateImage(imageBlob);
const sessionData = {
  anhVao: uploadResult.primaryUrl,
  // ...other data
};
```

### 2. Vehicle Entry Process

```javascript
import { uploadLicensePlateImage, uploadFaceImage } from '../api/api.js';

async function handleVehicleEntry(vehicleData, plateImage, faceImage) {
  try {
    // Upload images in parallel
    const [plateUpload, faceUpload] = await Promise.all([
      uploadLicensePlateImage(plateImage),
      uploadFaceImage(faceImage)
    ]);
    
    // Create session with MinIO URLs
    const sessionData = {
      ...vehicleData,
      anhVao: plateUpload.primaryUrl,
      anhMatVao: faceUpload.primaryUrl
    };
    
    // Save session to database
    return await themPhienGuiXe(sessionData);
    
  } catch (error) {
    console.error('Vehicle entry failed:', error);
    throw error;
  }
}
```

### 3. Vehicle Exit Process

```javascript
async function handleVehicleExit(sessionId, plateImage, faceImage) {
  try {
    // Upload exit images
    const [plateUpload, faceUpload] = await Promise.all([
      uploadLicensePlateOutImage(plateImage),
      uploadFaceImage(faceImage)
    ]);
    
    // Update session with exit data
    const updateData = {
      maPhien: sessionId,
      anhRa: plateUpload.primaryUrl,
      anhMatRa: faceUpload.primaryUrl,
      gioRa: new Date().toISOString()
    };
    
    return await capNhatPhienGuiXe(updateData);
    
  } catch (error) {
    console.error('Vehicle exit failed:', error);
    throw error;
  }
}
```

## Configuration

### MinIO Server Settings (upload.php)

```php
$minioServers = [
    [
        'name' => 'MinIO-1',
        'endpoint' => '192.168.1.19:9000',
        'accessKey' => 'minioadmin',
        'secretKey' => 'minioadmin',
        'bucket' => 'parking-lot-images',
        'region' => 'us-east-1'
    ],
    // ... additional servers
];
```

### Frontend API URL (url.js)

```javascript
export const url_api = "http://192.168.1.94/parkinglot/services.sof.vn/index.php"
// Upload URL will be automatically derived as:
// "http://192.168.1.94/parkinglot/services.sof.vn/upload.php"
```

## Testing

### 1. Backend Test
1. Open `http://192.168.1.94/parkinglot/services.sof.vn/test_upload.html`
2. Select image files and test uploads
3. Verify responses from all MinIO servers

### 2. Postman Test
```
POST http://192.168.1.94/parkinglot/services.sof.vn/upload.php
Body: form-data
- image: [select file]
- filename: license_plate_2025-07-09T03-31-30-958Z.jpg
```

### 3. Frontend Integration Test
```javascript
// Test in browser console
import { uploadLicensePlateImage } from './api/api.js';

const fileInput = document.querySelector('input[type="file"]');
const file = fileInput.files[0];
const result = await uploadLicensePlateImage(file);
console.log(result);
```

## Database Schema Updates

Consider updating your database schema to store multiple image URLs for redundancy:

```sql
-- Option 1: Store primary URL (existing)
ALTER TABLE pm_nc0009 
ADD COLUMN anhVao_backup TEXT,
ADD COLUMN anhRa_backup TEXT,
ADD COLUMN anhMatVao_backup TEXT,
ADD COLUMN anhMatRa_backup TEXT;

-- Option 2: Store JSON array of all URLs
ALTER TABLE pm_nc0009 
ADD COLUMN anhVao_urls JSON,
ADD COLUMN anhRa_urls JSON,
ADD COLUMN anhMatVao_urls JSON,
ADD COLUMN anhMatRa_urls JSON;
```

## Error Handling

### Upload Failures
- If upload fails to all servers: Show error to user
- If upload succeeds to some servers: Use successful URL, log partial failure
- Store backup URLs for redundancy

### Image Access Failures
- Try primary URL first
- Fallback to backup URLs if primary fails
- Implement health checking for MinIO servers

## Security Considerations

1. **Authentication**: Uses AWS4 signature authentication
2. **File Validation**: MIME type and size validation
3. **Filename Sanitization**: Prevents directory traversal
4. **Access Control**: Configure MinIO bucket policies appropriately

## Performance Optimization

1. **Parallel Uploads**: Upload to all servers simultaneously
2. **File Size Limits**: 10MB maximum to prevent timeouts
3. **Connection Timeouts**: 30 seconds with 10 second connect timeout
4. **Image Compression**: Consider client-side compression for large images

## Migration from Local Storage

1. **Backup existing images** before migration
2. **Update upload functions** to use MinIO
3. **Test thoroughly** with small batches
4. **Update database references** to use URLs instead of local paths
5. **Implement fallback** for accessing old local images during transition

## Monitoring

Monitor upload success rates and implement alerting:
- Track upload failures per server
- Monitor response times
- Set up health checks for MinIO servers
- Log upload statistics for analysis

## Troubleshooting

### Common Issues
1. **CORS errors**: Check CORS headers in upload.php
2. **Authentication failures**: Verify MinIO credentials
3. **Network timeouts**: Check MinIO server connectivity
4. **File size errors**: Verify PHP upload limits

### Debug Mode
Enable error reporting in upload.php for development:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```
