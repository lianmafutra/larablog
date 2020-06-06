<x-modal id="updateModal" idForm="editForm">
    <x-slot name="content">
        <input type="hidden" name="id" id="id">
        <input type="text" class="form-control" id="name" name="name">
        <small class=" text-danger" id="nameError"></small>
    </x-slot>
    <x-slot name="footer">
        <x-button color="secondary" title="Cancel" data-dismiss="modal" />
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

        $('#tbl-tag').on('click', '.edit', function () {
              $('#nameError').text('');
              id = $(this).attr('id');
              $('.modal-title').text("Edit Tag Name");
              $('#saveBtn').html('Update Data');
              $.ajax({
                  url: 'tag/' + id + '/edit',
                  type: 'get',
                  success: function (data) {
                    $('#updateModal').modal('show'); 
                    $('#name').val(data.name);
                    $('#id').val(data.id);
                  },
                  error: function (result) {
                        alert("terjadi kesalahan");
                   }
              });
    
          });
            $('#btnCreate').click(function(){
            $('#editForm').trigger("reset");
            $('#nameError').text('');
            document.getElementById("name").placeholder = "Input Tag Name ...";
            $('#updateModal').modal('show'); 
            $('.modal-title').text("Create Tag Name");
            $('#saveBtn').html('Add Data');
         });

          $('#saveBtn').click(function (e) {
              e.preventDefault();
              $('#nameError').text('');
              $(this).html('Sending..');
          $.ajax({
            data: $('#editForm').serialize(),
            url: "{{ route('tag.store') }}",
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#updateModal').modal('hide');
                $('#saveBtn').html('Update data');
                table.ajax.reload( null, false );
                
                iziToast.success({
                  title: 'Success',
                  message: 'Update Data Successfully !',
                  position: 'topRight'
              });},
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Add Data');
                var name = Object.keys( data.responseJSON.errors.name).length;
                if(name>0){
                    $('#nameError').text(data.responseJSON.errors.name);
                }
            }
        });
      });
});


</script>