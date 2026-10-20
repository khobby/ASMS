$(document).ready(function(){
  if ($('#aircraft-table').length) {
    const aircraftTable = $('#aircraft-table').DataTable({responsive:true,pageLength:10,order:[[0,'asc']],language:{search:'Search aircraft...'}});
    $('#aircraft-search').on('input', function(){ aircraftTable.search(this.value).draw(); });
  }
});

function saveAircraft(form, callback) {
  const data = $(form).serialize();
  $.post('ajax/save_aircraft.php', data, function(res){
    try {
      const r = typeof res === 'object' ? res : JSON.parse(res);
      if (r.success) {
        Swal.fire('Saved','Aircraft record saved successfully.','success').then(() => {
          if (callback) callback(r);
          else location.reload();
        });
      } else {
        Swal.fire('Error', r.message || 'Save failed.', 'error');
      }
    } catch (e) {
      console.error('Save aircraft error', e, res);
      Swal.fire('Error', 'Unable to save aircraft.', 'error');
    }
  });
}

function deleteAircraft(id) {
  Swal.fire({
    title: 'Delete aircraft?',
    text: 'This action cannot be undone.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#e53e3e',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.post('ajax/delete_record.php', {id:id, type:'aircraft', csrf_token:window.csrf_token||''}, function(res){
        try {
          const r = typeof res === 'object' ? res : JSON.parse(res);
          if (r.success) {
            Swal.fire('Deleted','Aircraft record removed.','success').then(() => location.reload());
          } else {
            Swal.fire('Error', r.message || 'Delete failed.','error');
          }
        } catch (e) {
          console.error('Delete aircraft error', e, res);
          Swal.fire('Error', 'Unable to delete aircraft.', 'error');
        }
      });
    }
  });
}
