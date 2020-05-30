<x-modal id="updateModal" idForm="editForm" title="Edit Category Name">
    <x-slot name="content">
        <x-input placeholder="Nama Category..." : name="name">
        </x-input>
    </x-slot>
    <x-slot name="footer">
        <x-button color="secondary" title="Batal" data-dismiss="modal" />
        <x-button color="primary" title="Update Data" id="saveBtn" type="submit" />
    </x-slot>
</x-modal>

<script type="text/javascript">
    $(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
  
      
        $('#tbl-category').on('click', '.edit', function () {
              $("#category").val('');
              id = $(this).attr('id');
              $.ajax({
                  url: 'category/' + id + '/edit',
                  type: 'get',
                  success: function (data) {
                    $('#updateModal').modal('show'); 
                    $('#name').val(data.name);
                  },
                  error: function (result) {
                        alert("terjadi kesalahan");
                   }
              });
    
          });
  
    
          $('#saveBtn').click(function (e) {
              e.preventDefault();
              $(this).html('Sending..');
          $.ajax({
            type: 'PUT',
            url: 'category/' + id,
            data: $('#editForm').serialize(),
            dataType: 'json',
            success: function (data) {
               //$('#productForm').trigger("reset");
                $('#updateModal').modal('hide');
                $('#saveBtn').html('Update data');
                table.ajax.reload( null, false );
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
                alert("Terjadi kesalahan, Coba lagi ")
            }
        });
      });
  
      
  
      
      });
</script>