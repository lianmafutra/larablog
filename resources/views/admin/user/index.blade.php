@extends('admin.partials.default')
@section('content')
<section class="section">

    <x-header>User Management</x-header>
    <x-button id="btnCreate" style="margin-bottom: 10px" title="Add User" href="{{ route('post.create') }}">
    </x-button>

    @table([ 'th' => ['no', 'Name', 'Email','Posts','Tipe','Role','Action','status','Last Login','created_at'],
    'id' => 'tbl-users'])




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

@include('admin.user.data')
@endsection