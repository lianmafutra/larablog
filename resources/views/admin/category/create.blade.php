<x-modal id="addModal" idForm="addForm" title="Tambah Data Category">
  <x-slot name="content">
    <x-input name="name">
    </x-input>
  </x-slot>
  <x-slot name="footer">
    <x-button color="secondary" title="Batal" data-dismiss="modal" />
    <x-button color="success" title="Tambah Data" id="btnStore" type="submit" />
  </x-slot>
</x-modal>

<script type="text/javascript">
  $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $('#btnCreate').click(function(){
          $('#productForm').trigger("reset");
          $('#addModal').modal('show'); 
      });
        $('#btnStore').click(function (e) {
          e.preventDefault();
          $(this).html('Sending..');
        $.ajax({
          type: 'POST',
          url: 'category/',
          data: $('#addForm').serialize(),
          dataType: 'json',
          success: function (data) {
              $('#productForm').trigger("reset");
              $('#addModal').modal('hide');
              $('#btnStore').html('Update data');
              table.ajax.reload( null, false );
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btnStore').html('Save Changes');
              alert("Terjadi kesalahan, Coba lagi ")
          }
      });
    });
  });
</script>