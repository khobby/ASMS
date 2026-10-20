<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/sidebar.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h3 class="mb-0">Reports</h3>
    <small class="text-muted">Filter, preview and export incident reports with charts.</small>
  </div>
  <div>
    <a id="downloadPdfBtn" class="btn btn-sm btn-primary">Download PDF</a>
    <a id="exportExcelBtn" class="btn btn-sm btn-outline-secondary" href="#">Export Excel</a>
  </div>
</div>

<div class="card mb-3 p-3">
  <form id="reportFilters" class="row g-2">
    <div class="col-md-3">
      <label class="form-label">Start Date</label>
      <input type="date" name="start_date" class="form-control" />
    </div>
    <div class="col-md-3">
      <label class="form-label">End Date</label>
      <input type="date" name="end_date" class="form-control" />
    </div>
    <div class="col-md-2">
      <label class="form-label">Severity</label>
      <select name="severity" class="form-select">
        <option value="">Any</option>
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
        <option value="Critical">Critical</option>
      </select>
    </div>
    <div class="col-md-2">
      <label class="form-label">Aircraft</label>
      <input type="text" name="aircraft" class="form-control" placeholder="ICAO / Reg" />
    </div>
    <div class="col-md-2 d-flex align-items-end">
      <button type="submit" class="btn btn-primary me-2">Apply</button>
      <button id="clearFilters" type="button" class="btn btn-outline-secondary">Clear</button>
    </div>
  </form>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="card p-3 mb-3">
      <h5 class="mb-3">Incident List</h5>
      <div class="table-responsive">
        <table id="reportsTable" class="table table-sm table-striped" style="width:100%">
          <thead><tr><th>Date</th><th>Type</th><th>Location</th><th>Severity</th><th>Aircraft</th></tr></thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card p-3 mb-3">
      <h5 class="mb-3">Severity Distribution</h5>
      <canvas id="severityChart" width="400" height="300"></canvas>
    </div>
    <div class="card p-3">
      <h5 class="mb-3">Summary</h5>
      <ul id="reportSummary" class="list-unstyled mb-0">
        <li>Total incidents: <span id="totalCount">0</span></li>
      </ul>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

<!-- Dependencies: DataTables, Chart.js, jsPDF, html2canvas (CDN) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<script>
$(function(){
  var table = $('#reportsTable').DataTable({ columns: [{data:'date_occurred'},{data:'incident_type'},{data:'location'},{data:'severity'},{data:'aircraft_code'}], pageLength: 25, ordering: true });
  var severityChart = null;

  function buildQueryParams() {
    return $('#reportFilters').serialize();
  }

  function loadData() {
    var params = buildQueryParams();
    $('#exportExcelBtn').attr('href', '<?php echo BASE_URL; ?>/reports/generate_excel.php?'+params);
    $.getJSON('<?php echo BASE_URL; ?>/ajax/get_report_data.php?'+params, function(resp){
      var rows = resp.data || [];
      table.clear().rows.add(rows).draw();
      $('#totalCount').text(resp.count || 0);
      // build severity chart
      var counts = {};
      rows.forEach(function(r){ counts[r.severity] = (counts[r.severity]||0)+1; });
      var labels = Object.keys(counts);
      var data = labels.map(function(k){ return counts[k]; });
      if (severityChart) severityChart.destroy();
      var ctx = document.getElementById('severityChart').getContext('2d');
      severityChart = new Chart(ctx, { type: 'doughnut', data: { labels: labels, datasets: [{ data: data, backgroundColor: ['#f6c23e','#e74a3b','#858796','#1cc88a'] }] }, options: { responsive:true } });
    }).fail(function(){
      table.clear().draw();
      $('#totalCount').text(0);
    });
  }

  $('#reportFilters').on('submit', function(e){ e.preventDefault(); loadData(); });
  $('#clearFilters').on('click', function(){ $('#reportFilters')[0].reset(); loadData(); });

  // initial load
  loadData();

  // PDF export: capture chart + table area
  $('#downloadPdfBtn').on('click', function(){
    var { jsPDF } = window.jspdf;
    // capture chart area and table
    var chartEl = document.getElementById('severityChart');
    var tableEl = document.getElementById('reportsTable');
    // render both to images
    html2canvas(chartEl).then(function(chartCanvas){
      html2canvas(tableEl).then(function(tableCanvas){
        var doc = new jsPDF('p','pt','a4');
        var margin = 20;
        var cw = doc.internal.pageSize.getWidth() - margin*2;
        // chart
        var chartImg = chartCanvas.toDataURL('image PNG');
        doc.setFontSize(18); doc.text('Incident Report', margin, 40);
        doc.addImage(chartImg, 'PNG', margin, 60, cw, 200);
        // table below
        var tableImg = tableCanvas.toDataURL('image PNG');
        var y = 60 + 200 + 20;
        doc.addImage(tableImg, 'PNG', margin, y, cw, (tableCanvas.height * (cw / tableCanvas.width)));
        doc.save('incident_report.pdf');
      });
    });
  });

});
</script>
