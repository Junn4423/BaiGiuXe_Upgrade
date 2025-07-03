// Middleware validation để đảm bảo pricing policy luôn hợp lệ
// Import và sử dụng trong main_UI.jsx

/**
 * Validates và ensures pricing policy is always valid
 * @param {string} pricingPolicy - The pricing policy to validate
 * @param {string} vehicleType - Vehicle type for fallback
 * @param {string} vehicleTypeCode - Vehicle type code for fallback
 * @returns {string} - Valid pricing policy
 */
export function validateAndEnsurePricingPolicy(
  pricingPolicy,
  vehicleType,
  vehicleTypeCode
) {
  console.log(
    `🔍 Validating pricing policy: "${pricingPolicy}" for vehicle type: "${vehicleType}" (${vehicleTypeCode})`
  );

  // Check if pricing policy is valid
  if (
    pricingPolicy &&
    typeof pricingPolicy === "string" &&
    pricingPolicy.trim() !== "" &&
    pricingPolicy !== "null" &&
    pricingPolicy !== "undefined"
  ) {
    console.log(`✅ Pricing policy is valid: ${pricingPolicy}`);
    return pricingPolicy;
  }

  console.warn(
    `⚠️ Invalid pricing policy detected: "${pricingPolicy}" (type: ${typeof pricingPolicy})`
  );

  // Generate fallback based on vehicle type
  let fallbackPolicy = "CS_XEMAY_4H"; // Default to xe may

  // Check vehicleTypeCode first (more reliable)
  if (vehicleTypeCode === "OT") {
    fallbackPolicy = "CS_OTO_4H";
  } else if (vehicleTypeCode === "XE_MAY") {
    fallbackPolicy = "CS_XEMAY_4H";
  }
  // Check vehicleType as secondary option
  else if (vehicleType === "oto") {
    fallbackPolicy = "CS_OTO_4H";
  } else if (vehicleType === "xe_may") {
    fallbackPolicy = "CS_XEMAY_4H";
  }

  console.log(`🔧 Using fallback pricing policy: ${fallbackPolicy}`);
  return fallbackPolicy;
}

/**
 * Validates complete session data before sending to API
 * @param {Object} sessionData - The session data to validate
 * @returns {Object} - Validated session data
 */
export function validateSessionData(sessionData) {
  console.log(`🔍 Validating session data:`, sessionData);

  // Determine loaiXe from pricing policy or explicit field
  let loaiXe = sessionData.loaiXe;

  // If loaiXe is not explicitly set, infer from pricing policy
  if (loaiXe === undefined || loaiXe === null) {
    if (sessionData.chinhSach) {
      const policy = sessionData.chinhSach.toUpperCase();
      if (policy.includes("OTO") || policy.includes("OT")) {
        loaiXe = "1"; // Ô tô - cần vị trí gửi
      } else if (policy.includes("XEMAY") || policy.includes("XE_MAY")) {
        loaiXe = "0"; // Xe máy - không cần vị trí gửi
      }
    }
  }

  // Fallback: assume xe máy if still undetermined
  if (loaiXe === undefined || loaiXe === null) {
    loaiXe = "0";
    console.log(`⚠️ Loại xe không xác định, mặc định là xe máy (loaiXe = 0)`);
  }

  console.log(
    `🚗 Loại xe xác định: ${loaiXe} (${
      loaiXe === "1" ? "Ô tô - cần vị trí" : "Xe máy - không cần vị trí"
    })`
  );

  // Define required fields based on vehicle type
  let requiredFields = ["uidThe", "chinhSach", "congVao", "gioVao"];

  // Xử lý vị trí gửi dựa trên loại xe
  if (loaiXe === "1") {
    // Ô tô: yêu cầu vị trí gửi
    requiredFields.push("viTriGui");
    console.log(`🅿️ Loại xe = 1: Yêu cầu vị trí gửi`);
  } else if (loaiXe === "0") {
    // Xe máy: không cần vị trí gửi, xóa khỏi sessionData nếu có
    if (sessionData.viTriGui !== undefined) {
      delete sessionData.viTriGui;
      console.log(`🏍️ Loại xe = 0: Đã xóa vị trí gửi khỏi session data`);
    }
  }

  const errors = [];

  // Check each required field
  requiredFields.forEach((field) => {
    const value = sessionData[field];
    if (
      !value ||
      value === "" ||
      value === null ||
      value === undefined ||
      (typeof value === "string" && value.trim() === "")
    ) {
      errors.push(`${field}: "${value}" (type: ${typeof value})`);
    }
  });

  if (errors.length > 0) {
    console.error(`❌ Session data validation failed:`, errors);
    throw new Error(`Session data validation failed: ${errors.join(", ")}`);
  }

  // Special validation for chinhSach
  if (sessionData.chinhSach && typeof sessionData.chinhSach === "string") {
    // Check if it looks like a valid policy code
    const policyPattern = /^CS_[A-Z_]+$/;
    if (!policyPattern.test(sessionData.chinhSach)) {
      console.warn(
        `⚠️ Pricing policy format looks unusual: ${sessionData.chinhSach}`
      );
    }
  }

  // Add loaiXe to session data for API
  sessionData.loaiXe = loaiXe;

  console.log(`✅ Session data validation passed`);
  console.log(`📋 Final session data:`, {
    ...sessionData,
    viTriGui: sessionData.viTriGui || "Không có (xe máy)",
  });

  return sessionData;
}

/**
 * Enhanced themPhienGuiXe with built-in validation
 * @param {Object} sessionData - Session data to send
 * @returns {Promise<Object>} - API response
 */
export async function themPhienGuiXeWithValidation(sessionData) {
  console.log(`🚀 Starting themPhienGuiXe with enhanced validation...`);

  try {
    // Validate session data first
    const validatedData = validateSessionData(sessionData);

    // Double-check pricing policy
    if (!validatedData.chinhSach || validatedData.chinhSach.trim() === "") {
      throw new Error(
        "Critical: Pricing policy is still empty after validation"
      );
    }

    // Import and call the actual API
    const { themPhienGuiXe } = await import("../api/api");
    const result = await themPhienGuiXe(validatedData);

    console.log(`✅ themPhienGuiXe completed successfully:`, result);
    return result;
  } catch (error) {
    console.error(`❌ themPhienGuiXe failed:`, error);

    // Log detailed error info for debugging
    console.error(`❌ Failed session data:`, sessionData);
    console.error(`❌ Error stack:`, error.stack);

    throw error;
  }
}

// Export validation functions
export default {
  validateAndEnsurePricingPolicy,
  validateSessionData,
  themPhienGuiXeWithValidation,
};
