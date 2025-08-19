# 📊 PARKING STATISTICS API DOCUMENTATION - FRONTEND

## 🚀 **Tổng quan**

File `api.js` đã được mở rộng với **37+ API functions** để gọi backend cho hệ thống thống kê bãi xe.

---

## 📋 **DANH SÁCH API FUNCTIONS**

### 🔹 **1. Revenue Statistics (Thống kê Doanh thu)**

```javascript
// Doanh thu theo ngày
import { getRevenueByDate } from "./api/api.js";
const revenue = await getRevenueByDate("2024-12-15", "2024-12-15");

// Doanh thu theo tuần
import { getRevenueByWeek } from "./api/api.js";
const weeklyRevenue = await getRevenueByWeek("2024-12-15");

// Doanh thu theo tháng
import { getRevenueByMonth } from "./api/api.js";
const monthlyRevenue = await getRevenueByMonth("2024-12-01");

// Doanh thu theo năm
import { getRevenueByYear } from "./api/api.js";
const yearlyRevenue = await getRevenueByYear("2024-01-01");

// Doanh thu N ngày gần nhất
import { getRevenueLastDays } from "./api/api.js";
const lastDaysRevenue = await getRevenueLastDays(7);

// Doanh thu N tháng gần nhất
import { getRevenueLastMonths } from "./api/api.js";
const lastMonthsRevenue = await getRevenueLastMonths(6);

// Doanh thu theo loại thẻ
import { getRevenueByCardType } from "./api/api.js";
const cardRevenue = await getRevenueByCardType("2024-12-01", "2024-12-15");

// Doanh thu theo loại xe
import { getRevenueByVehicleType } from "./api/api.js";
const vehicleRevenue = await getRevenueByVehicleType(
  "2024-12-01",
  "2024-12-15"
);

// Doanh thu theo chính sách giá
import { getRevenueByPricingPolicy } from "./api/api.js";
const policyRevenue = await getRevenueByPricingPolicy(
  "2024-12-01",
  "2024-12-15"
);

// So sánh doanh thu
import { getRevenueComparison } from "./api/api.js";
const comparison = await getRevenueComparison("2024-12-01", "2024-12-15");
```

### 🔹 **2. Vehicle Count Statistics (Thống kê Lượng xe)**

```javascript
// Lượng xe theo ngày
import { getVehicleCountByDate } from "./api/api.js";
const dailyCount = await getVehicleCountByDate("2024-12-15", "2024-12-15");

// Lượng xe theo giờ
import { getVehicleCountByHour } from "./api/api.js";
const hourlyCount = await getVehicleCountByHour("2024-12-15");

// Lượng xe theo tháng
import { getVehicleCountByMonth } from "./api/api.js";
const monthlyCount = await getVehicleCountByMonth("2024-12-01", "2024-12-15");

// Xe quá hạn
import { getOverdueVehicles } from "./api/api.js";
const overdueList = await getOverdueVehicles(50);

// Top biển số thường xuyên
import { getTopFrequentPlates } from "./api/api.js";
const topPlates = await getTopFrequentPlates("2024-12-01", "2024-12-15", 20);
```

### 🔹 **3. Parking Analytics (Phân tích Bãi đỗ)**

```javascript
// Thời gian đỗ xe trung bình
import { getAverageParkingTime } from "./api/api.js";
const avgTime = await getAverageParkingTime("2024-12-15", "2024-12-15");

// Tỷ lệ lấp đầy hiện tại
import { getCurrentOccupancyRate } from "./api/api.js";
const currentRate = await getCurrentOccupancyRate();

// Tỷ lệ lấp đầy lịch sử
import { getHistoricalOccupancyRate } from "./api/api.js";
const historicalRate = await getHistoricalOccupancyRate(
  "2024-12-01",
  "2024-12-15"
);

// Xe đang trong bãi
import { getVehiclesInParking } from "./api/api.js";
const currentVehicles = await getVehiclesInParking();

// Chi tiết chỗ đỗ
import { getParkingSpotDetails } from "./api/api.js";
const spotDetails = await getParkingSpotDetails("2024-12-15");

// Phân tích thời gian đỗ xe
import { getParkingTimeAnalysis } from "./api/api.js";
const timeAnalysis = await getParkingTimeAnalysis("2024-12-01", "2024-12-15");

// Phân tích giờ cao điểm
import { getPeakHoursAnalysis } from "./api/api.js";
const peakHours = await getPeakHoursAnalysis("2024-12-01", "2024-12-15");
```

