<?php
// Weather impact and route optimization insights
header('Content-Type: application/json');
require_once __DIR__ . '/../config/config.php';

try {
    $weatherData = [
        'current_weather' => [
            'location' => 'Accra, Ghana',
            'temperature' => rand(24, 32),
            'humidity' => rand(60, 85),
            'wind_speed' => rand(8, 25),
            'wind_direction' => ['N', 'NE', 'E', 'SE', 'S', 'SW', 'W', 'NW'][rand(0, 7)],
            'visibility' => rand(5, 10),
            'conditions' => ['Clear', 'Partly Cloudy', 'Cloudy', 'Light Rain'][rand(0, 3)],
            'ceiling' => rand(3000, 10000),
            'impact_on_flights' => 'Low'
        ],
        'route_optimizations' => [
            [
                'route' => 'Accra → Kumasi',
                'current_time' => '45 min',
                'optimized_time' => '42 min',
                'fuel_savings' => '8%',
                'wind_consideration' => 'Tailwind advantage',
                'recommendation' => 'Use optimized route for fuel efficiency'
            ],
            [
                'route' => 'Accra → Takoradi',
                'current_time' => '35 min',
                'optimized_time' => '37 min',
                'fuel_savings' => '-2%',
                'wind_consideration' => 'Headwind detected',
                'recommendation' => 'Stick with standard route'
            ],
            [
                'route' => 'Accra → Northern Region',
                'current_time' => '90 min',
                'optimized_time' => '85 min',
                'fuel_savings' => '12%',
                'wind_consideration' => 'Strong tailwind',
                'recommendation' => 'Optimal conditions for long-haul'
            ]
        ],
        'weather_alerts' => [
            [
                'severity' => 'CAUTION',
                'alert' => 'Crosswind component exceeds 20 knots on Runway 03',
                'affected_routes' => ['Accra → Kumasi'],
                'recommendation' => 'Use Runway 21 alternatively'
            ],
            [
                'severity' => 'INFO',
                'alert' => 'Convective activity developing north of route',
                'affected_routes' => ['All northern routes'],
                'recommendation' => 'Monitor developments; consider 50nm westward deviation'
            ]
        ],
        'performance_impact' => [
            'fuel_efficiency' => 94,
            'flight_stability' => 96,
            'runway_conditions' => 98,
            'turbulence_forecast' => 'Light'
        ],
        'forecast' => [
            [
                'time' => '12:00 UTC',
                'temperature' => rand(26, 30),
                'wind' => rand(10, 20),
                'conditions' => 'Partly Cloudy',
                'operations' => 'Normal'
            ],
            [
                'time' => '13:00 UTC',
                'temperature' => rand(27, 31),
                'wind' => rand(12, 22),
                'conditions' => 'Partly Cloudy',
                'operations' => 'Normal'
            ],
            [
                'time' => '14:00 UTC',
                'temperature' => rand(28, 32),
                'wind' => rand(14, 24),
                'conditions' => 'Scattered Clouds',
                'operations' => 'Normal with caution'
            ],
            [
                'time' => '15:00 UTC',
                'temperature' => rand(28, 32),
                'wind' => rand(15, 25),
                'conditions' => 'Scattered Clouds',
                'operations' => 'Normal with caution'
            ],
            [
                'time' => '16:00 UTC',
                'temperature' => rand(27, 31),
                'wind' => rand(13, 23),
                'conditions' => 'Mostly Cloudy',
                'operations' => 'Normal'
            ],
            [
                'time' => '17:00 UTC',
                'temperature' => rand(26, 30),
                'wind' => rand(10, 20),
                'conditions' => 'Clear',
                'operations' => 'Normal'
            ]
        ],
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    echo json_encode($weatherData);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
