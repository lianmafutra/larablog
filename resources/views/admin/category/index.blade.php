@extends('admin.partials.default')
@section('content')
<section class="section">

    <x-header>Data Category</x-header>
    <x-button id="btnCreate" data-toggle="modal" style="margin-bottom: 10px" title="Add New Category">
    </x-button>

    @table([ 'th' => ['no', 'nama', 'slug','post', 'action'],
    'id' => 'tbl-category'])

</section>

{{-- Ajax Modal CRUD --}}
@createOrUpdate()
@delete()
@data()

@endsection