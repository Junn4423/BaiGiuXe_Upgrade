// Full integration test for parking session creation
// Test tất cả các scenario có thể xảy ra

import { validateAndEnsurePricingPolicy, validateSessionData } from './sessionValidation.js';

// Mock data cho test
const mockWorkConfigs = [
  { loai_xe: "xe_may" },
  { loai_xe: "oto" },
  { loai_xe: null },
  { loai_xe: undefined },
  { loai_xe: "" },
  null,
  undefined
];

const mockVehicleTypeCodes = ["XE_MAY", "OT", null, undefined, ""];

const mockPricingPolicies = [
  "CS_XEMAY_4H",
  "CS_OTO_4H", 
  "",
  null,
  undefined,
  "invalid_policy",
  123,
  {}
];

// Test pricing policy validation
function testPricingPolicyValidation() {
  console.log("🧪 Testing pricing policy validation...");
  
  let passed = 0;
  let failed = 0;
  
  mockWorkConfigs.forEach((workConfig, i) => {
    mockVehicleTypeCodes.forEach((vehicleTypeCode, j) => {
      mockPricingPolicies.forEach((policy, k) => {
        try {
          const result = validateAndEnsurePricingPolicy(
            policy,
            workConfig?.loai_xe,
            vehicleTypeCode
          );
          
          // Result should always be a valid string
          const isValid = (typeof result === 'string' && 
                          result.trim() !== '' && 
                          result.startsWith('CS_'));
          
          if (isValid) {
            passed++;
            console.log(`✅ Test ${i}-${j}-${k}: ${policy} → ${result}`);
          } else {
            failed++;
            console.error(`❌ Test ${i}-${j}-${k}: ${policy} → ${result} (INVALID)`);
          }
          
        } catch (error) {
          failed++;
          console.error(`❌ Test ${i}-${j}-${k}: ${policy} threw error:`, error.message);
        }
      });
    });
  });
  
  console.log(`🏁 Pricing policy validation tests: ${passed} passed, ${failed} failed`);
  return { passed, failed };
}

// Test session data validation
function testSessionDataValidation() {
  console.log("🧪 Testing session data validation...");
  
  const validSessionData = {
    uidThe: "12345",
    chinhSach: "CS_XEMAY_4H",
    congVao: "GATE01",
    gioVao: "2024-01-01 12:00:00",
    bienSo: "29A-12345",
    viTriGui: "A01"
  };
  
  const invalidSessionDatas = [
    { ...validSessionData, uidThe: "" },
    { ...validSessionData, chinhSach: "" },
    { ...validSessionData, chinhSach: null },
    { ...validSessionData, congVao: undefined },
    { ...validSessionData, gioVao: "   " },
    { ...validSessionData, uidThe: null, chinhSach: "" },
  ];
  
  let passed = 0;
  let failed = 0;
  
  // Test valid data
  try {
    const result = validateSessionData(validSessionData);
    if (result) {
      passed++;
      console.log("✅ Valid session data passed validation");
    } else {
      failed++;
      console.error("❌ Valid session data failed validation");
    }
  } catch (error) {
    failed++;
    console.error("❌ Valid session data threw error:", error.message);
  }
  
  // Test invalid data
  invalidSessionDatas.forEach((sessionData, i) => {
    try {
      validateSessionData(sessionData);
      failed++;
      console.error(`❌ Invalid session data ${i} should have failed but passed`);
    } catch (error) {
      passed++;
      console.log(`✅ Invalid session data ${i} correctly failed: ${error.message}`);
    }
  });
  
  console.log(`🏁 Session data validation tests: ${passed} passed, ${failed} failed`);
  return { passed, failed };
}

