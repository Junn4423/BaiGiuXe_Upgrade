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
                    ct.lv002 as cardTypeName,
                    SUM(s.lv013) as revenue,
                    COUNT(s.lv001) as sessions
                FROM pm_nc0009 s
                LEFT JOIN pm_nc0008 c ON s.soThe = c.lv001
                LEFT JOIN pm_nc0005 ct ON c.loaiThe = ct.lv001
                WHERE DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                AND s.lv014 = 'DA_RA'
                GROUP BY ct.lv002";
        
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
                    COUNT(CASE WHEN s.bienSoVao != '' AND s.bienSoVao IS NOT NULL THEN 1 END) as successfulScans
                FROM pm_nc0006 c
                LEFT JOIN pm_nc0009 s ON c.lv001 = s.cameraVao OR c.lv001 = s.cameraRa
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
                LEFT JOIN pm_nc0009 s ON z.lv001 = s.khuVuc
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
                    s.soThe,
                    COUNT(s.lv001) as usageCount,
                    SUM(s.lv013) as totalSpent
                FROM pm_nc0009 s
                WHERE DATE(s.lv008) BETWEEN '$fromDate' AND '$toDate'
                AND s.lv014 = 'DA_RA'
                AND s.soThe IS NOT NULL
                GROUP BY s.soThe
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
                AND (bienSoVao = '' OR bienSoVao IS NULL)";
        $result = db_query($sql);
        if ($row = db_fetch_array($result)) {
            $plateErrors = (int)($row['count'] ?? 0);
        }
        
        // Card errors (sessions without card)
        $sql = "SELECT COUNT(*) as count FROM pm_nc0009 
                WHERE DATE(lv008) BETWEEN '$fromDate' AND '$toDate'
                AND (soThe = '' OR soThe IS NULL)";
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
    
    // Helper function to check if table exists
    private function checkTableExists($tableName) {
        $sql = "SHOW TABLES LIKE '$tableName'";
        $result = db_query($sql);
        return db_num_rows($result) > 0;
    }
}
?>
