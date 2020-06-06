@extends('admin.partials.default')
@section('content')
<section class="section">

    <x-header>Data Tag </x-header>
    <x-button id="btnCreate" data-toggle="modal" style="margin-bottom: 10px" title="Add New Tag">
    </x-button>

    @table([ 'th' => ['no', 'nama', 'action'],
    'id' => 'tbl-tag'])

</section>

{{-- Ajax Modal CRUD --}}
@include('admin.tag.createOrUpdate')
@include('admin.tag.delete')
@include('admin.tag.data')

@endsection