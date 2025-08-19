<?php
/**
 * API endpoints for Parking Statistics
 */

class pm_statistics extends lv_controler{
    // Properties for date range and other parameters
    public $lv002; // fromDate
    public $lv003; // toDate
    public $lv004; // limit or other parameter
    
    // Get revenue statistics by date
    function GET_REVENUE_BY_DATE() {
        $date = $this->lv002 ?? date('Y-m-d');
        $tableName = 'pm_nc0009_' . date('dmY', strtotime($date));
        
        // Check if table exists for this date
        $tableExists = $this->checkTableExists($tableName);
        
        if ($tableExists) {
            $sql = "SELECT 
                        DATE(lv008) as date,
                        SUM(lv013) as revenue,
                        COUNT(*) as sessions
                    FROM $tableName 
                    WHERE DATE(lv008) = '$date' 
                    AND lv014 = 'DA_RA'
                    GROUP BY DATE(lv008)";
        } else {
            // Fallback to main table
            $sql = "SELECT 
                        DATE(lv008) as date,
                        SUM(lv013) as revenue,
                        COUNT(*) as sessions
                    FROM pm_nc0009 
                    WHERE DATE(lv008) = '$date' 
                    AND lv014 = 'DA_RA'
                    GROUP BY DATE(lv008)";
        }
        
        $result = db_query($sql);
        $data = [];
        while ($row = db_fetch_array($result)) {
            $data[] = $row;
        }
        
        return [
            'success' => true,
            'data' => $data
        ];
    }
    
    // Get revenue statistics by week
    function GET_REVENUE_BY_WEEK() {
        $date = $this->lv002 ?? date('Y-m-d');
        $startDate = date('Y-m-d', strtotime($date . ' - 6 days'));
        $endDate = $date;
        
        // Get revenue from multiple daily tables
        $totalRevenue = 0;
        $totalSessions = 0;
        
        for ($i = 0; $i < 7; $i++) {
            $currentDate = date('Y-m-d', strtotime($startDate . " + $i days"));
            $tableName = 'pm_nc0009_' . date('dmY', strtotime($currentDate));
            
            if ($this->checkTableExists($tableName)) {
                $sql = "SELECT 
                            SUM(lv013) as revenue,
                            COUNT(*) as sessions
                        FROM $tableName 
                        WHERE DATE(lv008) = '$currentDate' 
                        AND lv014 = 'DA_RA'";
            } else {
                $sql = "SELECT 
                            SUM(lv013) as revenue,
                            COUNT(*) as sessions
                        FROM pm_nc0009 
                        WHERE DATE(lv008) = '$currentDate' 
                        AND lv014 = 'DA_RA'";
            }
            
            $result = db_query($sql);
            $row = db_fetch_array($result);
            $totalRevenue += $row['revenue'] ?? 0;
            $totalSessions += $row['sessions'] ?? 0;
        }
        
        return [
            'success' => true,
            'data' => [[
                'week' => 'W' . date('W', strtotime($date)) . '-' . date('Y', strtotime($date)),
                'revenue' => $totalRevenue,
                'sessions' => $totalSessions
            ]]
        ];
    }
    
    // Get revenue statistics by month
    function GET_REVENUE_BY_MONTH() {
        $date = $this->lv002 ?? date('Y-m-d');
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        
        // Get all tables for this month
        $totalRevenue = 0;
        $totalSessions = 0;
        $daysInMonth = date('t', strtotime($date));
        
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $currentDate = sprintf('%s-%02d-%02d', $year, $month, $day);
            $tableName = 'pm_nc0009_' . date('dmY', strtotime($currentDate));
            
            if ($this->checkTableExists($tableName)) {
                $sql = "SELECT 
                            SUM(lv013) as revenue,
                            COUNT(*) as sessions
                        FROM $tableName 
                        WHERE lv014 = 'DA_RA'";
            } else {
                $sql = "SELECT 
                            SUM(lv013) as revenue,
                            COUNT(*) as sessions
                        FROM pm_nc0009 
                        WHERE DATE(lv008) = '$currentDate' 
                        AND lv014 = 'DA_RA'";
            }
            
            $result = db_query($sql);
            $row = db_fetch_array($result);
            $totalRevenue += $row['revenue'] ?? 0;
            $totalSessions += $row['sessions'] ?? 0;
        }
        