### 🔹 **4. System Overview (Tổng quan Hệ thống)**

```javascript
// Tổng quan hệ thống
import { getSystemOverview } from "./api/api.js";
const overview = await getSystemOverview();

// Hiệu suất camera
import { getCameraPerformance } from "./api/api.js";
const cameraStats = await getCameraPerformance("2024-12-15");

// Thống kê barrier
import { getBarrierStatistics } from "./api/api.js";
const barrierStats = await getBarrierStatistics("2024-12-15");

// Phân tích lỗi
import { getErrorAnalysis } from "./api/api.js";
const errors = await getErrorAnalysis("2024-12-15");
```

### 🔹 **5. Zone Statistics (Thống kê Khu vực)**

```javascript
// Thống kê theo khu vực
import { getZoneStatistics } from "./api/api.js";
const zoneStats = await getZoneStatistics("2024-12-15");

// So sánh khu vực
import { getZoneComparison } from "./api/api.js";
const zoneComparison = await getZoneComparison("2024-12-01", "2024-12-15");

// Hoạt động nhân viên
import { getEmployeeActivity } from "./api/api.js";
const employeeStats = await getEmployeeActivity("2024-12-15");
```

### 🔹 **6. RFID Card Statistics (Thống kê Thẻ RFID)**

```javascript
// Top thẻ sử dụng nhiều
import { getTopCards } from "./api/api.js";
const topCards = await getTopCards("2024-12-01", "2024-12-15", 10);

// Chi tiết thẻ RFID
import { getRfidCardDetails } from "./api/api.js";
const cardDetails = await getRfidCardDetails("2024-12-15");
```

### 🔹 **7. Reports (Báo cáo)**

```javascript
// Báo cáo ca làm việc
import { getShiftReport } from "./api/api.js";
const shiftReport = await getShiftReport("2024-12-15");

// Chi tiết giao dịch
import { getTransactionDetails } from "./api/api.js";
const transactions = await getTransactionDetails(
  "2024-12-15",
  "2024-12-15",
  50
);

// Báo cáo sự cố
import { getIncidentReports } from "./api/api.js";
const incidents = await getIncidentReports("2024-12-01", "2024-12-15");

// Log thiết bị
import { getDeviceLogs } from "./api/api.js";
const deviceLogs = await getDeviceLogs("2024-12-15", 100);

// Log hệ thống
import { getSystemLogs } from "./api/api.js";
const systemLogs = await getSystemLogs("2024-12-15", 100);
```

### 🔹 **8. Trend Analysis (Phân tích Xu hướng)**

```javascript
// Phân tích xu hướng
import { getTrendAnalysis } from "./api/api.js";
const trends = await getTrendAnalysis("2024-12-15", 30);
```

### 🔹 **9. Utility Functions (Hàm Tiện ích)**

```javascript
// Gọi API tùy chỉnh
import { callCustomStatistics } from "./api/api.js";
const customData = await callCustomStatistics("customFunction", {
  fromDate: "2024-12-15",
  toDate: "2024-12-15",
  limit: 10,
});

// Lấy tất cả thống kê cơ bản
import { getAllBasicStatistics } from "./api/api.js";
const allStats = await getAllBasicStatistics("2024-12-15", "2024-12-15");

// Báo cáo tổng hợp hàng ngày
import { getDailyReport } from "./api/api.js";
const dailyReport = await getDailyReport("2024-12-15");
```

---

## 🛠️ **CÁCH SỬ DỤNG TRONG REACT COMPONENT**

### **1. Import Functions:**

```javascript
import {
  getSystemOverview,
  getRevenueByDate,
  getCurrentOccupancyRate,
  getVehicleCountByDate,
  getAllBasicStatistics,
} from "../api/api.js";
```

### **2. Sử dụng trong Component:**

