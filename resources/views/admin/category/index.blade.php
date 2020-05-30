@extends('admin.partials.default')
@section('content')
<section class="section">

  <x-header>Data Category</x-header>

  <x-button color="info" data-target="#addModal" style="margin-bottom: 10px" data-toggle="modal" title="Tambah Data">
  </x-button>

  @table([
  'th' => ['no', 'nama', 'slug', 'created_at', 'action'],
  'id' => 'tbl-category'])


</section>

@edit
@create
@delete
@data

@endsection