@extends('admin.partials.default')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Data Category</h1>
  </div>
  <a style="margin-bottom: 10px" class="btn btn-info btn-sm " href="#" data-toggle="modal" data-target="#addModal"
    role="button"><i class="fa fa-plus"></i> Tambah
    Category</a>
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

<x-modal id="updateModal" title="Edit Category Name">
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
    <x-button color="danger" title="Hapus data" id="btnDelete" type="submit" />
  </x-slot>
</x-modal>

<x-modal id="addModal" title="Tambah Data Category">
  <x-slot name="content">
    <x-input placeholder="Nama Category..." : name="name">
    </x-input>
  </x-slot>
  <x-slot name="footer">
    <x-button color="secondary" title="Batal" data-dismiss="modal" />
    <x-button color="success" title="Tambah Data" id="saveBtn" type="submit" />
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
          data: $('#productForm').serialize(),
          dataType: 'json',
          success: function (data) {
             $('#productForm').trigger("reset");
              $('#updateModal').modal('hide');
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

    

    $('#tbl-category').on('click', '.delete', function () {
            $('#deleteModal').modal('show');  
            id = $(this).attr('id'); //ambil id data yang akan dihapus ketika modal show 
            console.log(id);
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
              table.draw(); //refresh table
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

@endsection