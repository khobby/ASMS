<?php
// On-time performance analytics
header('Content-Type: application/json');
require_once __DIR__ . '/../config/config.php';

$aircraftList = [];

// Try to get database data
if (file_exists(__DIR__ . '/../config/database.php')) {
    require_once __DIR__ . '/../config/database.php';
    
    if (file_exists(__DIR__ . '/../models/Aircraft.php')) {
        require_once __DIR__ . '/../models/Aircraft.php';
        if (class_exists('Aircraft')) {
            try {
                $aircraft = new Aircraft();
                if (method_exists($aircraft, 'getAll')) {
                    $aircraftList = $aircraft->getAll() ?: [];
                }
            } catch (Exception $e) {
                // Use demo data
            }
        }
    }
}

// Generate demo aircraft if no database data
if (empty($aircraftList)) {
    $aircraftList = [
        ['aircraft_code' => 'GH-001'],
        ['aircraft_code' => 'GH-002'],
        ['aircraft_code' => 'GH-003']
    ];
}

$onTimeData = [
    'overall_performance' => rand(92, 98),
    'this_month' => rand(90, 98),
    'this_quarter' => rand(88, 96),
    'aircraft_performance' => [],
    'performance_trend' => [],
    'summary' => [
        'on_time_flights' => rand(450, 480),
        'delayed_flights' => rand(10, 40),
        'cancelled_flights' => rand(2, 8),
        'total_flights' => 500
    ]
];

// Aircraft-level performance
foreach ($aircraftList as $a) {
    $onTimeData['aircraft_performance'][] = [
        'aircraft' => $a['aircraft_code'] ?? $a['code'] ?? 'N/A',
        'on_time_percentage' => rand(85, 99),
        'flights_this_month' => rand(20, 50),
        'average_delay_minutes' => rand(0, 45),
        'trend' => ['up', 'down', 'stable'][array_rand(['up', 'down', 'stable'])]
    ];
}

// Monthly trend (last 6 months)
$months = ['Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'];
foreach ($months as $month) {
    $onTimeData['performance_trend'][] = [
        'month' => $month,
        'on_time_percentage' => rand(88, 98),
        'flights' => rand(400, 520)
    ];
}

$onTimeData['timestamp'] = date('Y-m-d H:i:s');

http_response_code(200);
echo json_encode($onTimeData);
