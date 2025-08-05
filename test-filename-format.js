// Test script để kiểm tra format filename
function generateParkingImageFilename(prefix = 'image', extension = 'jpg') {
  const timestamp = new Date().toISOString().replace(/[:.]/g, '-').replace('T', 'T').slice(0, -1) + 'Z';
  return `${prefix}_${timestamp}.${extension}`;
}

// Test các format như yêu cầu
console.log('=== KIỂM TRA FORMAT FILENAME ===');
console.log('');

// Test license plate in
const licensePlateIn = generateParkingImageFilename('license_plate_in', 'jpg');
console.log('✅ License Plate IN:', licensePlateIn);

// Test face in  
const faceIn = generateParkingImageFilename('face_in', 'jpg');
console.log('✅ Face IN:', faceIn);

// Test license plate out
const licensePlateOut = generateParkingImageFilename('license_plate_out', 'jpg');
console.log('✅ License Plate OUT:', licensePlateOut);

// Test face out
const faceOut = generateParkingImageFilename('face_out', 'jpg');
console.log('✅ Face OUT:', faceOut);

console.log('');
console.log('=== SO SÁNH VỚI YÊU CẦU ===');
console.log('Yêu cầu: license_plate_in_2025-07-28T03-08-07-691Z.jpg');
console.log('Thực tế:', licensePlateIn);
console.log('');
console.log('Yêu cầu: face_in_2025-07-28T03-08-07-694Z.jpg');
console.log('Thực tế:', faceIn);

// Kiểm tra regex pattern
const pattern = /^(license_plate_in|face_in|license_plate_out|face_out)_\d{4}-\d{2}-\d{2}T\d{2}-\d{2}-\d{2}-\d{3}Z\.(jpg|png)$/;

console.log('');
console.log('=== KIỂM TRA REGEX PATTERN ===');
console.log('License Plate IN match:', pattern.test(licensePlateIn));
console.log('Face IN match:', pattern.test(faceIn));
console.log('License Plate OUT match:', pattern.test(licensePlateOut));
console.log('Face OUT match:', pattern.test(faceOut));
