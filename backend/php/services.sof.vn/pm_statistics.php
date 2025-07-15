<?php
/**
 * API endpoints for Parking Statistics
 */

class pm_statistics extends lv_controler{
    
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
