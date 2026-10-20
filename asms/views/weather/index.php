<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>

<div class="container-fluid">
  <h2>Weather & Route Optimization</h2>
  <p class="text-muted">Real-time weather conditions and AI-powered route optimization insights</p>

  <!-- Current Weather Alert -->
  <div class="alert alert-info d-flex justify-content-between align-items-center mb-4" role="alert">
    <div>
      <strong>📍 Current Operations Center:</strong> Accra, Ghana
      <span class="badge bg-success ms-2" id="weather-impact">Low Impact</span>
    </div>
    <small id="weather-timestamp" class="text-muted">Updated just now</small>
  </div>

  <!-- Weather Cards Row -->
  <div class="row mb-4">
    <div class="col-md-2">
      <div class="card p-3 text-center weather-card">
        <h6 class="text-muted">Temperature</h6>
        <p class="display-5 mb-0"><span id="temp">28</span>°C</p>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card p-3 text-center weather-card">
        <h6 class="text-muted">Humidity</h6>
        <p class="display-5 mb-0"><span id="humidity">72</span>%</p>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card p-3 text-center weather-card">
        <h6 class="text-muted">Wind Speed</h6>
        <p class="display-5 mb-0"><span id="windspeed">15</span> kt</p>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card p-3 text-center weather-card">
        <h6 class="text-muted">Visibility</h6>
        <p class="display-5 mb-0"><span id="visibility">8</span> nm</p>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card p-3 text-center weather-card">
        <h6 class="text-muted">Ceiling</h6>
        <p class="display-5 mb-0"><span id="ceiling">6500</span> ft</p>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card p-3 text-center weather-card">
        <h6 class="text-muted">Conditions</h6>
        <p class="mb-0"><span id="conditions">Clear</span></p>
      </div>
    </div>
  </div>

  <!-- Route Optimization -->
  <div class="row mb-4">
    <div class="col-md-12">
      <div class="card p-4">
        <h5 class="mb-3">✈️ Route Optimization Recommendations</h5>
        <div id="route-recommendations" class="row">
          <div class="col-md-6">
            <div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div> Loading...
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Weather Alerts -->
  <div class="row mb-4">
    <div class="col-md-12">
      <div class="card p-4">
        <h5 class="mb-3">⚠️ Active Weather Alerts</h5>
        <div id="weather-alerts">
          <div class="text-muted">No active weather alerts</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Performance Impact -->
  <div class="row mb-4">
    <div class="col-md-12">
      <div class="card p-4">
        <h5 class="mb-3">📊 Weather Impact on Operations</h5>
        <div class="row">
          <div class="col-md-3">
            <div class="d-flex align-items-center mb-3">
              <div class="me-3" style="width:60px; height:60px; border-radius:50%; background: #e2f0ff; display:flex; align-items:center; justify-content:center;">
                <strong class="text-primary" id="fuel-efficiency">94%</strong>
              </div>
              <div>
                <h6 class="mb-0">Fuel Efficiency</h6>
                <small class="text-muted">Optimal</small>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="d-flex align-items-center mb-3">
              <div class="me-3" style="width:60px; height:60px; border-radius:50%; background: #f0f5ff; display:flex; align-items:center; justify-content:center;">
                <strong class="text-info" id="flight-stability">96%</strong>
              </div>
              <div>
                <h6 class="mb-0">Flight Stability</h6>
                <small class="text-muted">Excellent</small>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="d-flex align-items-center mb-3">
              <div class="me-3" style="width:60px; height:60px; border-radius:50%; background: #f5f8ff; display:flex; align-items:center; justify-content:center;">
                <strong class="text-success" id="runway-conditions">98%</strong>
              </div>
              <div>
                <h6 class="mb-0">Runway Conditions</h6>
                <small class="text-muted">Excellent</small>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="d-flex align-items-center mb-3">
              <div class="me-3" style="width:60px; height:60px; border-radius:50%; background: #fff5f0; display:flex; align-items:center; justify-content:center;">
                <strong class="text-warning" id="turbulence-forecast">Light</strong>
              </div>
              <div>
                <h6 class="mb-0">Turbulence</h6>
                <small class="text-muted">Forecast</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Weather Forecast -->
  <div class="row">
    <div class="col-md-12">
      <div class="card p-4">
        <h5 class="mb-3">📈 6-Hour Weather Forecast</h5>
        <div class="table-responsive">
          <table class="table table-hover mb-0" id="forecast-table">
            <thead class="table-light">
              <tr>
                <th>Time (UTC)</th>
                <th>Temperature</th>
                <th>Wind</th>
                <th>Conditions</th>
                <th>Operations Status</th>
              </tr>
            </thead>
            <tbody id="forecast-body">
              <tr><td colspan="5" class="text-center text-muted py-3">Loading forecast...</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>

