$(document).ready(function() {
    loadDashboardStats();
    loadMonthlyChart();
    loadRiskDonut();
    loadRecentAccidents();
    loadRecentAlerts();
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
            // render monthly if present
            if (data.monthly) {
                renderMonthlyChart(data.monthly);
            }
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
    window.monthlyChartInstance = new Chart(ctx, { type:'bar', data:{ labels:labels, datasets:[{ label:'Accidents', data:counts, backgroundColor:'#e53e3e' }] }, options:{ responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true } }, layout:{ padding: { top: 10, right: 10, bottom: 10, left: 10 } } } });
}

function loadRiskDonut() {
    $.get('ajax/get_risk_distribution.php', function(res){
        try{ 
            const data = JSON.parse(res); 
            if (data && data.length > 0) { 
                renderRiskDonut(data); 
            } else {
                renderRiskDonut([{category:'No Data',c:1}]);
            }
        } catch(e){
            console.error('Risk distribution error:', e);
            renderRiskDonut([{category:'No Data',c:1}]);
        }
    }).fail(function(){ console.error('Failed to load risk distribution'); });
}

function loadRecentAccidents() {
    if (!$('#recent-accidents-body').length) return;
    $.get('ajax/get_recent_incidents.php', function(res) {
        try {
            const rows = JSON.parse(res);
            const body = $('#recent-accidents-body');
            body.empty();
            if (!rows || rows.length === 0) {
                body.append('<tr><td colspan="5" class="text-center text-muted">No recent incidents found</td></tr>');
                return;
            }
            rows.forEach(function(row) {
                body.append('<tr>' +
                    '<td>' + row.date_occurred + '</td>' +
                    '<td>' + (row.aircraft || 'Unknown') + '</td>' +
                    '<td>' + row.location + '</td>' +
                    '<td>' + row.type + '</td>' +
                    '<td>' + row.severity + '</td>' +
                    '</tr>');
            });
        } catch (e) { console.error('Recent accidents error:', e); }
    }).fail(function(){ console.error('Failed to load recent incidents'); });
}

function loadRecentAlerts() {
    if (!$('#maintenance-alerts').length) return;
    $.get('ajax/get_recent_alerts.php', function(res) {
        try {
            const rows = JSON.parse(res);
            const list = $('#maintenance-alerts');
            list.empty();
            if (!rows || rows.length === 0) {
                list.append('<li class="list-group-item text-muted">No active alerts at this time.</li>');
                return;
            }
            rows.forEach(function(row) {
                list.append('<li class="list-group-item"><strong>' + row.title + '</strong><br><small>' + row.message + '</small><span class="badge bg-danger float-end">' + row.severity + '</span></li>');
            });
        } catch (e) { console.error('Recent alerts error:', e); }
    }).fail(function(){ console.error('Failed to load recent alerts'); });
}

function renderRiskDonut(data) {
    if (typeof Chart === 'undefined') return;
    const labels = data.map(d=>d.category);
    const counts = data.map(d=>d.c);
    const ctx = document.getElementById('riskDonut');
    if (!ctx) return;
    if (window.riskDonutInstance) window.riskDonutInstance.destroy();
    window.riskDonutInstance = new Chart(ctx, { type:'doughnut', data:{ labels: labels, datasets:[{ data: counts, backgroundColor:['#3182ce','#f5a623','#e53e3e','#38a169'] }] }, options:{ responsive:true, maintainAspectRatio:false, plugins:{ legend:{ position:'bottom' } }, layout:{ padding: { top: 10, right: 10, bottom: 10, left: 10 } } } });
}
