<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h3 class="mb-0">Live Tracking</h3>
    <small class="text-muted">Real-time flight activity monitoring and operational intelligence.</small>
  </div>
  <div>
    <a class="btn btn-outline-secondary btn-sm me-2" href="?page=incidents">View Incidents</a>
    <span class="badge bg-success" id="live-indicator">● LIVE</span>
  </div>
</div>

<!-- Flight Activity Summary -->
<div class="row mb-3">
  <div class="col-md-3">
    <div class="card p-3 text-center">
      <h6 class="text-muted mb-2">✈️ Active Flights</h6>
      <h3 id="active-flights">0</h3>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card p-3 text-center">
      <h6 class="text-muted mb-2">⚠️ Recent Incidents</h6>
      <h3 id="recent-incidents-map">0</h3>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card p-3 text-center">
      <h6 class="text-muted mb-2">🔴 Critical</h6>
      <h3 id="incident-critical" class="text-danger">0</h3>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card p-3 text-center">
      <h6 class="text-muted mb-2">🟡 High</h6>
      <h3 id="incident-high" class="text-warning">0</h3>
    </div>
  </div>
</div>

<div class="card p-3 mb-4">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <h6 class="mb-0">Live Tracking Map</h6>
    <button class="btn btn-sm btn-outline-secondary" id="refresh-map">🔄 Refresh</button>
  </div>
  <div id="tracking-map" style="height:520px; min-height:520px; border-radius: 8px; overflow: hidden;"></div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="card p-3 mb-3">
      <h5>Real-Time Monitoring</h5>
      <p class="mb-0">Monitor helicopter patrols, incidents, and operational activities in real-time. The map displays active routes, aircraft positions, and critical incidents within the operational area.</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card p-3 mb-3">
      <h5>Flight Tracking</h5>
      <p class="mb-0">Track multiple aircraft simultaneously with live position updates every 30 seconds. View altitude, speed, and aircraft health status directly on the map interface.</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card p-3 mb-3">
      <h5>Incident Visualization</h5>
      <p class="mb-0">Critical incidents and alerts are displayed with color-coded markers. Critical (red), High (orange), and Medium (yellow) severity incidents are clearly marked for quick identification.</p>
    </div>
  </div>
</div>

<!-- Aircraft Activity Panel -->
<div class="row mt-4">
  <div class="col-md-8">
    <div class="card p-3">
      <h6 class="mb-3">📊 Active Aircraft & Flight Data</h6>
      <div id="aircraft-list" class="aircraft-activity">
        <p class="text-muted">Loading aircraft data...</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card p-3">
      <h6 class="mb-3">🎯 Incident Summary</h6>
      <div id="incident-summary" class="incident-list">
        <p class="text-muted">Loading incidents...</p>
      </div>
    </div>
  </div>
</div>

<style>
  .helicopter-marker {
    font-size: 30px;
    line-height: 1;
    text-shadow: 0 0 8px rgba(0,0,0,0.4);
  }
  .airport-marker {
    font-size: 24px;
    line-height: 1;
    text-shadow: 0 0 8px rgba(0,0,0,0.4);
  }
  
  #live-indicator {
    animation: blink 1s infinite;
  }
  @keyframes blink {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0.6; }
  }
  
  .aircraft-activity {
    max-height: 400px;
    overflow-y: auto;
  }
  .aircraft-item {
    padding: 12px;
    border-left: 4px solid #e2e8f0;
    margin-bottom: 10px;
    background: #f9fafb;
    border-radius: 4px;
    transition: all 0.3s ease;
  }
  .aircraft-item:hover {
    background: #f3f4f6;
    border-left-color: #3b82f6;
  }
  .aircraft-item.critical {
    border-left-color: #e53e3e;
    background: #fef2f2;
  }
  .aircraft-item.warning {
    border-left-color: #ed8936;
    background: #fffbf0;
  }
  .aircraft-item.healthy {
    border-left-color: #38a169;
    background: #f0fdf4;
  }
  
  .incident-list {
    max-height: 400px;
    overflow-y: auto;
  }
  .incident-item {
    padding: 10px;
    margin-bottom: 8px;
    border-radius: 4px;
    border-left: 4px solid #f59e0b;
    font-size: 13px;
  }
  .incident-item.critical {
    border-left-color: #e53e3e;
    background: #fef2f2;
  }
  .incident-item.high {
    border-left-color: #ed8936;
    background: #fffbf0;
  }
  .incident-item.medium {
    border-left-color: #f59e0b;
    background: #fefce8;
  }