// Test complete flow simulation
function testCompleteFlow() {
  console.log("🧪 Testing complete flow simulation...");
  
  const testScenarios = [
    {
      name: "Normal xe may flow",
      workConfig: { loai_xe: "xe_may" },
      vehicleTypeCode: "XE_MAY",
      mockApiResponse: "CS_XEMAY_4H",
      expectedPolicy: "CS_XEMAY_4H"
    },
    {
      name: "Normal oto flow", 
      workConfig: { loai_xe: "oto" },
      vehicleTypeCode: "OT",
      mockApiResponse: "CS_OTO_4H",
      expectedPolicy: "CS_OTO_4H"
    },
    {
      name: "API fails, use fallback",
      workConfig: { loai_xe: "xe_may" },
      vehicleTypeCode: "XE_MAY", 
      mockApiResponse: null,
      expectedPolicy: "CS_XEMAY_4H"
    },
    {
      name: "No config, use default",
      workConfig: null,
      vehicleTypeCode: null,
      mockApiResponse: null,
      expectedPolicy: "CS_XEMAY_4H"
    }
  ];
  
  let passed = 0;
  let failed = 0;
  
  testScenarios.forEach((scenario, i) => {
    try {
      console.log(`\n--- Scenario ${i + 1}: ${scenario.name} ---`);
      
      // Simulate the pricing policy selection
      let pricingPolicy = scenario.mockApiResponse;
      
      // Apply validation (this is the key part)
      const validatedPolicy = validateAndEnsurePricingPolicy(
        pricingPolicy,
        scenario.workConfig?.loai_xe,
        scenario.vehicleTypeCode
      );
      
      // Create session data
      const sessionData = {
        uidThe: "TEST_CARD_123",
        chinhSach: validatedPolicy,
        congVao: "GATE01",
        gioVao: new Date().toISOString().slice(0, 19).replace("T", " "),
        bienSo: "29A-12345",
        viTriGui: "A01"
      };
      
      // Validate session data
      const validatedSessionData = validateSessionData(sessionData);
      
      // Check result
      if (validatedSessionData.chinhSach === scenario.expectedPolicy) {
        passed++;
        console.log(`✅ Scenario ${i + 1} passed: got ${validatedSessionData.chinhSach}`);
      } else {
        failed++;
        console.error(`❌ Scenario ${i + 1} failed: expected ${scenario.expectedPolicy}, got ${validatedSessionData.chinhSach}`);
      }
      
    } catch (error) {
      failed++;
      console.error(`❌ Scenario ${i + 1} threw error:`, error.message);
    }
  });
  
  console.log(`🏁 Complete flow tests: ${passed} passed, ${failed} failed`);
  return { passed, failed };
}

// Run all tests
export function runAllIntegrationTests() {
  console.log("🚀 Starting full integration tests...");
  
  const results = {
    pricingPolicy: testPricingPolicyValidation(),
    sessionData: testSessionDataValidation(),
    completeFlow: testCompleteFlow()
  };
  
  const totalPassed = results.pricingPolicy.passed + results.sessionData.passed + results.completeFlow.passed;
  const totalFailed = results.pricingPolicy.failed + results.sessionData.failed + results.completeFlow.failed;
  
  console.log(`\n🏁 FINAL RESULTS:`);
  console.log(`   Total tests: ${totalPassed + totalFailed}`);
  console.log(`   Passed: ${totalPassed}`);
  console.log(`   Failed: ${totalFailed}`);
  console.log(`   Success rate: ${((totalPassed / (totalPassed + totalFailed)) * 100).toFixed(1)}%`);
  
  if (totalFailed === 0) {
    console.log("🎉 All tests passed! The missing policy issue should be resolved.");
  } else {
    console.log("⚠️ Some tests failed. Review the logs above for details.");
  }
  
  return results;
}

// Auto-run if loaded in browser
if (typeof window !== 'undefined') {
  window.testFullFlow = {
    runAllIntegrationTests,
    testPricingPolicyValidation,
    testSessionDataValidation,
    testCompleteFlow
  };
  
  console.log("💡 Integration tests loaded. Run window.testFullFlow.runAllIntegrationTests() to test.");
}
