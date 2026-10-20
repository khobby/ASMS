$(document).ready(function(){
  if ($('#incidents-table').length) {
    const incidentsTable = $('#incidents-table').DataTable({responsive:true,pageLength:10,order:[[0,'desc']],language:{search:'Search accidents...'}});
    $('#incident-search').on('input', function(){ incidentsTable.search(this.value).draw(); });
  }
});

function saveIncident(form, callback) {
  const data = $(form).serialize();
  $.post('ajax/save_incident.php', data, function(res){
    try {
      const r = typeof res === 'object' ? res : JSON.parse(res);
      if (r.success) {
        Swal.fire('Saved','Incident saved successfully.','success').then(() => {
          if (callback) callback(r);
          else location.reload();
        });
      } else {
        Swal.fire('Error', r.message || 'Save failed.', 'error');
      }
    } catch (e) {
      console.error('Save incident error', e, res);
      Swal.fire('Error', 'Unable to save incident.', 'error');
    }
  });
}

function deleteIncident(id) {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This cannot be undone.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#e53e3e',
    confirmButtonText: 'Yes, delete it!'
  }).then((res) => {
    if (res.isConfirmed) {
      $.post('ajax/delete_record.php', {id:id, type:'incident', csrf_token:window.csrf_token||''}, function(r){
        try {
          const rr = typeof r === 'object' ? r : JSON.parse(r);
          if (rr.success) location.reload();
          else Swal.fire('Error', rr.message || 'Failed to delete record.','error');
        } catch (e) {
          console.error(e);
          Swal.fire('Error', 'Unexpected error deleting record.','error');
        }
      });
    }
  });
}
