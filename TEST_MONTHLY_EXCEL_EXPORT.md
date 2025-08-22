# Test Monthly Excel Export Feature

## Summary

Updated the revenue report system to create monthly sheets when exporting data for periods longer than 2 months.

## Changes Made

### Backend (pm_statistics.php)

- Added logic to detect periods longer than 2 months
- Group daily reports by month (YYYY-MM format)
- Create `monthly_sheets` array instead of single `daily` sheet
- Each month includes summary data and daily breakdown

### Frontend (api.js)

- Added `autoWidth()` function for automatic column width adjustment
- Support for `monthly_sheets` in Excel export
- Monthly sheets named as "T01-2025", "T02-2025", etc.
- Each monthly sheet contains:
  - Month title
  - Monthly summary (revenue, sessions, avg price)
  - Daily breakdown table

## Features

### Monthly Export (> 2 months)

- **Sheet Structure**: 1 summary + N monthly sheets + analysis sheets
- **Monthly Sheet Format**:

  ```
  Tháng 2025-01

  TỔNG QUAN THÁNG
  Tổng doanh thu    15,450,000
  Số lượt          245
  Giá TB           63,061

  CHI TIẾT TỪNG NGÀY
  Ngày         Doanh thu    Số lượt   ...
  2025-01-01   523,000      8         ...
  2025-01-02   712,000      12        ...
  ```

### Daily Export (<= 2 months)

- **Sheet Structure**: 1 summary + 1 daily + analysis sheets
- **Daily Sheet**: All days in single table

### Auto Width Adjustment

- Calculates optimal column width based on content
- Maximum width capped at 50 characters
- Minimum width of 10 characters

## Testing

### Test Case 1: 6-Month Export

```
From: 2025-01-01
To: 2025-06-30
Expected: 7 sheets (1 summary + 6 monthly + analysis)
```

### Test Case 2: 1-Month Export

```
From: 2025-01-01
To: 2025-01-31
Expected: 6 sheets (1 summary + 1 daily + 4 analysis)
```

## Usage Example

When user selects date range spanning 6 months and clicks "Xuất Excel", they get:

1. **Tổng quan** - Overall statistics
2. **T01-2025** - January 2025 daily breakdown
3. **T02-2025** - February 2025 daily breakdown
4. **T03-2025** - March 2025 daily breakdown
5. **T04-2025** - April 2025 daily breakdown
6. **T05-2025** - May 2025 daily breakdown
7. **T06-2025** - June 2025 daily breakdown
8. **Phương thức TT** - Payment method analysis
9. **Loại xe** - Vehicle type analysis
10. **Theo giờ** - Hourly analysis
11. **Chi tiết** - Transaction details

## Verification

- Test with generated data from `generate_test_data.sql`
- Select 6-month range (2025-01-01 to 2025-06-30)
- Verify Excel file contains proper monthly breakdown
- Check column width auto-adjustment
