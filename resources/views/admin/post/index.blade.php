@extends('admin.partials.default')
@section('content')
<section class="section">

    <x-header>Post Blog</x-header>
    <x-button id="btnCreate" style="margin-bottom: 10px" title="Add New Post" href="{{ route('post.create') }}">
    </x-button>

    @table([ 'th' => ['no', 'title post', 'category','thumbnail','komentar','creator','created_at','action'],
    'id' => 'tbl-posts'])



</section>
<form id="deleteForm" method="POST" role="form">
    @csrf
    @method('delete')
    <x-modal id="deleteModal" idForm="deleteForm" title="Apakah anda yakin ingin menghapus post ?">

        <x-slot name="footer">
            <x-button color="secondary" title="Batal" data-dismiss="modal" />
            <button type="submit" class="btn btn-danger" onclick="formSubmit()">Delete Data
            </button>
        </x-slot>
    </x-modal>
</form>

@include('admin.post.data');
<script>
    $('#tbl-posts tbody').on('click', '.delete', function () {
              $('#deleteModal').modal('show');  
              id = $(this).attr('id'); 
              var url = 'post/' + id;
              $(" #deleteForm").attr('action', url); let data=table.row( $(this).parents('tr') ).data();
              $('#deleteModal .modal-title').text("Yakin ingin menghapus Post, " +data.title+" ?"); }); 
             
             function formSubmit() { 
                    $("#deleteForm").submit(); 
                } 
</script>
@endsection