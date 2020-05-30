@extends('admin.partials.default')
@section('content')
<section class="section">

  <x-header>Data Category</x-header>
  <x-button id="btnCreate" data-toggle="modal" style="margin-bottom: 10px" title="Tambah Data">
  </x-button>

  @table([ 'th' => ['no', 'nama', 'slug', 'created_at', 'action'],
  'id' => 'tbl-category'])

</section>

{{-- Ajax Modal CRUD--}}
@edit()
@create()
@delete()
@data

@endsection