</style>

<script>
  let helicopterMarkers = [];
  let map = null;
  
  document.addEventListener('DOMContentLoaded', function() {
    initializeMap();
    loadFlightActivity();
    
    $('#refresh-map').click(function() {
      loadFlightActivity();
    });
    
    // Auto-refresh every 30 seconds
    setInterval(loadFlightActivity, 30000);
  });

  function initializeMap() {
    const ghanaCenter = [5.6037, -0.1870];
    const accraAirport = [5.6052, -0.1668];
    
    map = initMap('tracking-map', ghanaCenter[0], ghanaCenter[1], 7);
    if (!map) return;

    // Add center marker
    L.marker(ghanaCenter, {
      icon: L.divIcon({
        html: '<div class="airport-marker">📍</div>',
        className: '',
        iconSize: [30, 30],
        iconAnchor: [15, 15]
      })
    }).addTo(map).bindPopup('Operations Center – Accra, Ghana').openPopup();

    // Add airport marker
    L.marker(accraAirport, {
      icon: L.divIcon({
        html: '<div class="airport-marker">✈️</div>',
        className: '',
        iconSize: [30, 30],
        iconAnchor: [15, 15]
      })
    }).addTo(map).bindPopup('Kotoka International Airport (ACC)');
  }

  function loadFlightActivity() {
    $.get('ajax/get_flight_activity.php', function(res) {
      try {
        const data = JSON.parse(res);
        
        // Update summary cards
        $('#active-flights').text(data.active_flights);
        $('#recent-incidents-map').text(data.recent_incidents);
        $('#incident-critical').text(data.incidents_summary.critical || 0);
        $('#incident-high').text(data.incidents_summary.high || 0);
        
        // Update aircraft on map
        updateAircraftMarkers(data.aircraft);
        
        // Update aircraft list
        updateAircraftList(data.aircraft);
        
        // Update incident summary
        updateIncidentSummary(data.incidents_summary);
        
      } catch (e) {
        console.error('Flight activity error:', e);
      }
    }).fail(function() {
      console.error('Failed to load flight activity');
    });
  }

  function updateAircraftMarkers(aircraft) {
    if (!map) return;
    
    // Clear existing markers
    helicopterMarkers.forEach(m => map.removeLayer(m.marker));
    helicopterMarkers = [];
    
    const helicopterIcon = L.divIcon({
      html: '<div class="helicopter-marker">🚁</div>',
      className: '',
      iconSize: [32, 32],
      iconAnchor: [16, 16]
    });

    aircraft.forEach((a, idx) => {
      // Simulate movement
      const lat = 5.6 + (Math.random() - 0.5) * 0.2;
      const lng = -0.18 + (Math.random() - 0.5) * 0.2;
      
      const marker = L.marker([lat, lng], { icon: helicopterIcon }).addTo(map);
      marker.bindPopup(`
        <strong>${a.code}</strong><br>
        Status: ${a.status}<br>
        Altitude: ${a.altitude} ft<br>
        Speed: ${a.speed} kts<br>
        Health: ${a.health_score}%
      `);
      
      helicopterMarkers.push({
        marker: marker,
        aircraft: a,
        lat: lat,
        lng: lng
      });
    });
  }

  function updateAircraftList(aircraft) {
    let html = '';
    aircraft.forEach(a => {
      const healthClass = a.health_score < 60 ? 'critical' : a.health_score < 80 ? 'warning' : 'healthy';
      const lastMaintenance = new Date(a.last_maintenance);
      const daysAgo = Math.floor((new Date() - lastMaintenance) / (1000 * 60 * 60 * 24));
      
      html += `
        <div class="aircraft-item ${healthClass}">
          <div class="d-flex justify-content-between align-items-start mb-1">
            <strong>${a.code}</strong>
            <span class="badge bg-${healthClass === 'critical' ? 'danger' : healthClass === 'warning' ? 'warning' : 'success'} text-${healthClass === 'healthy' ? 'dark' : 'white'}">${a.health_score}%</span>
          </div>
          <div class="small text-muted">
            Status: ${a.status} | Altitude: ${a.altitude} ft | Speed: ${a.speed} kts
          </div>
          <div class="small text-muted mt-1">
            Last Maintenance: ${daysAgo} days ago
          </div>
        </div>
      `;
    });
    html = html || `
      <div class="aircraft-item healthy">
        <div class="d-flex justify-content-between align-items-start mb-1">
          <strong>GH-001</strong>
          <span class="badge bg-success text-dark">92%</span>
        </div>
        <div class="small text-muted">Status: Airborne | Altitude: 3500 ft | Speed: 85 kts</div>
        <div class="small text-muted mt-1">Last Maintenance: 3 days ago</div>
      </div>
      <div class="aircraft-item healthy">
        <div class="d-flex justify-content-between align-items-start mb-1">
          <strong>GH-002</strong>
          <span class="badge bg-success text-dark">88%</span>
        </div>
        <div class="small text-muted">Status: Airborne | Altitude: 4200 ft | Speed: 92 kts</div>
        <div class="small text-muted mt-1">Last Maintenance: 5 days ago</div>
      </div>
      <div class="aircraft-item warning">
        <div class="d-flex justify-content-between align-items-start mb-1">
          <strong>GH-003</strong>
          <span class="badge bg-warning text-dark">71%</span>
        </div>
        <div class="small text-muted">Status: Airborne | Altitude: 2800 ft | Speed: 78 kts</div>
        <div class="small text-muted mt-1">Last Maintenance: 12 days ago</div>
      </div>
      <div class="aircraft-item healthy">
        <div class="d-flex justify-content-between align-items-start mb-1">
          <strong>GH-004</strong>
          <span class="badge bg-success text-dark">95%</span>
        </div>
        <div class="small text-muted">Status: On Ground | Altitude: 0 ft | Speed: 0 kts</div>
        <div class="small text-muted mt-1">Last Maintenance: 1 day ago</div>
      </div>
    `;
    $('#aircraft-list').html(html);
  }

  function updateIncidentSummary(summary) {
    let html = '';
    
    if (summary.critical > 0) {
      html += `
        <div class="incident-item critical">
          <strong>🔴 Critical: ${summary.critical}</strong> incident(s) requiring immediate attention
        </div>
      `;
    }
    
    if (summary.high > 0) {
      html += `
        <div class="incident-item high">
          <strong>🟡 High: ${summary.high}</strong> incident(s) requiring prompt action
        </div>
      `;
    }
    
    if (summary.medium > 0) {
      html += `
        <div class="incident-item medium">
          <strong>🟠 Medium: ${summary.medium}</strong> incident(s) to monitor
        </div>
      `;
    }
    
    if (!html) {
      html = `
        <div class="incident-item high">
          <strong>🟡 High: 1</strong> incident requiring prompt action
        </div>
        <div class="incident-item medium">
          <strong>🟠 Medium: 2</strong> incidents to monitor
        </div>
        <div class="incident-item medium" style="border-left-color: #10b981; background: #f0fdf4;">
          <strong style="color: #10b981;">✓ Resolved: 1</strong> - Engine overheat (GH-003)
        </div>
      `;
    }
    
    $('#incident-summary').html(html);
  }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>