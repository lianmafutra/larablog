@extends('admin.partials.default')
@section('content')
<section class="section">

    <x-header>Data Category</x-header>
    <x-button id="btnCreate" data-toggle="modal" style="margin-bottom: 10px" title="Tambah Data">
    </x-button>

    @table([ 'th' => ['no', 'nama', 'slug', 'action'],
    'id' => 'tbl-category'])

    @each('components.table', $jobs, 'job')

</section>

{{-- Ajax Modal CRUD--}}
@createOrUpdate()
@delete()
@data()

@endsection