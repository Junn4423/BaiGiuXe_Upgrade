// Example usage of MinIO image upload API
// This file demonstrates how to use the new upload functions

import { 
  uploadLicensePlateImage, 
  uploadLicensePlateOutImage, 
  uploadFaceImage,
  uploadImageToMinIO,
  generateParkingImageFilename 
} from '../api/api.js';

/**
 * Example: Upload license plate image on vehicle entry
 */
export async function handleVehicleEntryImage(imageFile) {
  try {
    console.log('🚗 Uploading entry license plate image...');
    
    const uploadResult = await uploadLicensePlateImage(imageFile);
    
    if (uploadResult.success) {
      console.log('✅ Entry image uploaded successfully:', {
        filename: uploadResult.filename,
        servers: uploadResult.results.filter(r => r.status === 'success').length,
        primaryUrl: uploadResult.primaryUrl
      });
      
      // Use the primary URL for database storage
      return {
        success: true,
        filename: uploadResult.filename,
        imageUrl: uploadResult.primaryUrl,
        backupUrls: uploadResult.urls
      };
    } else {
      throw new Error('Upload failed to all servers');
    }
  } catch (error) {
    console.error('❌ Failed to upload entry image:', error);
    throw error;
  }
}

/**
 * Example: Upload license plate image on vehicle exit
 */
export async function handleVehicleExitImage(imageFile) {
  try {
    console.log('🚗 Uploading exit license plate image...');
    
    const uploadResult = await uploadLicensePlateOutImage(imageFile);
    
    if (uploadResult.success) {
      console.log('✅ Exit image uploaded successfully:', {
        filename: uploadResult.filename,
        servers: uploadResult.results.filter(r => r.status === 'success').length,
        primaryUrl: uploadResult.primaryUrl
      });
      
      return {
        success: true,
        filename: uploadResult.filename,
        imageUrl: uploadResult.primaryUrl,
        backupUrls: uploadResult.urls
      };
    } else {
      throw new Error('Upload failed to all servers');
    }
  } catch (error) {
    console.error('❌ Failed to upload exit image:', error);
    throw error;
  }
}

/**
 * Example: Upload driver face image
 */
export async function handleDriverFaceImage(imageFile) {
  try {
    console.log('👤 Uploading driver face image...');
    
    const uploadResult = await uploadFaceImage(imageFile);
    
    if (uploadResult.success) {
      console.log('✅ Face image uploaded successfully:', {
        filename: uploadResult.filename,
        servers: uploadResult.results.filter(r => r.status === 'success').length,
        primaryUrl: uploadResult.primaryUrl
      });
      
      return {
        success: true,
        filename: uploadResult.filename,
        imageUrl: uploadResult.primaryUrl,
        backupUrls: uploadResult.urls
      };
    } else {
      throw new Error('Upload failed to all servers');
    }
  } catch (error) {
    console.error('❌ Failed to upload face image:', error);
    throw error;
  }
}

/**
 * Example: Custom image upload with custom prefix
 */
export async function handleCustomImage(imageFile, customPrefix) {
  try {
    console.log(`📷 Uploading custom image with prefix: ${customPrefix}...`);
    
    const uploadResult = await uploadImageToMinIO(imageFile, customPrefix);
    
    if (uploadResult.success) {
      console.log('✅ Custom image uploaded successfully:', {
        filename: uploadResult.filename,
        servers: uploadResult.results.filter(r => r.status === 'success').length,
        primaryUrl: uploadResult.primaryUrl
      });
      
      return {
        success: true,
        filename: uploadResult.filename,
        imageUrl: uploadResult.primaryUrl,
        backupUrls: uploadResult.urls
      };
    } else {
      throw new Error('Upload failed to all servers');
    }
  } catch (error) {
    console.error('❌ Failed to upload custom image:', error);
    throw error;
  }
}

/**
 * Example: Complete vehicle entry process with image upload
 */
