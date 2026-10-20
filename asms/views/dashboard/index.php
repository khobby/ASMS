<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>

<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2>Safety Dashboard</h2>
      <p class="text-muted">Real-time aviation safety metrics and analytics</p>
    </div>
    <a href="?page=weather" class="btn btn-outline-info btn-sm">
      <i class="bi bi-cloud-sun"></i> Weather & Routes
    </a>
  </div>

  <div class="row g-3">
    <div class="col-md-2">
      <div class="card p-3">
        <h6>Total Accidents</h6>
        <h3 id="total-accidents">0</h3>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card p-3">
        <h6>This Year</h6>
        <h3 id="this-year">0</h3>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card p-3">
        <h6>Avg Fatality Rate</h6>
        <h3 id="avg-fatality">0%</h3>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card p-3">
        <h6>At-Risk Components</h6>
        <h3 id="at-risk">0</h3>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card p-3">
        <h6>High Priority Risks</h6>
        <h3 id="high-risks">0</h3>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card p-3">
        <h6>Safety Trend</h6>
        <h3 id="safety-trend" class="text-success">Improving ▲</h3>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-md-12">
      <div class="card p-3 bg-light border-0 shadow-sm">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h6 class="mb-2">Active Alerts</h6>
            <p class="display-6 mb-0" id="active-alerts-count">0</p>
            <small class="text-muted">Active safety alerts currently open</small>
          </div>
          <div class="col-md-6 border-start ps-4">
            <h6 class="mb-2">Recent Incident Count</h6>
            <p class="display-6 mb-0" id="recent-incidents-count">0</p>
            <small class="text-muted">Incidents reported in the last 30 days</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-6">
      <div class="card p-3">
        <h6>Monthly Accident Trends</h6>
        <div class="chart-wrapper" style="position:relative; width:100%; height:300px;">
          <canvas id="monthlyChart"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-3">
        <h6>Risk Distribution</h6>
        <div class="chart-wrapper" style="position:relative; width:100%; height:300px;">
          <canvas id="riskDonut"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- On-Time Performance Analytics -->
  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h6>✈️ On-Time Performance Analytics</h6>
          <small class="text-muted" id="ontime-updated">Last updated: just now</small>
        </div>
        <div class="row mb-3">
          <div class="col-md-3">
            <div class="text-center p-3 bg-light rounded">
              <p class="text-muted mb-1">Overall Performance</p>
              <h3 id="overall-ontime" class="text-success">95%</h3>
              <small class="text-muted">This month: <span id="month-ontime">94%</span></small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center p-3 bg-light rounded">
              <p class="text-muted mb-1">On-Time Flights</p>
              <h3 id="ontime-flights" class="text-info">465</h3>
              <small class="text-muted">Out of 500 total</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center p-3 bg-light rounded">
              <p class="text-muted mb-1">Delayed Flights</p>
              <h3 id="delayed-flights" class="text-warning">25</h3>
              <small class="text-muted">Average delay: <span id="avg-delay">12 min</span></small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center p-3 bg-light rounded">
              <p class="text-muted mb-1">Cancelled Flights</p>
              <h3 id="cancelled-flights" class="text-danger">5</h3>
              <small class="text-muted">1% cancellation rate</small>
            </div>
          </div>
        </div>
        <div class="chart-wrapper" style="position:relative; width:100%; height:250px;">
          <canvas id="ontimeChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Operations & Recommendations -->
  <div class="row mt-4">
    <div class="col-md-8">
      <div class="card p-4">
        <h6 class="mb-3">📊 Recent Operations & Activity</h6>
        <ul class="nav nav-tabs mb-3" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#incidents-tab">Recent Incidents</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#maintenance-tab">Maintenance Updates</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#aircraft-tab">Aircraft Status</a>
          </li>
        </ul>
        <div class="tab-content">
          <div id="incidents-tab" class="tab-pane fade show active">
            <div id="recent-incidents" class="operation-list"></div>
          </div>
          <div id="maintenance-tab" class="tab-pane fade">
            <div id="maintenance-updates" class="operation-list"></div>
          </div>
          <div id="aircraft-tab" class="tab-pane fade">
            <div id="aircraft-status" class="operation-list"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4">
        <h6 class="mb-3">💡 AI-Powered Recommendations</h6>
        <div id="recommendations-critical" class="mb-3"></div>
        <div id="recommendations-important" class="mb-3"></div>
        <div id="recommendations-info"></div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-7">
      <div class="card p-3">
        <h6>Recent Accidents</h6>
        <table class="table" id="recent-accidents">
          <thead><tr><th>Date</th><th>Aircraft</th><th>Location</th><th>Type</th><th>Severity</th></tr></thead>
          <tbody id="recent-accidents-body"></tbody>
        </table>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card p-3">
        <h6>Maintenance Alerts</h6>
        <ul id="maintenance-alerts" class="list-group list-group-flush"></ul>
      </div>
    </div>
  </div>

