$(document).ready(function(){
  if ($('#riskMatrix').length || $('#riskDist').length) {
    // fetch distribution and draw simple charts if Chart.js present
    if (typeof Chart !== 'undefined') {
      $.get('ajax/get_risk_distribution.php', function(res){
        try {
          const data = JSON.parse(res);
          const labels = data.map(d=>d.category);
          const counts = data.map(d=>d.c);
          if ($('#riskDist').length) {
            new Chart($('#riskDist'), {type:'bar', data:{labels:labels,datasets:[{label:'Risks',data:counts,backgroundColor:'#f5a623'}]}});
          }
        } catch(e){console.error(e);}    
      });
    }
  }
});
