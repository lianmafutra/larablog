<x-modal id="deleteModal" idForm="deleteForm">
    <x-slot name="footer">
        <x-button color="secondary" title="Batal" data-dismiss="modal" />
        <x-button color="danger" title="Hapus data" id="btnDelete" type="submit" />
    </x-slot>
</x-modal>

<script type="text/javascript">
    $(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
       
  
      $('#tbl-category tbody').on('click', '.delete', function () {
              $('#deleteModal').modal('show');  
              id = $(this).attr('id'); 
              let data = table.row( $(this).parents('tr') ).data();
              $('#deleteModal .modal-title').text("Yakin ingin menghapus data category, " +data.name+" ?");
          });
  
      $('#btnDelete').click(function (e) {
          e.preventDefault();
          $(this).html('Delete..');
          $.ajax({
            type: 'DELETE',
            url: 'category/' + id,
            success: function (data) {
                $('#deleteModal').modal('hide'); 
                $('#btnDelete').html('Delete data');
                table.ajax.reload( null, false );
                iziToast.success({
                  title: 'Success',
                  message: 'Delete Data Successfully !',
                  position: 'topRight'
              });
            },
            error: function (data) {
                console.log('Error:', data);
                $('#btnDelete').html('Delete data');
                alert("Terjadi kesalahan, Coba lagi ")
            }
        });
      });
      
    });
</script>