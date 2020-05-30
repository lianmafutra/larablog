{{-- <x-modal id="addModal" idForm="addForm" title="Tambah Data Category">
  <x-slot name="content">
    <x-input id="name" name="name" placeholder="Name category ...">
    </x-input>
    <div class="text-danger error" data-error="name"></div>
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
          $('#addForm').trigger("reset");
          $('#addModal').modal('show'); 
      });
        $('#btnStore').click(function (e) {
          e.preventDefault();
          $(this).html('Sending..');
        $.ajax({
          type: 'POST',
          // url: 'category/',
          url: "{{ route('category.store') }}",
data: $('#addForm').serialize(),
dataType: 'json',
success: function (data) {
$('#productForm').trigger("reset");
$('#addModal').modal('hide');
$('#btnStore').html('Update data');
table.ajax.reload( null, false );
iziToast.success({
title: 'Success',
message: 'Created Data Successfully !',
position: 'topRight'
});

},
error: function (data) {

$('#btnStore').html('Save Changes');


let errors = data.responseJSON
for(let key in errors)
{
let errorDiv = $(`.error[data-error="${key}"]`);
if(errorDiv.length )
{
errorDiv.text(errors[key][0]);
}
}

}
});
});
});
</script> --}}