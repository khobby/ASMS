$(document).ready(function(){
  if ($('#maintenance-alerts').length) {
    $.get('ajax/get_maintenance_summary.php', function(res){
      try{
        const data = JSON.parse(res);
        data.forEach(function(it){
          $('#maintenance-alerts').append('<li class="list-group-item">Component ID '+it.component_id+' - '+it.c+' maintenance records</li>');
        });
      }catch(e){console.error(e);}    
    });
  }
});
