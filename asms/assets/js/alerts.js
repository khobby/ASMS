$(document).ready(function(){
  if ($('#alerts-table').length) {
    $('#alerts-table').DataTable({responsive:true,pageLength:10,order:[[4,'desc']],language:{search:'Search alerts...'}});
  }
});