        return [
            'success' => true,
            'data' => [[
                'month' => date('F Y', strtotime($date)),
                'revenue' => $totalRevenue,
                'sessions' => $totalSessions
            ]]
        ];
    }
    
    // Get revenue statistics by year
    function GET_REVENUE_BY_YEAR() {
        $date = $this->lv002 ?? date('Y-m-d');
        $year = date('Y', strtotime($date));
        
        $sql = "SELECT 
                    SUM(lv013) as revenue,
                    COUNT(*) as sessions
                FROM pm_nc0009 
                WHERE YEAR(lv008) = '$year' 
                AND lv014 = 'DA_RA'";
        
        $result = db_query($sql);
        $row = db_fetch_array($result);
        
        return [
            'success' => true,
            'data' => [[
                'year' => $year,
                'revenue' => $row['revenue'] ?? 0,
                'sessions' => $row['sessions'] ?? 0
            ]]
        ];
    }
    
    // Get revenue for last N days
    function GET_REVENUE_LAST_DAYS() {
        $days = $this->lv003 ?? 30;
        $endDate = $this->lv002 ?? date('Y-m-d');
        $startDate = date('Y-m-d', strtotime($endDate . " - $days days"));
        
        $data = [];
        for ($i = 0; $i < $days; $i++) {
            $currentDate = date('Y-m-d', strtotime($startDate . " + $i days"));
            $tableName = 'pm_nc0009_' . date('dmY', strtotime($currentDate));
            
            if ($this->checkTableExists($tableName)) {
                $sql = "SELECT 
                            SUM(lv013) as revenue,
                            COUNT(*) as sessions
                        FROM $tableName 
                        WHERE DATE(lv008) = '$currentDate' 
                        AND lv014 = 'DA_RA'";
            } else {
                $sql = "SELECT 
                            SUM(lv013) as revenue,
                            COUNT(*) as sessions
                        FROM pm_nc0009 
                        WHERE DATE(lv008) = '$currentDate' 
                        AND lv014 = 'DA_RA'";
            }
            
            $result = db_query($sql);
            $row = db_fetch_array($result);
            
            $data[] = [
                'date' => $currentDate,
                'revenue' => $row['revenue'] ?? 0,
                'sessions' => $row['sessions'] ?? 0
            ];
        }
        
        return [
            'success' => true,
            'data' => $data
        ];
    }
    
    // Get revenue for last N months
    function GET_REVENUE_LAST_MONTHS() {
        $months = $this->lv003 ?? 3;
        $endDate = $this->lv002 ?? date('Y-m-d');
        
        $data = [];
        for ($i = $months - 1; $i >= 0; $i--) {
            $currentDate = date('Y-m-d', strtotime($endDate . " - $i months"));
            $month = date('m', strtotime($currentDate));
            $year = date('Y', strtotime($currentDate));
            
            $sql = "SELECT 
                        SUM(lv013) as revenue,
                        COUNT(*) as sessions
                    FROM pm_nc0009 
                    WHERE MONTH(lv008) = '$month' 
                    AND YEAR(lv008) = '$year'
                    AND lv014 = 'DA_RA'";
            
            $result = db_query($sql);
            $row = db_fetch_array($result);
            
            $data[] = [
                'date' => $currentDate,
                'revenue' => $row['revenue'] ?? 0,
                'sessions' => $row['sessions'] ?? 0
            ];
        }
        
        return [
            'success' => true,
            'data' => $data
        ];
    }
    
    // Get system overview statistics
    function GET_SYSTEM_OVERVIEW() {
        // Get total counts from various tables
        $totalCards = 0;
        $totalEmployees = 0;
        $totalZones = 0;
        $totalCameras = 0;
        $totalSessions = 0;
        $activeSessionsToday = 0;
        
        // Count cards
        $result = db_query("SELECT COUNT(*) as count FROM pm_nc0008");
        if ($row = db_fetch_array($result)) {
            $totalCards = (int)$row['count'];
        }
        
        // Count employees
        $result = db_query("SELECT COUNT(*) as count FROM pm_nc0001");
        if ($row = db_fetch_array($result)) {
            $totalEmployees = (int)$row['count'];
        }
        
        // Count zones
        $result = db_query("SELECT COUNT(*) as count FROM pm_nc0004");
        if ($row = db_fetch_array($result)) {
            $totalZones = (int)$row['count'];
        }
        
        // Count cameras
        $result = db_query("SELECT COUNT(*) as count FROM pm_nc0006");
        if ($row = db_fetch_array($result)) {
            $totalCameras = (int)$row['count'];
        }
        
        // Count total sessions
        $result = db_query("SELECT COUNT(*) as count FROM pm_nc0009");
        if ($row = db_fetch_array($result)) {
            $totalSessions = (int)$row['count'];
        }
        
        // Count active sessions today
        $today = date('Y-m-d');
        $result = db_query("SELECT COUNT(*) as count FROM pm_nc0009 WHERE DATE(lv008) = '$today' AND lv014 != 'DA_RA'");
        if ($row = db_fetch_array($result)) {
            $activeSessionsToday = (int)$row['count'];
        }
        
        return [
            'success' => true,
            'data' => [
                'totalCards' => $totalCards,
                'totalEmployees' => $totalEmployees,
                'totalZones' => $totalZones,
                'totalCameras' => $totalCameras,
                'totalSessions' => $totalSessions,
                'activeSessionsToday' => $activeSessionsToday
            ]
        ];
    }
    
    // Get vehicles in parking statistics
    function GET_VEHICLES_IN_PARKING() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        $hourlyData = [];
        $totalIn = 0;
        $totalOut = 0;
        
        // Get hourly data for the date range
        for ($hour = 0; $hour < 24; $hour++) {
            $sql = "SELECT 
                        COUNT(CASE WHEN lv014 = 'VAO' THEN 1 END) as vehicles_in,
                        COUNT(CASE WHEN lv014 = 'DA_RA' THEN 1 END) as vehicles_out
                    FROM pm_nc0009 
                    WHERE DATE(lv008) BETWEEN '$fromDate' AND '$toDate'
                    AND HOUR(lv008) = $hour";
            
            $result = db_query($sql);
            $row = db_fetch_array($result);
            
            $hourlyData[] = [
                'hour' => sprintf('%02d:00', $hour),
                'vehicles_in' => (int)($row['vehicles_in'] ?? 0),
                'vehicles_out' => (int)($row['vehicles_out'] ?? 0)
            ];
        }
        
        // Get totals
        $sql = "SELECT 
                    COUNT(CASE WHEN lv014 = 'VAO' THEN 1 END) as total_in,
                    COUNT(CASE WHEN lv014 = 'DA_RA' THEN 1 END) as total_out
                FROM pm_nc0009 
                WHERE DATE(lv008) BETWEEN '$fromDate' AND '$toDate'";
        
        $result = db_query($sql);
        $row = db_fetch_array($result);
        $totalIn = (int)($row['total_in'] ?? 0);
        $totalOut = (int)($row['total_out'] ?? 0);
        
        return [
            'success' => true,
            'data' => [
                'hourlyData' => $hourlyData,
                'totalIn' => $totalIn,
                'totalOut' => $totalOut
            ]
        ];
    }
    
    // Get revenue by card type
    function GET_REVENUE_BY_CARD_TYPE() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        $sql = "SELECT 
                    c.lv002 as cardTypeName,
                    SUM(s.lv013) as revenue,
                    COUNT(s.lv001) as sessions
                FROM pm_nc0009 s
                LEFT JOIN pm_nc0003 c ON s.lv006 = c.lv001
                WHERE DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                AND s.lv014 = 'DA_RA'
                GROUP BY c.lv002";
        
        $result = db_query($sql);
        $cardTypes = [];
        $totalRevenue = 0;
        
        while ($row = db_fetch_array($result)) {
            $revenue = (float)($row['revenue'] ?? 0);
            $cardTypes[] = [
                'cardType' => $row['cardTypeName'] ?? 'Không xác định',
                'revenue' => $revenue,
                'sessions' => (int)($row['sessions'] ?? 0)
            ];
            $totalRevenue += $revenue;
        }
        
        return [
            'success' => true,
            'data' => [
                'cardTypes' => $cardTypes,
                'totalRevenue' => $totalRevenue
            ]
        ];
    }
    
    // Get camera performance statistics
    function GET_CAMERA_PERFORMANCE() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        // Get camera scan statistics
        $sql = "SELECT 
                    c.lv002 as cameraName,
                    COUNT(s.lv001) as totalScans,
                    COUNT(CASE WHEN s.lv003 != '' AND s.lv003 IS NOT NULL THEN 1 END) as successfulScans
                FROM pm_nc0006 c
                LEFT JOIN pm_nc0009 s ON c.lv001 = s.lv015 OR c.lv001 = s.lv016
                WHERE DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                GROUP BY c.lv001, c.lv002";
        
        $result = db_query($sql);
        $cameras = [];
        $totalScans = 0;
        $totalSuccessful = 0;
        
        while ($row = db_fetch_array($result)) {
            $scans = (int)($row['totalScans'] ?? 0);
            $successful = (int)($row['successfulScans'] ?? 0);
            
            $cameras[] = [
                'cameraName' => $row['cameraName'] ?? 'Camera không xác định',
                'totalScans' => $scans,
                'successfulScans' => $successful,
                'successRate' => $scans > 0 ? round(($successful / $scans) * 100, 2) : 0
            ];
            
            $totalScans += $scans;
            $totalSuccessful += $successful;
        }
        
        $overallSuccessRate = $totalScans > 0 ? round(($totalSuccessful / $totalScans) * 100, 2) : 0;
        
        return [
            'success' => true,
            'data' => [
                'cameras' => $cameras,
                'totalScans' => $totalScans,
                'successRate' => $overallSuccessRate
            ]
        ];
    }
    
    // Get zone statistics
    function GET_ZONE_STATISTICS() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        $sql = "SELECT 
                    z.lv002 as zoneName,
                    COUNT(s.lv001) as sessions,
                    SUM(s.lv013) as revenue
                FROM pm_nc0004 z
                LEFT JOIN pm_nc0005 p ON z.lv001 = p.lv002
                LEFT JOIN pm_nc0009 s ON p.lv001 = s.lv004
                WHERE DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                AND s.lv014 = 'DA_RA'
                GROUP BY z.lv001, z.lv002
                ORDER BY sessions DESC";
        
        $result = db_query($sql);
        $zones = [];
        $busiest = null;
        
        while ($row = db_fetch_array($result)) {
            $sessions = (int)($row['sessions'] ?? 0);
            $zone = [
                'zoneName' => $row['zoneName'] ?? 'Khu vực không xác định',
                'sessions' => $sessions,
                'revenue' => (float)($row['revenue'] ?? 0)
            ];
            
            $zones[] = $zone;
            
            if ($busiest === null && $sessions > 0) {
                $busiest = $zone;
            }
        }
        
        return [
            'success' => true,
            'data' => [
                'zones' => $zones,
                'busiest' => $busiest
            ]
        ];
    }
    
    // Get employee activity statistics
    function GET_EMPLOYEE_ACTIVITY() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        // Get employee counts
        $totalEmployees = 0;
        $result = db_query("SELECT COUNT(*) as count FROM pm_nc0001");
        if ($row = db_fetch_array($result)) {
            $totalEmployees = (int)$row['count'];
        }
        
        // Get active employees (those who processed sessions)
        $sql = "SELECT COUNT(DISTINCT s.nhanVienVao) as activeEmployees
                FROM pm_nc0009 s
                WHERE DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                AND s.nhanVienVao IS NOT NULL";
        
        $result = db_query($sql);
        $activeEmployees = 0;
        if ($row = db_fetch_array($result)) {
            $activeEmployees = (int)($row['activeEmployees'] ?? 0);
        }
        
        return [
            'success' => true,
            'data' => [
                'totalEmployees' => $totalEmployees,
                'activeEmployees' => $activeEmployees,
                'byRole' => [],
                'byStatus' => []
            ]
        ];
    }
    
    // Get top cards usage
    function GET_TOP_CARDS() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        $limit = $this->lv004 ?? 10;
        
        $sql = "SELECT 
                    s.lv006 as soThe,
                    COUNT(s.lv001) as usageCount,
                    SUM(s.lv013) as totalSpent
                FROM pm_nc0009 s
                WHERE DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                AND s.lv014 = 'DA_RA'
                AND s.lv006 IS NOT NULL
                GROUP BY s.lv006
                ORDER BY usageCount DESC
                LIMIT $limit";
        
        $result = db_query($sql);
        $topCards = [];
        
        while ($row = db_fetch_array($result)) {
            $topCards[] = [
                'cardNumber' => $row['soThe'],
                'usageCount' => (int)($row['usageCount'] ?? 0),
                'totalSpent' => (float)($row['totalSpent'] ?? 0)
            ];
        }
        
        return [
            'success' => true,
            'data' => [
                'topCards' => $topCards
            ]
        ];
    }
    
    // Get error analysis
    function GET_ERROR_ANALYSIS() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        // Count various types of errors
        $plateErrors = 0;
        $cameraErrors = 0;
        $cardErrors = 0;
        $systemErrors = 0;
        
        // Plate recognition errors (empty or null license plates)
        $sql = "SELECT COUNT(*) as count FROM pm_nc0009 
                WHERE DATE(lv008) BETWEEN '$fromDate' AND '$toDate'
                AND (lv003 = '' OR lv003 IS NULL)";
        $result = db_query($sql);
        if ($row = db_fetch_array($result)) {
            $plateErrors = (int)($row['count'] ?? 0);
        }
        
        // Card errors (sessions without card)
        $sql = "SELECT COUNT(*) as count FROM pm_nc0009 
                WHERE DATE(lv008) BETWEEN '$fromDate' AND '$toDate'
                AND (lv006 = '' OR lv006 IS NULL)";
        $result = db_query($sql);
        if ($row = db_fetch_array($result)) {
            $cardErrors = (int)($row['count'] ?? 0);
        }
        
        return [
            'success' => true,
            'data' => [
                'plateErrors' => $plateErrors,
                'cameraErrors' => $cameraErrors,
                'cardErrors' => $cardErrors,
                'systemErrors' => $systemErrors
            ]
        ];
    }
    
    // Get average parking time
    function GET_AVERAGE_PARKING_TIME() {
        $date = $this->lv002 ?? date('Y-m-d');
        
        $sql = "SELECT AVG(lv010) as averageMinutes
                FROM pm_nc0009 
                WHERE lv010 IS NOT NULL 
                AND lv014 = 'DA_RA'
                AND DATE(lv008) >= DATE_SUB('$date', INTERVAL 30 DAY)";
        
        $result = db_query($sql);
        $row = db_fetch_array($result);
        
        return [
            'success' => true,
            'data' => [
                'averageMinutes' => round($row['averageMinutes'] ?? 0)
            ]
        ];
    }
    
    // Get vehicle count by date
    function GET_VEHICLE_COUNT_BY_DATE() {
        $date = $this->lv002 ?? date('Y-m-d');
        $tableName = 'pm_nc0009_' . date('dmY', strtotime($date));
        
        if ($this->checkTableExists($tableName)) {
            $sqlIn = "SELECT COUNT(*) as vehiclesIn
                      FROM $tableName 
                      WHERE DATE(lv008) = '$date'";
            
            $sqlOut = "SELECT COUNT(*) as vehiclesOut
                       FROM $tableName 
                       WHERE DATE(lv009) = '$date' 
                       AND lv014 = 'DA_RA'";
        } else {
            $sqlIn = "SELECT COUNT(*) as vehiclesIn
                      FROM pm_nc0009 
                      WHERE DATE(lv008) = '$date'";
            
            $sqlOut = "SELECT COUNT(*) as vehiclesOut
                       FROM pm_nc0009 
                       WHERE DATE(lv009) = '$date' 
                       AND lv014 = 'DA_RA'";
        }
        
        $resultIn = db_query($sqlIn);
        $resultOut = db_query($sqlOut);
        $rowIn = db_fetch_array($resultIn);
        $rowOut = db_fetch_array($resultOut);
        
        return [
            'success' => true,
            'data' => [[
                'date' => $date,
                'vehiclesIn' => $rowIn['vehiclesIn'] ?? 0,
                'vehiclesOut' => $rowOut['vehiclesOut'] ?? 0
            ]]
        ];
    }
    
    // Get vehicle count by hour
    function GET_VEHICLE_COUNT_BY_HOUR() {
        $date = $this->lv002 ?? date('Y-m-d');
        $tableName = 'pm_nc0009_' . date('dmY', strtotime($date));
        
        if ($this->checkTableExists($tableName)) {
            $sql = "SELECT 
                        HOUR(lv008) as hour,
                        COUNT(*) as vehiclesIn,
                        SUM(CASE WHEN DATE(lv009) = '$date' THEN 1 ELSE 0 END) as vehiclesOut
                    FROM $tableName 
                    WHERE DATE(lv008) = '$date'
                    GROUP BY HOUR(lv008)
                    ORDER BY hour";
        } else {
            $sql = "SELECT 
                        HOUR(lv008) as hour,
                        COUNT(*) as vehiclesIn,
                        SUM(CASE WHEN DATE(lv009) = '$date' THEN 1 ELSE 0 END) as vehiclesOut
                    FROM pm_nc0009 
                    WHERE DATE(lv008) = '$date'
                    GROUP BY HOUR(lv008)
                    ORDER BY hour";
        }
        
        $result = db_query($sql);
        $data = [];
        
        // Initialize all hours with 0
        for ($h = 0; $h < 24; $h++) {
            $data[$h] = [
                'hour' => $h,
                'vehiclesIn' => 0,
                'vehiclesOut' => 0
            ];
        }
        
        // Fill with actual data
        while ($row = db_fetch_array($result)) {
            $hour = $row['hour'];
            $data[$hour] = [
                'hour' => $hour,
                'vehiclesIn' => $row['vehiclesIn'],
                'vehiclesOut' => $row['vehiclesOut']
            ];
        }
        
        return [
            'success' => true,
            'data' => array_values($data)
        ];
    }
    
    // Get vehicle count by month
    function GET_VEHICLE_COUNT_BY_MONTH() {
        $date = $this->lv002 ?? date('Y-m-d');
        
        $sql = "SELECT 
                    DATE_FORMAT(lv008, '%b %Y') as month,
                    COUNT(*) as vehiclesIn,
                    SUM(CASE WHEN lv014 = 'DA_RA' THEN 1 ELSE 0 END) as vehiclesOut
                FROM pm_nc0009 
                WHERE lv008 >= DATE_SUB('$date', INTERVAL 12 MONTH)
                GROUP BY YEAR(lv008), MONTH(lv008)
                ORDER BY lv008";
        
        $result = db_query($sql);
        $data = [];
        while ($row = db_fetch_array($result)) {
            $data[] = $row;
        }
        
        return [
            'success' => true,
            'data' => $data
        ];
    }
    
    // Get current occupancy rate
    function GET_CURRENT_OCCUPANCY_RATE() {
        // Get total parking spots
        $totalSql = "SELECT COUNT(*) as total FROM pm_nc0005";
        $totalResult = db_query($totalSql);
        $totalRow = db_fetch_array($totalResult);
        $totalSpots = $totalRow['total'];
        
        // Get occupied spots
        $occupiedSql = "SELECT COUNT(*) as occupied 
                        FROM pm_nc0005 
                        WHERE lv003 = '1'";
        $occupiedResult = db_query($occupiedSql);
        $occupiedRow = db_fetch_array($occupiedResult);
        $occupiedSpots = $occupiedRow['occupied'];
        
        $rate = $totalSpots > 0 ? ($occupiedSpots / $totalSpots) * 100 : 0;
        
        return [
            'success' => true,
            'data' => [
                'rate' => round($rate, 1),
                'occupied' => $occupiedSpots,
                'total' => $totalSpots
            ]
        ];
    }
    
    // Get historical occupancy rate
    function GET_HISTORICAL_OCCUPANCY_RATE() {
        $days = $this->lv003 ?? 30;
        $endDate = $this->lv002 ?? date('Y-m-d');
        
        // For historical data, we'll calculate based on sessions
        $data = [];
        
        // Get total spots
        $totalSql = "SELECT COUNT(*) as total FROM pm_nc0005";
        $totalResult = db_query($totalSql);
        $totalRow = db_fetch_array($totalResult);
        $totalSpots = $totalRow['total'];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $currentDate = date('Y-m-d', strtotime($endDate . " - $i days"));
            
            // Calculate average occupancy for this date
            $sql = "SELECT COUNT(DISTINCT lv004) as uniqueSpots
                    FROM pm_nc0009 
                    WHERE DATE(lv008) <= '$currentDate' 
                    AND (lv009 IS NULL OR DATE(lv009) > '$currentDate')
                    AND lv004 IS NOT NULL";
            
            $result = db_query($sql);
            $row = db_fetch_array($result);
            $occupiedSpots = $row['uniqueSpots'] ?? 0;
            
            $rate = $totalSpots > 0 ? ($occupiedSpots / $totalSpots) * 100 : 0;
            
            $data[] = [
                'date' => $currentDate,
                'rate' => round($rate, 1)
            ];
        }
        
        return [
            'success' => true,
            'data' => $data
        ];
    }
    
    // ========== BÁO CÁO CA LÀM VIỆC ==========
    
    // Get shift report data
    function GET_SHIFT_REPORT() {
        $date = $this->lv002 ?? date('Y-m-d');
        $shift = $this->lv004 ?? 'ALL'; // CA_SANG, CA_CHIEU, CA_TOI, ALL
        
        // Get shift information
        $shiftCondition = "";
        if ($shift != 'ALL') {
            switch($shift) {
                case 'CA_SANG':
                    $shiftCondition = "AND HOUR(s.lv008) BETWEEN 6 AND 13";
                    break;
                case 'CA_CHIEU':
                    $shiftCondition = "AND HOUR(s.lv008) BETWEEN 14 AND 21";
                    break;
                case 'CA_TOI':
                    $shiftCondition = "AND (HOUR(s.lv008) >= 22 OR HOUR(s.lv008) <= 5)";
                    break;
            }
        }
        
        $sql = "SELECT 
                    '$shift' as ca,
                    COUNT(*) as so_ve_phat_hanh,
                    COUNT(CASE WHEN s.lv014 = 'HUY' THEN 1 END) as ve_huy,
                    COUNT(CASE WHEN s.lostTicket = 1 THEN 1 END) as lost_ticket,
                    COUNT(CASE WHEN s.override = 1 THEN 1 END) as override_count,
                    SUM(CASE WHEN s.override = 1 THEN s.mienGiam ELSE 0 END) as tong_mien_giam,
                    SUM(CASE WHEN s.phuongThucTT = 'TIEN_MAT' THEN s.lv013 ELSE 0 END) as tien_mat,
                    SUM(CASE WHEN s.phuongThucTT = 'QR_CODE' THEN s.lv013 ELSE 0 END) as qr_code,
                    SUM(CASE WHEN s.phuongThucTT = 'THE' THEN s.lv013 ELSE 0 END) as the,
                    SUM(s.lv013) as tong_thuc_thu,
                    SUM(s.lv013) as tong_theo_he_thong,
                    0 as chenh_lech,
                    SUM(CASE WHEN s.phuongThucTT = 'TIEN_MAT' THEN s.lv013 ELSE 0 END) as tien_mat_nop
                FROM pm_nc0009 s
                WHERE DATE(s.lv008) = '$date'
                $shiftCondition";
        
        $result = db_query($sql);
        $data = db_fetch_array($result);
        
        return [
            'success' => true,
            'data' => $data
        ];
    }
    
    // Get detailed transaction data for shift report
    function GET_TRANSACTION_DETAILS() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        $sql = "SELECT 
                    s.lv001 as ticketID,
                    s.lv008 as gio_vao,
                    s.lv009 as gio_ra,
                    s.lv003 as bienSoVao,
                    s.lv003 as bienSoRa,
                    pp.lv002 as loai_xe,
                    z.lv002 as khu_vuc,
                    s.lv013 as gia_tien,
                    s.mienGiam,
                    s.lv013 as tien_thu,
                    s.phuongThucTT,
                    s.lv006 as thiet_bi_vao,
                    s.lv007 as thiet_bi_ra,
                    s.congVao,
                    s.congRa,
                    s.tin_cay_ANPR,
                    s.rfid_ok,
                    s.lv011 as anhVao,
                    s.lv012 as anhRa,
                    s.ly_do_dieu_chinh
                FROM pm_nc0009 s
                LEFT JOIN pm_nc0008 pp ON s.lv005 = pp.lv001
                LEFT JOIN pm_nc0005 p ON s.lv004 = p.lv001
                LEFT JOIN pm_nc0004 z ON p.lv002 = z.lv001
                WHERE DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                ORDER BY s.lv008 DESC";
        
        $result = db_query($sql);
        $data = [];
        while ($row = db_fetch_array($result)) {
            $data[] = $row;
        }
        
        return [
            'success' => true,
            'data' => $data
        ];
    }
    
    // ========== SỰ CỐ & KHIẾU NẠI ==========
    
    // Get incident and complaint reports
    function GET_INCIDENT_REPORTS() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        $sql = "SELECT 
                    sc.lv001 as case_id,
                    sc.ngay_gio,
                    sc.loai_su_co,
                    sc.ticketID,
                    sc.bien_so,
                    sc.mo_ta,
                    sc.anh_chung_cu,
                    sc.xu_ly,
                    sc.thoi_gian_xu_ly_phut,
                    sc.ket_qua,
                    sc.boi_thuong,
                    sc.trang_thai,
                    nv.lv002 as nguoi_xu_ly
                FROM pm_nc0012 sc
                LEFT JOIN pm_nc0001 nv ON sc.nguoi_xu_ly = nv.lv001
                WHERE DATE(sc.ngay_gio) BETWEEN '$fromDate' AND '$toDate'
                ORDER BY sc.ngay_gio DESC";
        
        $result = db_query($sql);
        $data = [];
        while ($row = db_fetch_array($result)) {
            $data[] = $row;
        }
        
        return [
            'success' => true,
            'data' => $data
        ];
    }
    
    // ========== LOG THIẾT BỊ ==========
    
    // Get device logs
    function GET_DEVICE_LOGS() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        $sql = "SELECT 
                    dl.lv001 as log_id,
                    dl.thiet_bi_id,
                    tb.loai_thiet_bi,
                    tb.ten_thiet_bi,
                    z.lv002 as khu_vuc,
                    dl.cong,
                    dl.lan,
                    dl.su_kien,
                    dl.mo_ta,
                    dl.firmware,
                    dl.uptime_phut,
                    dl.downtime_phut,
                    dl.mttr,
                    nv.lv002 as nguoi_xu_ly,
                    dl.ket_qua,
                    dl.thoi_gian
                FROM pm_nc0014 dl
                LEFT JOIN pm_nc0013 tb ON dl.lv002 = tb.lv001
                LEFT JOIN pm_nc0004 z ON tb.khu_vuc = z.lv001
                LEFT JOIN pm_nc0001 nv ON dl.nguoi_xu_ly = nv.lv001
                WHERE DATE(dl.thoi_gian) BETWEEN '$fromDate' AND '$toDate'
                ORDER BY dl.thoi_gian DESC";
        
        $result = db_query($sql);
        $data = [];
        while ($row = db_fetch_array($result)) {
            $data[] = $row;
        }
        
        return [
            'success' => true,
            'data' => $data
        ];
    }
    
    // ========== DOANH THU THEO LOẠI XE ==========
    
    // Get revenue by vehicle type
    function GET_REVENUE_BY_VEHICLE_TYPE() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        $sql = "SELECT 
                    pp.lv002 as loai_xe,
                    COUNT(s.lv001) as so_luot,
                    SUM(s.lv013) as doanh_thu,
                    AVG(s.lv013) as gia_trung_binh,
                    AVG(s.lv010) as thoi_gian_gui_trung_binh
                FROM pm_nc0009 s
                LEFT JOIN pm_nc0008 pp ON s.lv005 = pp.lv001
                WHERE DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                AND s.lv014 = 'DA_RA'
                GROUP BY pp.lv001, pp.lv002
                ORDER BY doanh_thu DESC";
        
        $result = db_query($sql);
        $data = [];
        $totalRevenue = 0;
        
        while ($row = db_fetch_array($result)) {
            $revenue = (float)($row['doanh_thu'] ?? 0);
            $data[] = [
                'loai_xe' => $row['loai_xe'] ?? 'Không xác định',
                'so_luot' => (int)($row['so_luot'] ?? 0),
                'doanh_thu' => $revenue,
                'gia_trung_binh' => (float)($row['gia_trung_binh'] ?? 0),
                'thoi_gian_gui_trung_binh' => (int)($row['thoi_gian_gui_trung_binh'] ?? 0)
            ];
            $totalRevenue += $revenue;
        }
        
        return [
            'success' => true,
            'data' => [
                'by_vehicle_type' => $data,
                'total_revenue' => $totalRevenue
            ]
        ];
    }
    
    // ========== DOANH THU THEO CHÍNH SÁCH GIÁ ==========
    
    // Get revenue by pricing policy
    function GET_REVENUE_BY_PRICING_POLICY() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        $sql = "SELECT 
                    pp.lv002 as chinh_sach_gia,
                    pp.loai_gia,
                    COUNT(s.lv001) as so_luot,
                    SUM(s.lv013) as doanh_thu,
                    AVG(s.lv013) as gia_trung_binh
                FROM pm_nc0009 s
                LEFT JOIN pm_nc0008 pp ON s.chinhSachGia = pp.lv001
                WHERE DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                AND s.lv014 = 'DA_RA'
                GROUP BY pp.lv001, pp.lv002, pp.loai_gia
                ORDER BY doanh_thu DESC";
        
        $result = db_query($sql);
        $data = [];
        $totalRevenue = 0;
        
        while ($row = db_fetch_array($result)) {
            $revenue = (float)($row['doanh_thu'] ?? 0);
            $data[] = [
                'chinh_sach_gia' => $row['chinh_sach_gia'] ?? 'Không xác định',
                'loai_gia' => $row['loai_gia'] ?? 'Khách lẻ',
                'so_luot' => (int)($row['so_luot'] ?? 0),
                'doanh_thu' => $revenue,
                'gia_trung_binh' => (float)($row['gia_trung_binh'] ?? 0)
            ];
            $totalRevenue += $revenue;
        }
        
        return [
            'success' => true,
            'data' => [
                'by_pricing_policy' => $data,
                'total_revenue' => $totalRevenue
            ]
        ];
    }
    
    // ========== XE QUÁ HẠN ==========
    
    // Get overdue vehicles
    function GET_OVERDUE_VEHICLES() {
        $currentTime = date('Y-m-d H:i:s');
        $maxHours = $this->lv004 ?? 24; // Maximum allowed parking hours
        
        $sql = "SELECT 
                    s.lv001 as session_id,
                    s.lv003 as bienSoVao,
                    s.lv008 as gio_vao,
                    TIMESTAMPDIFF(HOUR, s.lv008, '$currentTime') as gio_qua_han,
                    z.lv002 as khu_vuc,
                    p.lv001 as vi_tri_do,
                    s.lv013 as phi_da_tinh,
                    CASE 
                        WHEN TIMESTAMPDIFF(HOUR, s.lv008, '$currentTime') > $maxHours 
                        THEN (TIMESTAMPDIFF(HOUR, s.lv008, '$currentTime') - $maxHours) * 50000
                        ELSE 0 
                    END as phi_phat_sinh,
                    s.lv006 as soThe
                FROM pm_nc0009 s
                LEFT JOIN pm_nc0005 p ON s.lv004 = p.lv001
                LEFT JOIN pm_nc0004 z ON p.lv002 = z.lv001
                WHERE s.lv014 != 'DA_RA'
                AND TIMESTAMPDIFF(HOUR, s.lv008, '$currentTime') > $maxHours
                ORDER BY gio_qua_han DESC";
        
        $result = db_query($sql);
        $data = [];
        $totalOverdueFee = 0;
        
        while ($row = db_fetch_array($result)) {
            $overdueFee = (float)($row['phi_phat_sinh'] ?? 0);
            $data[] = [
                'session_id' => $row['session_id'],
                'bien_so' => $row['bienSoVao'],
                'gio_vao' => $row['gio_vao'],
                'gio_qua_han' => (int)($row['gio_qua_han'] ?? 0),
                'khu_vuc' => $row['khu_vuc'],
                'vi_tri_do' => $row['vi_tri_do'],
                'phi_da_tinh' => (float)($row['phi_da_tinh'] ?? 0),
                'phi_phat_sinh' => $overdueFee,
                'so_the' => $row['soThe']
            ];
            $totalOverdueFee += $overdueFee;
        }
        
        return [
            'success' => true,
            'data' => [
                'overdue_vehicles' => $data,
                'total_count' => count($data),
                'total_overdue_fee' => $totalOverdueFee
            ]
        ];
    }
    
    // ========== TOP BIỂN SỐ THƯỜNG XUYÊN ==========
    
    // Get top frequent license plates
    function GET_TOP_FREQUENT_PLATES() {
        $fromDate = $this->lv002 ?? date('Y-m-d', strtotime('-30 days'));
        $toDate = $this->lv003 ?? date('Y-m-d');
        $limit = $this->lv004 ?? 20;
        
        $sql = "SELECT 
                    s.lv003 as bienSoVao,
                    COUNT(*) as tan_suat,
                    SUM(s.lv013) as tong_chi_tieu,
                    AVG(s.lv010) as thoi_gian_gui_trung_binh,
                    MAX(s.lv008) as lan_cuoi_su_dung,
                    s.lv002 as so_the
                FROM pm_nc0009 s
                WHERE DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                AND s.lv003 IS NOT NULL 
                AND s.lv003 != ''
                AND s.lv014 = 'DA_RA'
                GROUP BY s.lv003
                HAVING tan_suat >= 5
                ORDER BY tan_suat DESC
                LIMIT $limit";
        
        $result = db_query($sql);
        $data = [];
        
        while ($row = db_fetch_array($result)) {
            $data[] = [
                'bien_so' => $row['bienSoVao'],
                'tan_suat' => (int)($row['tan_suat'] ?? 0),
                'tong_chi_tieu' => (float)($row['tong_chi_tieu'] ?? 0),
                'thoi_gian_gui_trung_binh' => (int)($row['thoi_gian_gui_trung_binh'] ?? 0),
                'lan_cuoi_su_dung' => $row['lan_cuoi_su_dung'],
                'so_the' => $row['so_the']
            ];
        }
        
        return [
            'success' => true,
            'data' => $data
        ];
    }
    
    // ========== THỐNG KÊ THẺ RFID CHI TIẾT ==========
    
    // Get detailed RFID card statistics
    function GET_RFID_CARD_DETAILS() {
        $currentDate = date('Y-m-d');
        
        // Get card status summary
        $sql = "SELECT 
                    c.lv002 as loai_the,
                    COUNT(c.lv001) as tong_so_the,
                    COUNT(CASE WHEN c.lv003 = 1 THEN 1 END) as dang_hoat_dong,
                    COUNT(CASE WHEN c.lv003 = 0 THEN 1 END) as da_khoa,
                    COUNT(CASE WHEN DATE(c.lv007) BETWEEN '$currentDate' AND DATE_ADD('$currentDate', INTERVAL 7 DAY) THEN 1 END) as sap_het_han,
                    COUNT(CASE WHEN DATE(c.lv007) < '$currentDate' AND c.lv007 != '0000-00-00' THEN 1 END) as da_het_han
                FROM pm_nc0003 c
                GROUP BY c.lv002";
        
        $result = db_query($sql);
        $cardStatus = [];
        
        while ($row = db_fetch_array($result)) {
            $cardStatus[] = [
                'loai_the' => $row['loai_the'] ?? 'Không xác định',
                'tong_so_the' => (int)($row['tong_so_the'] ?? 0),
                'dang_hoat_dong' => (int)($row['dang_hoat_dong'] ?? 0),
                'da_khoa' => (int)($row['da_khoa'] ?? 0),
                'sap_het_han' => (int)($row['sap_het_han'] ?? 0),
                'da_het_han' => (int)($row['da_het_han'] ?? 0)
            ];
        }
        
        return [
            'success' => true,
            'data' => [
                'card_status' => $cardStatus
            ]
        ];
    }
    
    // ========== THỐNG KÊ BARRIER/CỔNG ==========
    
    // Get barrier/gate statistics
    function GET_BARRIER_STATISTICS() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        $sql = "SELECT 
                    b.lv002 as ten_barrier,
                    b.lv003 as loai_barrier,
                    z.lv002 as khu_vuc,
                    COUNT(CASE WHEN s.congVao = b.lv001 THEN 1 END) as lan_mo_vao,
                    COUNT(CASE WHEN s.congRa = b.lv001 THEN 1 END) as lan_mo_ra,
                    COUNT(CASE WHEN s.congVao = b.lv001 OR s.congRa = b.lv001 THEN 1 END) as tong_lan_mo,
                    AVG(CASE WHEN s.congVao = b.lv001 OR s.congRa = b.lv001 THEN s.lv010 END) as thoi_gian_xu_ly_trung_binh
                FROM pm_nc0007 b
                LEFT JOIN pm_nc0004 z ON p.lv002 = z.lv001
                LEFT JOIN pm_nc0009 s ON (s.congVao = b.lv001 OR s.congRa = b.lv001) 
                    AND DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                GROUP BY b.lv001, b.lv002, b.lv003, z.lv002
                ORDER BY tong_lan_mo DESC";
        
        $result = db_query($sql);
        $data = [];
        
        while ($row = db_fetch_array($result)) {
            $data[] = [
                'ten_barrier' => $row['ten_barrier'],
                'loai_barrier' => $row['loai_barrier'],
                'khu_vuc' => $row['khu_vuc'],
                'lan_mo_vao' => (int)($row['lan_mo_vao'] ?? 0),
                'lan_mo_ra' => (int)($row['lan_mo_ra'] ?? 0),
                'tong_lan_mo' => (int)($row['tong_lan_mo'] ?? 0),
                'thoi_gian_xu_ly_trung_binh' => (float)($row['thoi_gian_xu_ly_trung_binh'] ?? 0)
            ];
        }
        
        return [
            'success' => true,
            'data' => $data
        ];
    }
    
    // ========== THỐNG KÊ CHỖ ĐỖ CHI TIẾT ==========
    
    // Get detailed parking spot statistics
    function GET_PARKING_SPOT_DETAILS() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        $sql = "SELECT 
                    p.lv002 as ten_cho_do,
                    z.lv002 as khu_vuc,
                    p.lv003 as trang_thai_hien_tai,
                    COUNT(s.lv001) as so_luot_su_dung,
                    SUM(s.lv010) as tong_phut_su_dung,
                    AVG(s.lv010) as thoi_gian_su_dung_trung_binh,
                    SUM(s.lv013) as doanh_thu,
                    MAX(s.lv008) as lan_cuoi_su_dung
                FROM pm_nc0005 p
                LEFT JOIN pm_nc0004 z ON p.lv002 = z.lv001
                LEFT JOIN pm_nc0009 s ON p.lv001 = s.lv004 
                    AND DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                    AND s.lv014 = 'DA_RA'
                GROUP BY p.lv001, p.lv002, z.lv002, p.lv003
                ORDER BY so_luot_su_dung DESC";
        
        $result = db_query($sql);
        $data = [];
        $totalRevenue = 0;
        
        while ($row = db_fetch_array($result)) {
            $revenue = (float)($row['doanh_thu'] ?? 0);
            $usageCount = (int)($row['so_luot_su_dung'] ?? 0);
            
            $data[] = [
                'ten_cho_do' => $row['ten_cho_do'],
                'khu_vuc' => $row['khu_vuc'],
                'trang_thai_hien_tai' => $row['trang_thai_hien_tai'],
                'so_luot_su_dung' => $usageCount,
                'tong_phut_su_dung' => (int)($row['tong_phut_su_dung'] ?? 0),
                'thoi_gian_su_dung_trung_binh' => (int)($row['thoi_gian_su_dung_trung_binh'] ?? 0),
                'doanh_thu' => $revenue,
                'doanh_thu_per_slot' => $usageCount > 0 ? $revenue / $usageCount : 0,
                'lan_cuoi_su_dung' => $row['lan_cuoi_su_dung']
            ];
            $totalRevenue += $revenue;
        }
        
        return [
            'success' => true,
            'data' => [
                'parking_spots' => $data,
                'total_revenue' => $totalRevenue
            ]
        ];
    }
    
    // ========== PHÂN TÍCH THỜI GIAN GỬI XE CHI TIẾT ==========
    
    // Get detailed parking time analysis
    function GET_PARKING_TIME_ANALYSIS() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        $sql = "SELECT 
                    CASE 
                        WHEN s.lv010 < 60 THEN 'Dưới 1h'
                        WHEN s.lv010 BETWEEN 60 AND 240 THEN '1-4h'
                        WHEN s.lv010 BETWEEN 241 AND 480 THEN '4-8h'
                        WHEN s.lv010 > 480 THEN 'Trên 8h'
                        ELSE 'Không xác định'
                    END as nhom_thoi_gian,
                    pp.lv002 as loai_xe,
                    COUNT(*) as so_luot,
                    AVG(s.lv010) as thoi_gian_trung_binh,
                    SUM(s.lv013) as doanh_thu
                FROM pm_nc0009 s
                LEFT JOIN pm_nc0008 pp ON s.lv005 = pp.lv001
                WHERE DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                AND s.lv014 = 'DA_RA'
                AND s.lv010 IS NOT NULL
                GROUP BY nhom_thoi_gian, pp.lv002
                ORDER BY 
                    CASE nhom_thoi_gian
                        WHEN 'Dưới 1h' THEN 1
                        WHEN '1-4h' THEN 2
                        WHEN '4-8h' THEN 3
                        WHEN 'Trên 8h' THEN 4
                        ELSE 5
                    END,
                    pp.lv002";
        
        $result = db_query($sql);
        $data = [];
        $summary = [];
        
        while ($row = db_fetch_array($result)) {
            $timeGroup = $row['nhom_thoi_gian'];
            $data[] = [
                'nhom_thoi_gian' => $timeGroup,
                'loai_xe' => $row['loai_xe'] ?? 'Không xác định',
                'so_luot' => (int)($row['so_luot'] ?? 0),
                'thoi_gian_trung_binh' => (int)($row['thoi_gian_trung_binh'] ?? 0),
                'doanh_thu' => (float)($row['doanh_thu'] ?? 0)
            ];
            
            // Summary by time group
            if (!isset($summary[$timeGroup])) {
                $summary[$timeGroup] = [
                    'so_luot' => 0,
                    'doanh_thu' => 0
                ];
            }
            $summary[$timeGroup]['so_luot'] += (int)($row['so_luot'] ?? 0);
            $summary[$timeGroup]['doanh_thu'] += (float)($row['doanh_thu'] ?? 0);
        }
        
        return [
            'success' => true,
            'data' => [
                'detailed_analysis' => $data,
                'summary_by_time_group' => $summary
            ]
        ];
    }
    
    // ========== PHÂN TÍCH GIỜ CAO ĐIỂM ==========
    
    // Get peak hours analysis
    function GET_PEAK_HOURS_ANALYSIS() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        $sql = "SELECT 
                    HOUR(s.lv008) as gio,
                    COUNT(CASE WHEN s.lv014 = 'VAO' OR s.lv014 = 'DANG_GUI' THEN 1 END) as xe_vao,
                    COUNT(CASE WHEN s.lv014 = 'DA_RA' THEN 1 END) as xe_ra,
                    COUNT(*) as tong_giao_dich,
                    AVG(s.lv010) as thoi_gian_xu_ly_trung_binh,
                    SUM(s.lv013) as doanh_thu_gio
                FROM pm_nc0009 s
                WHERE DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                GROUP BY HOUR(s.lv008)
                ORDER BY gio";
        
        $result = db_query($sql);
        $hourlyData = [];
        $peakHours = [];
        
        // Initialize all hours with 0
        for ($h = 0; $h < 24; $h++) {
            $hourlyData[$h] = [
                'gio' => $h,
                'xe_vao' => 0,
                'xe_ra' => 0,
                'tong_giao_dich' => 0,
                'thoi_gian_xu_ly_trung_binh' => 0,
                'doanh_thu_gio' => 0
            ];
        }
        
        while ($row = db_fetch_array($result)) {
            $hour = (int)$row['gio'];
            $totalTransactions = (int)($row['tong_giao_dich'] ?? 0);
            
            $hourlyData[$hour] = [
                'gio' => $hour,
                'xe_vao' => (int)($row['xe_vao'] ?? 0),
                'xe_ra' => (int)($row['xe_ra'] ?? 0),
                'tong_giao_dich' => $totalTransactions,
                'thoi_gian_xu_ly_trung_binh' => (float)($row['thoi_gian_xu_ly_trung_binh'] ?? 0),
                'doanh_thu_gio' => (float)($row['doanh_thu_gio'] ?? 0)
            ];
            
            // Identify peak hours (top 20% by transaction volume)
            if ($totalTransactions > 0) {
                $peakHours[] = [
                    'gio' => $hour,
                    'tong_giao_dich' => $totalTransactions
                ];
            }
        }
        
        // Sort and get top peak hours
        usort($peakHours, function($a, $b) {
            return $b['tong_giao_dich'] - $a['tong_giao_dich'];
        });
        
        $topPeakHours = array_slice($peakHours, 0, 5);
        
        return [
            'success' => true,
            'data' => [
                'hourly_data' => array_values($hourlyData),
                'peak_hours' => $topPeakHours
            ]
        ];
    }
    
    // ========== LOG HỆ THỐNG ==========
    
    // Get system access logs
    function GET_SYSTEM_LOGS() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        $limit = $this->lv004 ?? 1000;
        
        $sql = "SELECT 
                    sl.lv001 as log_id,
                    sl.thoi_gian,
                    sl.ip_address,
                    sl.user_agent,
                    sl.thiet_bi,
                    sl.hanh_dong,
                    sl.mo_ta,
                    nv.lv002 as nguoi_dung,
                    sl.ket_qua
                FROM pm_nc0015 sl
                LEFT JOIN pm_nc0001 nv ON sl.user_id = nv.lv001
                WHERE DATE(sl.thoi_gian) BETWEEN '$fromDate' AND '$toDate'
                ORDER BY sl.thoi_gian DESC
                LIMIT $limit";
        
        $result = db_query($sql);
        $logs = [];
        $summary = [
            'total_accesses' => 0,
            'unique_ips' => [],
            'by_device' => [],
            'by_action' => []
        ];
        
        while ($row = db_fetch_array($result)) {
            $logs[] = [
                'log_id' => $row['log_id'],
                'thoi_gian' => $row['thoi_gian'],
                'ip_address' => $row['ip_address'],
                'user_agent' => $row['user_agent'],
                'thiet_bi' => $row['thiet_bi'],
                'hanh_dong' => $row['hanh_dong'],
                'mo_ta' => $row['mo_ta'],
                'nguoi_dung' => $row['nguoi_dung'],
                'ket_qua' => $row['ket_qua']
            ];
            
            // Build summary
            $summary['total_accesses']++;
            
            if (!in_array($row['ip_address'], $summary['unique_ips'])) {
                $summary['unique_ips'][] = $row['ip_address'];
            }
            
            $device = $row['thiet_bi'] ?? 'Unknown';
            $summary['by_device'][$device] = ($summary['by_device'][$device] ?? 0) + 1;
            
            $action = $row['hanh_dong'] ?? 'Unknown';
            $summary['by_action'][$action] = ($summary['by_action'][$action] ?? 0) + 1;
        }
        
        $summary['unique_ip_count'] = count($summary['unique_ips']);
        
        return [
            'success' => true,
            'data' => [
                'logs' => $logs,
                'summary' => $summary
            ]
        ];
    }
    
    // ========== SO SÁNH DOANH THU GIỮA CÁC KỲ ==========
    
    // Compare revenue between periods
    function GET_REVENUE_COMPARISON() {
        $currentPeriodStart = $this->lv002 ?? date('Y-m-01'); // Start of current month
        $currentPeriodEnd = $this->lv003 ?? date('Y-m-t'); // End of current month
        
        // Calculate previous period (same duration)
        $periodDays = (strtotime($currentPeriodEnd) - strtotime($currentPeriodStart)) / (60 * 60 * 24) + 1;
        $previousPeriodEnd = date('Y-m-d', strtotime($currentPeriodStart . ' - 1 day'));
        $previousPeriodStart = date('Y-m-d', strtotime($previousPeriodEnd . " - $periodDays days"));
        
        // Current period revenue
        $currentSql = "SELECT 
                        COUNT(*) as sessions,
                        SUM(lv013) as revenue,
                        AVG(lv013) as avg_revenue,
                        AVG(lv010) as avg_duration
                      FROM pm_nc0009 
                      WHERE DATE(lv008) BETWEEN '$currentPeriodStart' AND '$currentPeriodEnd'
                      AND lv014 = 'DA_RA'";
        
        // Previous period revenue
        $previousSql = "SELECT 
                         COUNT(*) as sessions,
                         SUM(lv013) as revenue,
                         AVG(lv013) as avg_revenue,
                         AVG(lv010) as avg_duration
                       FROM pm_nc0009 
                       WHERE DATE(lv008) BETWEEN '$previousPeriodStart' AND '$previousPeriodEnd'
                       AND lv014 = 'DA_RA'";
        
        $currentResult = db_query($currentSql);
        $previousResult = db_query($previousSql);
        
        $currentData = db_fetch_array($currentResult);
        $previousData = db_fetch_array($previousResult);
        
        $currentRevenue = (float)($currentData['revenue'] ?? 0);
        $previousRevenue = (float)($previousData['revenue'] ?? 0);
        
        $revenueGrowth = $previousRevenue > 0 ? 
            (($currentRevenue - $previousRevenue) / $previousRevenue) * 100 : 0;
        
        $currentSessions = (int)($currentData['sessions'] ?? 0);
        $previousSessions = (int)($previousData['sessions'] ?? 0);
        
        $sessionGrowth = $previousSessions > 0 ? 
            (($currentSessions - $previousSessions) / $previousSessions) * 100 : 0;
        
        return [
            'success' => true,
            'data' => [
                'current_period' => [
                    'start_date' => $currentPeriodStart,
                    'end_date' => $currentPeriodEnd,
                    'sessions' => $currentSessions,
                    'revenue' => $currentRevenue,
                    'avg_revenue' => (float)($currentData['avg_revenue'] ?? 0),
                    'avg_duration' => (int)($currentData['avg_duration'] ?? 0)
                ],
                'previous_period' => [
                    'start_date' => $previousPeriodStart,
                    'end_date' => $previousPeriodEnd,
                    'sessions' => $previousSessions,
                    'revenue' => $previousRevenue,
                    'avg_revenue' => (float)($previousData['avg_revenue'] ?? 0),
                    'avg_duration' => (int)($previousData['avg_duration'] ?? 0)
                ],
                'comparison' => [
                    'revenue_growth_percent' => round($revenueGrowth, 2),
                    'session_growth_percent' => round($sessionGrowth, 2),
                    'revenue_difference' => $currentRevenue - $previousRevenue,
                    'session_difference' => $currentSessions - $previousSessions
                ]
            ]
        ];
    }
    
    // ========== SO SÁNH LƯỢNG XE GIỮA CÁC KHU VỰC ==========
    
    // Compare vehicle volume between zones
    function GET_ZONE_COMPARISON() {
        $fromDate = $this->lv002 ?? date('Y-m-d');
        $toDate = $this->lv003 ?? $fromDate;
        
        $sql = "SELECT 
                    z.lv002 as ten_khu_vuc,
                    COUNT(s.lv001) as tong_luot_xe,
                    SUM(s.lv013) as doanh_thu,
                    AVG(s.lv013) as gia_trung_binh,
                    AVG(s.lv010) as thoi_gian_gui_trung_binh,
                    COUNT(DISTINCT s.lv003) as so_xe_khac_nhau,
                    MAX(s.lv008) as hoat_dong_gan_nhat
                FROM pm_nc0004 z
                LEFT JOIN pm_nc0005 p ON z.lv001 = p.lv002
                LEFT JOIN pm_nc0009 s ON p.lv001 = s.lv004
                    AND DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                    AND s.lv014 = 'DA_RA'
                GROUP BY z.lv001, z.lv002
                ORDER BY tong_luot_xe DESC";
        
        $result = db_query($sql);
        $zones = [];
        $totalVehicles = 0;
        $totalRevenue = 0;
        
        while ($row = db_fetch_array($result)) {
            $vehicleCount = (int)($row['tong_luot_xe'] ?? 0);
            $revenue = (float)($row['doanh_thu'] ?? 0);
            
            $zones[] = [
                'ten_khu_vuc' => $row['ten_khu_vuc'],
                'tong_luot_xe' => $vehicleCount,
                'doanh_thu' => $revenue,
                'gia_trung_binh' => (float)($row['gia_trung_binh'] ?? 0),
                'thoi_gian_gui_trung_binh' => (int)($row['thoi_gian_gui_trung_binh'] ?? 0),
                'so_xe_khac_nhau' => (int)($row['so_xe_khac_nhau'] ?? 0),
                'hoat_dong_gan_nhat' => $row['hoat_dong_gan_nhat'],
                'ty_le_luot_xe' => 0, // Will calculate after getting total
                'ty_le_doanh_thu' => 0 // Will calculate after getting total
            ];
            
            $totalVehicles += $vehicleCount;
            $totalRevenue += $revenue;
        }
        
        // Calculate percentages
        foreach ($zones as &$zone) {
            $zone['ty_le_luot_xe'] = $totalVehicles > 0 ? 
                round(($zone['tong_luot_xe'] / $totalVehicles) * 100, 2) : 0;
            $zone['ty_le_doanh_thu'] = $totalRevenue > 0 ? 
                round(($zone['doanh_thu'] / $totalRevenue) * 100, 2) : 0;
        }
        
        return [
            'success' => true,
            'data' => [
                'zones' => $zones,
                'summary' => [
                    'total_vehicles' => $totalVehicles,
                    'total_revenue' => $totalRevenue,
                    'busiest_zone' => !empty($zones) ? $zones[0]['ten_khu_vuc'] : null,
                    'most_profitable_zone' => !empty($zones) ? 
                        max($zones, function($a, $b) { return $a['doanh_thu'] <=> $b['doanh_thu']; })['ten_khu_vuc'] : null
                ]
            ]
        ];
    }
    
    // ========== PHÂN TÍCH XU HƯỚNG THEO THỜI GIAN ==========
    
    // Analyze trends over time
    function GET_TREND_ANALYSIS() {
        $endDate = $this->lv002 ?? date('Y-m-d');
        $days = $this->lv004 ?? 30;
        $startDate = date('Y-m-d', strtotime($endDate . " - $days days"));
        
        $sql = "SELECT 
                    DATE(lv008) as ngay,
                    COUNT(*) as tong_luot,
                    SUM(lv013) as doanh_thu,
                    AVG(lv013) as gia_trung_binh,
                    COUNT(DISTINCT lv003) as so_xe_khac_nhau,
                    AVG(lv010) as thoi_gian_gui_trung_binh
                FROM pm_nc0009 
                WHERE DATE(lv008) BETWEEN '$startDate' AND '$endDate'
                AND lv014 = 'DA_RA'
                GROUP BY DATE(lv008)
                ORDER BY ngay";
        
        $result = db_query($sql);
        $dailyData = [];
        $trends = [
            'revenue_trend' => 0,
            'volume_trend' => 0,
            'avg_price_trend' => 0
        ];
        
        while ($row = db_fetch_array($result)) {
            $dailyData[] = [
                'ngay' => $row['ngay'],
                'tong_luot' => (int)($row['tong_luot'] ?? 0),
                'doanh_thu' => (float)($row['doanh_thu'] ?? 0),
                'gia_trung_binh' => (float)($row['gia_trung_binh'] ?? 0),
                'so_xe_khac_nhau' => (int)($row['so_xe_khac_nhau'] ?? 0),
                'thoi_gian_gui_trung_binh' => (int)($row['thoi_gian_gui_trung_binh'] ?? 0)
            ];
        }
        
        // Calculate simple trend (compare first half vs second half)
        if (count($dailyData) >= 4) {
            $midPoint = floor(count($dailyData) / 2);
            $firstHalf = array_slice($dailyData, 0, $midPoint);
            $secondHalf = array_slice($dailyData, $midPoint);
            
            $firstHalfAvgRevenue = array_sum(array_column($firstHalf, 'doanh_thu')) / count($firstHalf);
            $secondHalfAvgRevenue = array_sum(array_column($secondHalf, 'doanh_thu')) / count($secondHalf);
            
            $firstHalfAvgVolume = array_sum(array_column($firstHalf, 'tong_luot')) / count($firstHalf);
            $secondHalfAvgVolume = array_sum(array_column($secondHalf, 'tong_luot')) / count($secondHalf);
            
            $firstHalfAvgPrice = array_sum(array_column($firstHalf, 'gia_trung_binh')) / count($firstHalf);
            $secondHalfAvgPrice = array_sum(array_column($secondHalf, 'gia_trung_binh')) / count($secondHalf);
            
            $trends['revenue_trend'] = $firstHalfAvgRevenue > 0 ? 
                (($secondHalfAvgRevenue - $firstHalfAvgRevenue) / $firstHalfAvgRevenue) * 100 : 0;
            $trends['volume_trend'] = $firstHalfAvgVolume > 0 ? 
                (($secondHalfAvgVolume - $firstHalfAvgVolume) / $firstHalfAvgVolume) * 100 : 0;
            $trends['avg_price_trend'] = $firstHalfAvgPrice > 0 ? 
                (($secondHalfAvgPrice - $firstHalfAvgPrice) / $firstHalfAvgPrice) * 100 : 0;
        }
        
        return [
            'success' => true,
            'data' => [
                'daily_data' => $dailyData,
                'trends' => [
                    'revenue_trend_percent' => round($trends['revenue_trend'], 2),
                    'volume_trend_percent' => round($trends['volume_trend'], 2),
                    'avg_price_trend_percent' => round($trends['avg_price_trend'], 2)
                ],
                'period' => [
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'days' => $days
                ]
            ]
        ];
    }
    
    // Helper function to check if table exists
    private function checkTableExists($tableName) {
        $sql = "SHOW TABLES LIKE '$tableName'";
        $result = db_query($sql);
        return db_num_rows($result) > 0;
    }
}
?>