</div>

<style>
  .operation-list .operation-item {
    padding: 12px;
    border-left: 4px solid #e2e8f0;
    margin-bottom: 10px;
    background: #f9fafb;
    border-radius: 4px;
  }
  .operation-list .operation-item.critical {
    border-left-color: #e53e3e;
    background: #fee;
  }
  .operation-list .operation-item.high {
    border-left-color: #ed8936;
    background: #fef3c7;
  }
  .operation-list .operation-item.normal {
    border-left-color: #38a169;
    background: #f0fdf4;
  }
  
  .recommendation {
    padding: 12px;
    margin-bottom: 10px;
    border-radius: 6px;
    font-size: 14px;
  }
  .recommendation.critical {
    background: #fee;
    border-left: 4px solid #e53e3e;
    color: #7f1d1d;
  }
  .recommendation.important {
    background: #fef3c7;
    border-left: 4px solid #ed8936;
    color: #78350f;
  }
  .recommendation.info {
    background: #dbeafe;
    border-left: 4px solid #3b82f6;
    color: #0c2d6b;
  }
</style>

<script>
  $(document).ready(function() {
    loadDashboardStats();
    loadMonthlyChart();
    loadRiskDonut();
    loadRecentAccidents();
    loadRecentAlerts();
    loadOntimePerformance();
    loadRecentOperations();
    
    // Auto-refresh every 2 minutes
    setInterval(loadDashboardStats, 120000);
  });

  function loadDashboardStats() {
    $.get('ajax/get_dashboard_stats.php', function(res) {
      try {
        const data = JSON.parse(res);
        $('#total-accidents').text(data.total_accidents);
        $('#this-year').text(data.this_year);
        $('#avg-fatality').text(data.avg_fatality + '%');
        $('#at-risk').text(data.at_risk);
        $('#high-risks').text(data.high_risks);
        $('#active-alerts-count').text(data.active_alerts);
        $('#recent-incidents-count').text(data.recent_incidents);
      } catch (e) {
        console.error('Invalid dashboard response', e);
      }
    });
  }

  function loadMonthlyChart() {
    $.get('ajax/get_monthly_accidents.php', function(res) {
      try {
        const data = JSON.parse(res);
        if (data && data.length > 0) {
          renderMonthlyChart(data);
        }
      } catch(e) { console.error('Monthly chart error:', e); }
    }).fail(function(){ console.error('Failed to load monthly accidents'); });
  }

  function renderMonthlyChart(data) {
    if (typeof Chart === 'undefined') return;
    const labels = Array.from({length:12},(_,i)=>['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'][i]);
    const counts = new Array(12).fill(0);
    data.forEach(d => { counts[d.m-1] = parseInt(d.c); });
    const ctx = document.getElementById('monthlyChart');
    if (!ctx) return;
    if (window.monthlyChartInstance) window.monthlyChartInstance.destroy();
    window.monthlyChartInstance = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Accidents',
          data: counts,
          backgroundColor: '#e53e3e',
          borderColor: '#c53030',
          borderWidth: 1,
          borderRadius: 4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: { beginAtZero: true }
        },
        layout: { padding: { top: 10, right: 10, bottom: 10, left: 10 } },
        plugins: { legend: { display: true } }
      }
    });
  }

  function loadRiskDonut() {
    $.get('ajax/get_risk_distribution.php', function(res) {
      try {
        const data = JSON.parse(res);
        renderRiskChart(data);
      } catch(e) { console.error('Risk chart error:', e); }
    }).fail(function(){ console.error('Failed to load risk distribution'); });
  }

  function renderRiskChart(data) {
    if (typeof Chart === 'undefined') return;
    const ctx = document.getElementById('riskDonut');
    if (!ctx) return;
    if (window.riskChartInstance) window.riskChartInstance.destroy();
    
    const labels = data.map(d => d.risk_type);
    const values = data.map(d => parseInt(d.count));
    const colors = ['#e53e3e', '#ed8936', '#f6ad55', '#38a169'];
    
    window.riskChartInstance = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: labels,
        datasets: [{
          data: values,
          backgroundColor: colors.slice(0, labels.length),
          borderColor: '#fff',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'bottom', labels: { boxWidth: 12, padding: 15 } }
        }
      }
    });
  }

  function loadRecentAccidents() {
    $.get('ajax/get_recent_incidents.php', function(res) {
      try {
        const data = JSON.parse(res);
        let html = '';
        data.slice(0, 5).forEach(incident => {
          const severity = incident.severity || 'Medium';
          const severityClass = {
            'Critical': 'badge-severity-critical',
            'High': 'badge-severity-serious',
            'Medium': 'badge-severity-minor'
          }[severity] || 'badge-severity-minor';
          
          html += `<tr>
            <td>${incident.incident_date}</td>
            <td>${incident.aircraft_code || 'N/A'}</td>
            <td>${incident.location || 'N/A'}</td>
            <td>${incident.incident_type || 'Unknown'}</td>
            <td><span class="badge ${severityClass}">${severity}</span></td>
          </tr>`;
        });
        $('#recent-accidents-body').html(html);
      } catch (e) {
        console.error('Incidents error:', e);
      }
    }).fail(function(){ console.error('Failed to load recent incidents'); });
  }

  function loadRecentAlerts() {
    $.get('ajax/get_recent_alerts.php', function(res) {
      try {
        const data = JSON.parse(res);
        let html = '';
        data.slice(0, 5).forEach(alert => {
          html += `<li class="list-group-item">
            <small><strong>${alert.alert_type}</strong><br>${alert.message}</small>
          </li>`;
        });
        $('#maintenance-alerts').html(html || '<li class="list-group-item text-muted">No alerts</li>');
      } catch (e) {
        console.error('Alerts error:', e);
      }
    }).fail(function(){ console.error('Failed to load alerts'); });
  }

  function loadOntimePerformance() {
    $.get('ajax/get_ontime_performance.php', function(res) {
      try {
        const data = JSON.parse(res);
        
        $('#overall-ontime').text(data.overall_performance + '%');
        $('#month-ontime').text(data.this_month + '%');
        $('#ontime-flights').text(data.summary.on_time_flights);
        $('#delayed-flights').text(data.summary.delayed_flights);
        $('#cancelled-flights').text(data.summary.cancelled_flights);
        $('#avg-delay').text(Math.round(data.summary.delayed_flights * 0.48) + ' min');
        
        renderOntimeChart(data.performance_trend);
      } catch (e) {
        console.error('Ontime performance error:', e);
      }
    }).fail(function(){ console.error('Failed to load ontime performance'); });
  }

  function renderOntimeChart(trend) {
    if (typeof Chart === 'undefined') return;
    const ctx = document.getElementById('ontimeChart');
    if (!ctx) return;
    if (window.ontimeChartInstance) window.ontimeChartInstance.destroy();
    
    const labels = trend.map(t => t.month);
    const values = trend.map(t => t.on_time_percentage);
    
    window.ontimeChartInstance = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'On-Time Performance %',
          data: values,
          borderColor: '#38a169',
          backgroundColor: 'rgba(56, 161, 105, 0.1)',
          borderWidth: 3,
          fill: true,
          tension: 0.4,
          pointBackgroundColor: '#38a169',
          pointBorderColor: '#fff',
          pointBorderWidth: 2,
          pointRadius: 5
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: { min: 80, max: 100, ticks: { callback: function(v) { return v + '%'; } } }
        },
        plugins: { legend: { display: true } }
      }
    });
  }

  function loadRecentOperations() {
    $.get('ajax/get_recent_operations.php', function(res) {
      try {
        const data = JSON.parse(res);
        
        // Load incidents
        let incidentsHtml = '';
        data.recent_incidents.forEach(inc => {
          const severityClass = inc.severity === 'Critical' ? 'critical' : inc.severity === 'High' ? 'high' : 'normal';
          incidentsHtml += `
            <div class="operation-item ${severityClass}">
              <div><strong>${inc.aircraft}</strong> - ${inc.type}</div>
              <small>${inc.date} | Severity: ${inc.severity} | Status: ${inc.status}</small>
            </div>
          `;
        });
        $('#recent-incidents').html(incidentsHtml || '<p class="text-muted">No recent incidents</p>');
        
        // Load maintenance
        let maintHtml = '';
        data.maintenance_updates.forEach(maint => {
          const statusClass = maint.status === 'Pending' ? 'critical' : 'normal';
          maintHtml += `
            <div class="operation-item ${statusClass}">
              <div><strong>${maint.aircraft}</strong> - ${maint.component}</div>
              <small>${maint.date} | ${maint.type} | Status: ${maint.status}</small>
            </div>
          `;
        });
        $('#maintenance-updates').html(maintHtml || '<p class="text-muted">No maintenance updates</p>');
        
        // Load aircraft status
        let aircraftHtml = '';
        data.aircraft_status.forEach(a => {
          const healthClass = a.health_score < 40 ? 'critical' : a.health_score < 60 ? 'high' : 'normal';
          aircraftHtml += `
            <div class="operation-item ${healthClass}">
              <div><strong>${a.aircraft}</strong> | Health: ${a.health_score}% | Status: ${a.status}</div>
              <small>Last Flight: ${a.last_flight}</small>
              <div class="mt-1"><em>💡 ${a.recommendation}</em></div>
            </div>
          `;
        });
        $('#aircraft-status').html(aircraftHtml || '<p class="text-muted">No aircraft status</p>');
        
        // Load recommendations
        let criticalRec = '';
        data.recommendations.critical.forEach(r => {
          criticalRec += `<div class="recommendation critical">${r}</div>`;
        });
        $('#recommendations-critical').html(criticalRec);
        
        let importantRec = '';
        data.recommendations.important.forEach(r => {
          importantRec += `<div class="recommendation important">${r}</div>`;
        });
        $('#recommendations-important').html(importantRec);
        
        let infoRec = '';
        data.recommendations.info.forEach(r => {
          infoRec += `<div class="recommendation info">${r}</div>`;
        });
        $('#recommendations-info').html(infoRec);
        
      } catch (e) {
        console.error('Recent operations error:', e);
      }
    }).fail(function(){ console.error('Failed to load recent operations'); });
  }

  function loadRiskDonut() {
    $.get('ajax/get_risk_distribution.php', function(res) {
      try {
        const data = JSON.parse(res);
        renderRiskChart(data);
      } catch(e) { console.error('Risk chart error:', e); }
    }).fail(function(){ console.error('Failed to load risk distribution'); });
  }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
