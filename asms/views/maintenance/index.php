<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h3 class="mb-0">Predictive Maintenance</h3>
    <small class="text-muted">Monitor component health and scheduled maintenance with AI predictions.</small>
  </div>
  <a class="btn btn-primary" href="?page=maintenance&action=create">Schedule Maintenance</a>
</div>

<!-- Predictive Maintenance Summary -->
<div class="row mb-4">
  <div class="col-md-3">
    <div class="card p-3 text-center">
      <h6 class="text-muted mb-2">⚠️ Critical Alerts</h6>
      <h2 id="critical-count" class="text-danger">0</h2>
      <small class="text-muted">Immediate action required</small>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card p-3 text-center">
      <h6 class="text-muted mb-2">🔴 High Risk</h6>
      <h2 id="high-risk-count" class="text-warning">0</h2>
      <small class="text-muted">Schedule within 2 weeks</small>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card p-3 text-center">
      <h6 class="text-muted mb-2">🟢 Monitoring</h6>
      <h2 id="monitoring-count" class="text-success">0</h2>
      <small class="text-muted">Continue normal monitoring</small>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card p-3 text-center">
      <h6 class="text-muted mb-2">📅 At-Risk Components</h6>
      <h2 id="total-atrisk" class="text-info">0</h2>
      <small class="text-muted">Requires attention</small>
    </div>
  </div>
</div>

<!-- Critical Alerts Section -->
<div id="critical-alerts-section" class="row mb-4" style="display:none;">
  <div class="col-md-12">
    <div class="card p-3 border-danger">
      <h6 class="text-danger mb-3">🚨 CRITICAL MAINTENANCE ALERTS</h6>
      <div id="critical-alerts-list" class="alert-list"></div>
    </div>
  </div>
</div>

<!-- High Risk Section -->
<div id="high-risk-section" class="row mb-4" style="display:none;">
  <div class="col-md-12">
    <div class="card p-3 border-warning">
      <h6 class="text-warning mb-3">⚠️ HIGH RISK COMPONENTS</h6>
      <div id="high-risk-list" class="alert-list"></div>
    </div>
  </div>
</div>

<!-- Component Health Overview -->
<div class="row mb-4">
  <div class="col-md-12">
    <div class="card p-3">
      <h6 class="mb-3">🔧 Component Health Overview</h6>
      <div id="component-grid" class="row"></div>
    </div>
  </div>
</div>

<!-- Maintenance History -->
<div class="card p-3 mb-4">
  <h5>Recent Maintenance</h5>
  <div class="table-responsive">
    <table class="table table-sm mt-3">
      <thead><tr><th>Date</th><th>Aircraft</th><th>Component</th><th>Type</th><th>Status</th></tr></thead>
      <tbody id="maintenance-table-body">
        <?php if (!empty($records)): ?>
          <?php foreach($records as $record): ?>
            <tr>
              <td><?php echo e($record['maintenance_date']); ?></td>
              <td><?php echo e($record['aircraft_code'] ?: '—'); ?></td>
              <td><?php echo e($record['component_name'] ?: '—'); ?></td>
              <td><?php echo e($record['maintenance_type']); ?></td>
              <td><?php echo e($record['status']); ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="5" class="text-center">No maintenance records available.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<style>
  .health-card {
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 15px;
    margin-bottom: 15px;
    position: relative;
    transition: all 0.3s ease;
  }
  .health-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }
  .health-card.critical {
    border-left: 4px solid #e53e3e;
    background: #fef2f2;
  }
  .health-card.high {
    border-left: 4px solid #ed8936;
    background: #fffbf0;
  }
  .health-card.normal {
    border-left: 4px solid #38a169;
    background: #f0fdf4;
  }
  
  .alert-item {
    padding: 12px;
    margin-bottom: 10px;
    border-radius: 4px;
    background: white;
    border-left: 4px solid #f59e0b;
  }
  .alert-item.critical {
    border-left-color: #e53e3e;
    background: #fef2f2;
  }
  .alert-item.high {
    border-left-color: #ed8936;
    background: #fffbf0;
  }
  
  .health-bar {
    height: 6px;
    background: #e5e7eb;
    border-radius: 3px;
    overflow: hidden;
    margin: 8px 0;
  }
  .health-bar-fill {
    height: 100%;
    border-radius: 3px;
    transition: width 0.3s ease;
  }
  .health-bar-fill.critical {
    background: #e53e3e;
    width: 35%;
  }
  .health-bar-fill.high {
    background: #ed8936;
    width: 65%;
  }
  .health-bar-fill.normal {
    background: #38a169;
    width: 85%;
  }
