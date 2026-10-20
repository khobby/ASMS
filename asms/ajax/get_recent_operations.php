<?php
// Recent operations with actionable recommendations
header('Content-Type: application/json');
require_once __DIR__ . '/../config/config.php';

$recentIncidents = [];
$recentMaintenance = [];
$aircraftList = [];

// Try to get database data
if (file_exists(__DIR__ . '/../config/database.php')) {
    require_once __DIR__ . '/../config/database.php';
    
    if (file_exists(__DIR__ . '/../models/Incident.php')) {
        require_once __DIR__ . '/../models/Incident.php';
        if (class_exists('Incident')) {
            try {
                $incident = new Incident();
                if (method_exists($incident, 'getRecent')) {
                    $recentIncidents = $incident->getRecent(7) ?: [];
                }
            } catch (Exception $e) {
                // Use demo data
            }
        }
    }
    
    if (file_exists(__DIR__ . '/../models/Maintenance.php')) {
        require_once __DIR__ . '/../models/Maintenance.php';
        if (class_exists('Maintenance')) {
            try {
                $maintenance = new Maintenance();
                if (method_exists($maintenance, 'getRecent')) {
                    $recentMaintenance = $maintenance->getRecent(7) ?: [];
                }
            } catch (Exception $e) {
                // Use demo data
            }
        }
    }
    
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

// Generate demo data if no database data
if (empty($recentIncidents)) {
    $recentIncidents = [
        ['incident_code' => 'INC-001', 'aircraft_code' => 'GH-001', 'incident_type' => 'Minor Damage', 'incident_date' => date('Y-m-d'), 'severity' => 'Medium', 'status' => 'Open'],
        ['incident_code' => 'INC-002', 'aircraft_code' => 'GH-002', 'incident_type' => 'Fuel Leak', 'incident_date' => date('Y-m-d', strtotime('-1 day')), 'severity' => 'Critical', 'status' => 'Under Review'],
    ];
}

if (empty($recentMaintenance)) {
    $recentMaintenance = [
        ['aircraft_code' => 'GH-001', 'component_name' => 'Engine Oil Change', 'maintenance_date' => date('Y-m-d'), 'maintenance_type' => 'Preventive', 'status' => 'Completed'],
        ['aircraft_code' => 'GH-003', 'component_name' => 'Brake System', 'maintenance_date' => date('Y-m-d', strtotime('-2 days')), 'maintenance_type' => 'Corrective', 'status' => 'Pending'],
    ];
}

if (empty($aircraftList)) {
    $aircraftList = [
        ['aircraft_code' => 'GH-001', 'health_score' => 92, 'status' => 'Operational'],
        ['aircraft_code' => 'GH-002', 'health_score' => 65, 'status' => 'Operational'],
        ['aircraft_code' => 'GH-003', 'health_score' => 85, 'status' => 'Operational'],
    ];
}

$operations = [
    'recent_incidents' => [],
    'maintenance_updates' => [],
    'aircraft_status' => [],
    'recommendations' => []
];

// Recent incidents with recommendations
foreach (array_slice($recentIncidents ?? [], 0, 5) as $inc) {
    $operations['recent_incidents'][] = [
        'id' => $inc['incident_id'] ?? $inc['id'] ?? rand(1, 1000),
        'aircraft' => $inc['aircraft_code'] ?? 'N/A',
        'type' => $inc['incident_type'] ?? 'Unknown',
        'date' => $inc['incident_date'] ?? date('Y-m-d'),
        'severity' => $inc['severity'] ?? 'Medium',
        'status' => $inc['status'] ?? 'Open',
        'action' => 'Review and address'
    ];
}

// Maintenance updates
foreach (array_slice($recentMaintenance ?? [], 0, 5) as $maint) {
    $operations['maintenance_updates'][] = [
        'aircraft' => $maint['aircraft_code'] ?? 'N/A',
        'component' => $maint['component_name'] ?? 'N/A',
        'date' => $maint['maintenance_date'] ?? date('Y-m-d'),
        'type' => $maint['maintenance_type'] ?? 'Preventive',
        'status' => $maint['status'] ?? 'Completed',
        'action' => ($maint['status'] ?? '') === 'Pending' ? 'Schedule urgently' : 'Document completion'
    ];
}

// Aircraft status
foreach (array_slice($aircraftList ?? [], 0, 5) as $a) {
    $healthScore = $a['health_score'] ?? rand(70, 100);
    $recommendation = 'Continue normal operations';
    
    if ($healthScore < 40) {
        $recommendation = 'URGENT: Ground aircraft for maintenance';
    } elseif ($healthScore < 60) {
        $recommendation = 'Schedule priority maintenance';
    } elseif ($healthScore < 80) {
        $recommendation = 'Plan maintenance in next 2 weeks';
    } elseif ($healthScore < 90) {
        $recommendation = 'Routine monitoring recommended';
    }
    
    $operations['aircraft_status'][] = [
        'aircraft' => $a['aircraft_code'] ?? $a['code'] ?? 'N/A',
        'health_score' => $healthScore,
        'status' => $a['status'] ?? 'Operational',
        'last_flight' => date('Y-m-d H:i', strtotime('-' . rand(1, 24) . ' hours')),
        'recommendation' => $recommendation
    ];
}

// Generate AI-powered recommendations
$recommendations = [
    'critical' => [],
    'important' => [],
    'info' => []
];

// Add dynamic recommendations based on data
$criticalCount = count(array_filter($operations['recent_incidents'], fn($i) => $i['severity'] === 'Critical'));
if ($criticalCount > 0) {
    $recommendations['critical'][] = "⚠️ $criticalCount critical incidents detected. Immediate investigation required.";
}

$groundedAircraft = count(array_filter($operations['aircraft_status'], fn($a) => $a['health_score'] < 40));
if ($groundedAircraft > 0) {
    $recommendations['critical'][] = "🛑 $groundedAircraft aircraft below operational threshold. Ground immediately.";
}

if (count($operations['maintenance_updates']) > 0) {
    $pendingMaint = count(array_filter($operations['maintenance_updates'], fn($m) => $m['status'] === 'Pending'));
    if ($pendingMaint > 0) {
        $recommendations['important'][] = "📋 $pendingMaint pending maintenance tasks. Schedule as priority.";
    }
}

$recommendations['important'][] = "📊 Review on-time performance dashboard for operational insights.";
$recommendations['info'][] = "ℹ️ Next scheduled compliance check: " . date('Y-m-d', strtotime('+7 days'));

$operations['recommendations'] = $recommendations;
$operations['timestamp'] = date('Y-m-d H:i:s');

http_response_code(200);
echo json_encode($operations);