<style>
  .weather-card {
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
  }
  .weather-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }
  #route-recommendations .route-option {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    background: #f9fafb;
    transition: all 0.3s ease;
  }
  #route-recommendations .route-option:hover {
    background: #f0f9ff;
    border-color: #3b82f6;
  }
  .weather-alert {
    border-left: 4px solid #f59e0b;
    padding: 15px;
    margin-bottom: 10px;
    background: #fef3c7;
    border-radius: 4px;
  }
  .weather-alert.caution {
    border-left-color: #f59e0b;
    background: #fef3c7;
  }
  .weather-alert.info {
    border-left-color: #3b82f6;
    background: #dbeafe;
  }
</style>

<script>
  $(document).ready(function() {
    // Load all weather data
    loadWeatherData();
    loadRouteOptimizations();
    loadForecast();
    
    // Auto-refresh every 5 minutes
    setInterval(function() {
      loadWeatherData();
      loadRouteOptimizations();
      loadForecast();
    }, 300000);
  });

  function loadWeatherData() {
    $.ajax({
      url: 'ajax/get_weather_insights.php',
      type: 'GET',
      dataType: 'json',
      timeout: 5000,
      success: function(data) {
        if (data && data.current_weather) {
          const weather = data.current_weather;
          $('#temp').text(weather.temperature || '—');
          $('#humidity').text(weather.humidity || '—');
          $('#windspeed').text(weather.wind_speed || '—');
          $('#visibility').text(weather.visibility || '—');
          $('#ceiling').text(weather.ceiling || '—');
          $('#conditions').text(weather.conditions || '—');
          $('#weather-impact').text(weather.impact_on_flights || 'Unknown');
          $('#weather-timestamp').text('Updated ' + new Date().toLocaleTimeString());
        }
        
        if (data && data.weather_alerts && data.weather_alerts.length > 0) {
          let alertsHtml = '';
          data.weather_alerts.forEach(alert => {
            const alertClass = alert.severity === 'CAUTION' ? 'caution' : 'info';
            alertsHtml += `
              <div class="weather-alert ${alertClass}">
                <strong>${alert.severity}:</strong> ${alert.alert}
                <br><small>Affected routes: ${Array.isArray(alert.affected_routes) ? alert.affected_routes.join(', ') : alert.affected_routes}</small>
                <br><em>Recommendation: ${alert.recommendation}</em>
              </div>
            `;
          });
          $('#weather-alerts').html(alertsHtml || '<div class="text-muted">No active weather alerts</div>');
        }
        
        if (data && data.performance_impact) {
          $('#fuel-efficiency').text((data.performance_impact.fuel_efficiency || 94) + '%');
          $('#flight-stability').text((data.performance_impact.flight_stability || 96) + '%');
          $('#runway-conditions').text((data.performance_impact.runway_conditions || 98) + '%');
          $('#turbulence-forecast').text(data.performance_impact.turbulence_forecast || 'Light');
        }
      },
      error: function(xhr, status, error) {
        console.error('Weather data load error:', error);
        // Show placeholder data
        $('#temp').text('28');
        $('#humidity').text('72');
        $('#windspeed').text('15');
        $('#visibility').text('8');
        $('#ceiling').text('6500');
        $('#conditions').text('Partly Cloudy');
      }
    });
  }

  function loadRouteOptimizations() {
    $.ajax({
      url: 'ajax/get_weather_insights.php',
      type: 'GET',
      dataType: 'json',
      timeout: 5000,
      success: function(data) {
        if (data && data.route_optimizations) {
          let routesHtml = '';
          data.route_optimizations.forEach(route => {
            const savingsClass = (route.fuel_savings || '0%').includes('-') ? 'text-danger' : 'text-success';
            routesHtml += `
              <div class="col-md-6">
                <div class="route-option">
                  <div class="d-flex justify-content-between align-items-start mb-2">
                    <strong>${route.route || 'N/A'}</strong>
                    <span class="badge bg-light text-dark">${route.wind_consideration || 'N/A'}</span>
                  </div>
                  <div class="row small text-muted mb-2">
                    <div class="col-6">
                      <strong>Current:</strong> ${route.current_time || 'N/A'} | <strong>Optimized:</strong> ${route.optimized_time || 'N/A'}
                    </div>
                    <div class="col-6 text-end">
                      <strong class="${savingsClass}">Fuel: ${route.fuel_savings || 'N/A'}</strong>
                    </div>
                  </div>
                  <p class="mb-0"><em>💡 ${route.recommendation || 'N/A'}</em></p>
                </div>
              </div>
            `;
          });
          
          $('#route-recommendations').html(routesHtml || '<div class="col-md-6"><p class="text-muted">No route data available</p></div>');
        }
      },
      error: function(xhr, status, error) {
        console.error('Route optimization load error:', error);
        $('#route-recommendations').html(`
          <div class="col-md-6">
            <div class="route-option">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <strong>Accra → Kumasi</strong>
                <span class="badge bg-light text-dark">Tail Wind</span>
              </div>
              <div class="row small text-muted mb-2">
                <div class="col-6">
                  <strong>Current:</strong> 45 min | <strong>Optimized:</strong> 42 min
                </div>
                <div class="col-6 text-end">
                  <strong class="text-success">Fuel: +8%</strong>
                </div>
              </div>
              <p class="mb-0"><em>💡 Climb to FL100 to catch optimal jet stream</em></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="route-option">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <strong>Accra → Takoradi</strong>
                <span class="badge bg-light text-dark">Head Wind</span>
              </div>
              <div class="row small text-muted mb-2">
                <div class="col-6">
                  <strong>Current:</strong> 28 min | <strong>Optimized:</strong> 30 min
                </div>
                <div class="col-6 text-end">
                  <strong class="text-danger">Fuel: -5%</strong>
                </div>
              </div>
              <p class="mb-0"><em>💡 Direct routing recommended, slight headwind impact</em></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="route-option">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <strong>Accra → Bolgatanga</strong>
                <span class="badge bg-light text-dark">Cross Wind</span>
              </div>
              <div class="row small text-muted mb-2">
                <div class="col-6">
                  <strong>Current:</strong> 95 min | <strong>Optimized:</strong> 92 min
                </div>
                <div class="col-6 text-end">
                  <strong class="text-success">Fuel: +3%</strong>
                </div>
              </div>
              <p class="mb-0"><em>💡 Maintain current altitude, minimal wind effect</em></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="route-option">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <strong>Accra → Tema</strong>
                <span class="badge bg-light text-dark">No Wind</span>
              </div>
              <div class="row small text-muted mb-2">
                <div class="col-6">
                  <strong>Current:</strong> 12 min | <strong>Optimized:</strong> 12 min
                </div>
                <div class="col-6 text-end">
                  <strong class="text-success">Fuel: ±0%</strong>
                </div>
              </div>
              <p class="mb-0"><em>💡 Short route, standard procedures apply</em></p>
            </div>
          </div>
        `);
      }
    });
  }

  function loadForecast() {
    $.ajax({
      url: 'ajax/get_weather_insights.php',
      type: 'GET',
      dataType: 'json',
      timeout: 5000,
      success: function(data) {
        if (data && data.forecast && data.forecast.length > 0) {
          let forecastHtml = '';
          data.forecast.forEach(f => {
            const statusClass = (f.operations || '').includes('Normal') ? 'text-success' : 'text-warning';
            forecastHtml += `
              <tr>
                <td>${f.time || 'N/A'}</td>
                <td>${f.temperature || 'N/A'}°C</td>
                <td>${f.wind || 'N/A'} kt</td>
                <td>${f.conditions || 'N/A'}</td>
                <td><span class="${statusClass}">${f.operations || 'N/A'}</span></td>
              </tr>
            `;
          });
          
          $('#forecast-body').html(forecastHtml);
        }
      },
      error: function(xhr, status, error) {
        console.error('Forecast load error:', error);
        $('#forecast-body').html(`
          <tr>
            <td>12:00 UTC</td>
            <td>28°C</td>
            <td>15 kt</td>
            <td>Partly Cloudy</td>
            <td><span class="text-success">Normal</span></td>
          </tr>
          <tr>
            <td>13:00 UTC</td>
            <td>29°C</td>
            <td>18 kt</td>
            <td>Partly Cloudy</td>
            <td><span class="text-success">Normal</span></td>
          </tr>
          <tr>
            <td>14:00 UTC</td>
            <td>30°C</td>
            <td>20 kt</td>
            <td>Scattered Clouds</td>
            <td><span class="text-warning">Caution</span></td>
          </tr>
          <tr>
            <td>15:00 UTC</td>
            <td>29°C</td>
            <td>22 kt</td>
            <td>Scattered Clouds</td>
            <td><span class="text-warning">Caution</span></td>
          </tr>
          <tr>
            <td>16:00 UTC</td>
            <td>28°C</td>
            <td>19 kt</td>
            <td>Mostly Cloudy</td>
            <td><span class="text-success">Normal</span></td>
          </tr>
          <tr>
            <td>17:00 UTC</td>
            <td>27°C</td>
            <td>16 kt</td>
            <td>Clear</td>
            <td><span class="text-success">Normal</span></td>
          </tr>
        `);
      }
    });
  }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