</style>

<script>
  $(document).ready(function() {
    loadMaintenancePredictions();
    
    // Auto-refresh every 5 minutes
    setInterval(loadMaintenancePredictions, 300000);
  });

  function loadMaintenancePredictions() {
    $.get('ajax/get_maintenance_predictions.php', function(res) {
      try {
        const data = JSON.parse(res);
        
        // Update counts
        $('#critical-count').text(data.summary.critical_count);
        $('#high-risk-count').text(data.high_risk.length);
        $('#monitoring-count').text(data.scheduled.length);
        $('#total-atrisk').text(data.summary.total_at_risk);
        
        // Display critical alerts
        if (data.critical_alerts.length > 0) {
          $('#critical-alerts-section').show();
          let criticalHtml = '';
          data.critical_alerts.forEach(alert => {
            criticalHtml += `
              <div class="alert-item critical">
                <div class="d-flex justify-content-between align-items-start">
                  <div>
                    <strong>${alert.component}</strong> | ${alert.aircraft}
                    <div class="small text-muted mt-1">
                      Health Score: <strong class="text-danger">${alert.health_score}%</strong> | 
                      Predicted Failure: <strong>${alert.predicted_failure_days} days</strong> | 
                      Confidence: ${alert.confidence}%
                    </div>
                  </div>
                  <span class="badge bg-danger">CRITICAL</span>
                </div>
                <div class="mt-2 bg-white p-2 rounded">
                  <em>💡 ${alert.recommendation}</em>
                </div>
              </div>
            `;
          });
          $('#critical-alerts-list').html(criticalHtml);
        } else {
          $('#critical-alerts-section').hide();
        }
        
        // Display high-risk alerts
        if (data.high_risk.length > 0) {
          $('#high-risk-section').show();
          let highRiskHtml = '';
          data.high_risk.forEach(alert => {
            highRiskHtml += `
              <div class="alert-item high">
                <div class="d-flex justify-content-between align-items-start">
                  <div>
                    <strong>${alert.component}</strong> | ${alert.aircraft}
                    <div class="small text-muted mt-1">
                      Health Score: <strong class="text-warning">${alert.health_score}%</strong> | 
                      Predicted Failure: <strong>${alert.predicted_failure_days} days</strong> | 
                      Confidence: ${alert.confidence}%
                    </div>
                  </div>
                  <span class="badge bg-warning">HIGH RISK</span>
                </div>
                <div class="mt-2 bg-white p-2 rounded">
                  <em>💡 ${alert.recommendation}</em>
                </div>
              </div>
            `;
          });
          $('#high-risk-list').html(highRiskHtml);
        } else {
          $('#high-risk-section').hide();
        }
        
        // Display component grid
        let componentHtml = '';
        const allComponents = [...data.critical_alerts, ...data.high_risk, ...data.scheduled];
        allComponents.forEach(comp => {
          const statusClass = comp.risk_factor === 'CRITICAL' ? 'critical' : comp.risk_factor === 'HIGH' ? 'high' : 'normal';
          const healthClass = comp.health_score <= 35 ? 'critical' : comp.health_score <= 60 ? 'high' : 'normal';
          
          componentHtml += `
            <div class="col-md-3">
              <div class="health-card ${statusClass}">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <div>
                    <h6 class="mb-0">${comp.component}</h6>
                    <small class="text-muted">${comp.aircraft}</small>
                  </div>
                  <span class="badge bg-${statusClass === 'critical' ? 'danger' : statusClass === 'high' ? 'warning' : 'success'} text-${statusClass === 'critical' || statusClass === 'high' ? 'white' : 'dark'}">${comp.risk_factor}</span>
                </div>
                <div class="health-bar">
                  <div class="health-bar-fill ${healthClass}"></div>
                </div>
                <div class="d-flex justify-content-between">
                  <small class="text-muted">Health: <strong>${comp.health_score}%</strong></small>
                  <small class="text-muted">Confidence: ${comp.confidence}%</small>
                </div>
                <div class="mt-2 small"><em>${comp.recommendation}</em></div>
              </div>
            </div>
          `;
        });
        $('#component-grid').html(componentHtml || '<p class="text-muted">No components to display</p>');
        
      } catch (e) {
        console.error('Maintenance predictions error:', e);
      }
    }).fail(function() {
      console.error('Failed to load maintenance predictions');
    });
  }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
