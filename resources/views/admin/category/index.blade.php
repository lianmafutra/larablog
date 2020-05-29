@extends('admin.partials.default')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Data Category</h1>

  </div>
  <a style="margin-bottom: 10px" class="btn btn-info btn-sm " href="{{ route('category.create') }}" role="button"><i
      class="fa fa-plus"></i> Tambah Category</a>
  <div class="section-body card">
    <div class="card-body">

      <table id="tbl-category" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Slug</th>
            <th>created_at</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</section>

<x-modal id="ajaxModel" title="Edit Category Name">

  <x-slot name="content">
    <x-input name="name">
    </x-input>
  </x-slot>

  <x-slot name="footer">
    <x-button color="secondary" title="Batal" data-dismiss="modal" />
    <x-button color="primary" title="Update Data" id="saveBtn" type="submit" />
  </x-slot>
</x-modal>

<x-modal id="deleteModal" title="Yakin ingin menghapus data !">

  <x-slot name="footer">
    <x-button color="secondary" title="Batal" data-dismiss="modal" />
    <x-button color="danger" title="Hapus data" id="saveBtn" type="submit" />
  </x-slot>
</x-modal>



<script type="text/javascript">
  $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      
     var table = $('#tbl-category').DataTable({
                processing:true,
                serverSide:true,
                pageLength: 5,
                ajax: '{!! route('category.index') !!}',
                columns: [
                      {data:'DT_RowIndex',orderable:false, searchable:false, width:'10px'}, 
                      { data: 'name', name: 'name' },
                      { data: 'id', name: 'id' },
                      { data: 'created_at', name: 'created_at' },
                      { data: 'action', name: 'action', width : '30px' }
                   ]
            }); 
        
       

      $('#tbl-category').on('click', '.edit', function () {
            $("#category").val('');
            id = $(this).attr('id');
            $.ajax({
                url: 'category/' + id + '/edit',
                type: 'get',
                success: function (data) {
                  // $('#category').val(data.name); // Set Title to Bootstrap modal title
                  $('#ajaxModel').modal('show'); // show bootstrap modal
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
          data: $('#productForm').serialize(),
          dataType: 'json',
          success: function (data) {
             $('#productForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              $('#saveBtn').html('Update data');
              table.draw();
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

{{-- <script>


        $(function() {    
          $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
          table = $('#tbl-category').DataTable({
                processing:true,
                serverSide:true,
                ajax: '{!! route('getall.category') !!}',
                columns: [
                   
                      {data:'DT_RowIndex',orderable:false, searchable:false, width:'10px'}, 
                      { data: 'name', name: 'name' },
                      { data: 'id', name: 'id' },
                      { data: 'created_at', name: 'created_at' },
                      { data: 'action', name: 'action', width : '30px' }
                   ]
            }); 
        });

                
    </script>

    <script type="text/javascript">
    
      function reload_table() {
            table.ajax.reload(null, false); //reload datatable ajax
        }

        // $('#tbl-category').on('click', '.edit', function () {
        //     $("#category").val('');
        //     var id = $(this).attr('id');
        //     $.ajax({
        //         url: 'category/' + id + '/edit',
        //         type: 'get',
        //         success: function (data) {
        //           $('#category').val(data.name); // Set Title to Bootstrap modal title
        //           $('#exampleModal').modal('show'); // show bootstrap modal
        //           $(".modal-body").css("display", "block");  
        //         },
        //         error: function (result) {
        //               alert("terjadi kesalahan");
        //          }
        //     });
  
        // });





      
   

      
    </script>
<script>
  $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
 
   /* When click edit user */
    $('#tbl-category').on('click', '.edit', function () {
      var user_id = $(this).attr('id');
      $.get('category/' + user_id +'/edit', function (data) {
         $('#userCrudModal').html("Edit User");
          $('#btn-save').val("edit-user");
          $('#ajax-crud-modal').modal('show');
          $('#user_id').val(data.id);
          $('#name').val(data.name);
          console.log(data);
      })
   });
   
  });
 

   
  
</script>

<script>
  $(document).ready(function () {
      $('#loader').hide();
      $('#edit').validate({// <- attach '.validate()' to your form
          // Rules for form validation
          rules: {
              username: {
                  required: true
              }
          },
          // Messages for form validation
          messages: {
              first_name: {
                  required: 'Please enter name'
              }
          },
          submitHandler: function (form) {

              var myData = new FormData($("#edit")[0]);
              var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
              myData.append('_token', CSRF_TOKEN);

              $.ajax({
                  url: 'contacts/' + '{{ $contact->id }}',
type: 'POST',
data: myData,
dataType: 'json',
cache: false,
processData: false,
contentType: false,
beforeSend: function () {
$('#loader').show();
$("#submit").prop('disabled', true); // disable button
},
success: function (data) {

$("#status").html(data.html);
reload_table();
$('#loader').hide();
$("#submit").prop('disabled', false); // disable button
$("html, body").animate({scrollTop: 0}, "slow");
$('#modalUser').modal('hide'); // hide bootstrap modal
}
});
}
// <- end 'submitHandler' callback }); // <- end '.validate()' }); </script> --}} @endsection