export async function completeVehicleEntry(vehicleData, plateImage, faceImage) {
  try {
    console.log('🚗 Starting complete vehicle entry process...');
    
    // Upload images in parallel
    const [plateUpload, faceUpload] = await Promise.all([
      uploadLicensePlateImage(plateImage),
      uploadFaceImage(faceImage)
    ]);
    
    // Create session data with image URLs
    const sessionData = {
      ...vehicleData,
      anhVao: plateUpload.primaryUrl,
      anhMatVao: faceUpload.primaryUrl,
      // Store backup URLs for redundancy (optional)
      backupImageUrls: {
        plate: plateUpload.urls,
        face: faceUpload.urls
      }
    };
    
    console.log('✅ Vehicle entry images uploaded, session data ready:', sessionData);
    
    return sessionData;
    
  } catch (error) {
    console.error('❌ Complete vehicle entry failed:', error);
    throw error;
  }
}

/**
 * Example: Complete vehicle exit process with image upload
 */
export async function completeVehicleExit(sessionId, plateImage, faceImage) {
  try {
    console.log('🚗 Starting complete vehicle exit process...');
    
    // Upload exit images
    const [plateUpload, faceUpload] = await Promise.all([
      uploadLicensePlateOutImage(plateImage),
      uploadFaceImage(faceImage)
    ]);
    
    // Create update data with image URLs
    const updateData = {
      maPhien: sessionId,
      anhRa: plateUpload.primaryUrl,
      anhMatRa: faceUpload.primaryUrl,
      gioRa: new Date().toISOString(),
      // Store backup URLs for redundancy (optional)
      backupImageUrls: {
        plate: plateUpload.urls,
        face: faceUpload.urls
      }
    };
    
    console.log('✅ Vehicle exit images uploaded, update data ready:', updateData);
    
    return updateData;
    
  } catch (error) {
    console.error('❌ Complete vehicle exit failed:', error);
    throw error;
  }
}

/**
 * Example: Handle file input change event
 */
export function handleImageFileInput(event, uploadType = 'license_plate') {
  const file = event.target.files[0];
  
  if (!file) {
    console.warn('No file selected');
    return null;
  }
  
  // Validate file type
  if (!file.type.startsWith('image/')) {
    console.error('Selected file is not an image');
    throw new Error('Please select an image file');
  }
  
  // Validate file size (max 10MB)
  if (file.size > 10 * 1024 * 1024) {
    console.error('File size too large:', file.size);
    throw new Error('Image file must be smaller than 10MB');
  }
  
  console.log('📷 Valid image file selected:', {
    name: file.name,
    type: file.type,
    size: file.size,
    uploadType: uploadType
  });
  
  return file;
}

// Example React component usage:
/*
import React, { useState } from 'react';
import { handleVehicleEntryImage, handleImageFileInput } from './utils/imageUploadExamples';

function VehicleEntryComponent() {
  const [uploading, setUploading] = useState(false);
  const [uploadResult, setUploadResult] = useState(null);

  const handleFileSelect = async (event) => {
    try {
      const file = handleImageFileInput(event, 'license_plate');
      if (!file) return;

      setUploading(true);
      const result = await handleVehicleEntryImage(file);
      setUploadResult(result);
      
      console.log('Image URL for database:', result.imageUrl);
      
    } catch (error) {
      console.error('Upload failed:', error);
      alert('Failed to upload image: ' + error.message);
    } finally {
      setUploading(false);
    }
  };

  return (
    <div>
      <input 
        type="file" 
        accept="image/*" 
        onChange={handleFileSelect}
        disabled={uploading}
      />
      {uploading && <p>Uploading...</p>}
      {uploadResult && (
        <div>
          <p>Upload successful!</p>
          <p>Filename: {uploadResult.filename}</p>
          <img src={uploadResult.imageUrl} alt="Uploaded" style={{maxWidth: '200px'}} />
        </div>
      )}
    </div>
  );
}
*/