```javascript
function StatisticsComponent() {
  const [statistics, setStatistics] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchStatistics = async () => {
      try {
        setLoading(true);

        // Lấy tất cả thống kê cơ bản
        const basicStats = await getAllBasicStatistics();
        setStatistics(basicStats.data);

        // Hoặc lấy từng loại riêng biệt
        // const overview = await getSystemOverview();
        // const revenue = await getRevenueByDate();
        // const occupancy = await getCurrentOccupancyRate();
      } catch (error) {
        console.error("Error fetching statistics:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchStatistics();
  }, []);

  if (loading) return <div>Loading statistics...</div>;

  return (
    <div>
      <h2>Parking Statistics Dashboard</h2>
      {statistics && (
        <div>
          <div>Revenue: {statistics.revenueByDate?.data?.total}</div>
          <div>Vehicle Count: {statistics.vehicleCount?.data?.total}</div>
          <div>Occupancy Rate: {statistics.occupancyRate?.data?.rate}%</div>
        </div>
      )}
    </div>
  );
}
```

### **3. Sử dụng với Date Range:**

```javascript
function RevenueChart() {
  const [revenueData, setRevenueData] = useState(null);

  const fetchRevenue = async (fromDate, toDate) => {
    try {
      const data = await getRevenueByDate(fromDate, toDate);
      setRevenueData(data);
    } catch (error) {
      console.error("Error fetching revenue:", error);
    }
  };

  const handleDateChange = (startDate, endDate) => {
    const fromDate = startDate.toISOString().split("T")[0];
    const toDate = endDate.toISOString().split("T")[0];
    fetchRevenue(fromDate, toDate);
  };

  return (
    <div>
      <DateRangePicker onChange={handleDateChange} />
      {revenueData && <LineChart data={revenueData.data} />}
    </div>
  );
}
```

---

## 📊 **RESPONSE FORMAT**

Tất cả các API functions trả về format chuẩn:

```javascript
{
  "success": true,
  "data": {
    // Dữ liệu cụ thể tùy theo từng API
  },
  "message": "Success message"
}
```

### **Error Response:**

```javascript
{
  "success": false,
  "message": "Error message"
}
```

---

## ⚙️ **CẤU HÌNH**

### **1. Authentication:**

Tất cả API đều sử dụng authentication tự động thông qua `callApiWithAuth()`:

- Token được cache và tự động refresh
- Headers authentication được tự động thêm vào

### **2. Default Values:**

- **fromDate/toDate:** Mặc định là ngày hiện tại
- **limit:** Mặc định tùy theo từng API (10, 20, 50, 100)

### **3. Date Format:**

- **Input:** YYYY-MM-DD (ISO format)
- **Output:** Tùy theo backend trả về

---

## 🎯 **BEST PRACTICES**

### **1. Error Handling:**

```javascript
try {
  const data = await getRevenueByDate();
  // Handle success
} catch (error) {
  console.error("API Error:", error.message);
  // Handle error - show toast, fallback UI, etc.
}
```

### **2. Loading States:**

```javascript
const [loading, setLoading] = useState(false);

const fetchData = async () => {
  setLoading(true);
  try {
    const data = await getSystemOverview();
    // Update state
  } finally {
    setLoading(false);
  }
};
```

### **3. Batch Requests:**

```javascript
// Sử dụng utility function
const allStats = await getAllBasicStatistics();

// Hoặc Promise.all cho requests độc lập
const [revenue, vehicles, occupancy] = await Promise.all([
  getRevenueByDate(),
  getVehicleCountByDate(),
  getCurrentOccupancyRate(),
]);
```

### **4. Caching (Optional):**

```javascript
// Implement simple cache if needed
const cache = new Map();

const getCachedStatistics = async (key, apiFn) => {
  if (cache.has(key)) {
    return cache.get(key);
  }

  const data = await apiFn();
  cache.set(key, data);
  return data;
};
```

---

## ✅ **KIỂM TRA HOẠT ĐỘNG**

### **Test Basic API:**

```javascript
// Test trong console
import { getSystemOverview } from "./api/api.js";
getSystemOverview().then(console.log).catch(console.error);
```

### **Test với Parameters:**

```javascript
import { getRevenueByDate } from "./api/api.js";
getRevenueByDate("2024-12-15", "2024-12-15")
  .then(console.log)
  .catch(console.error);
```

**🎉 Hệ thống API Frontend cho Statistics đã hoàn chỉnh và sẵn sàng sử dụng!**
