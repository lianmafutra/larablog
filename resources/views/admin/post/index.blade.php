@extends('admin.partials.default')
@section('content')
<section class="section">

    <x-header>Post Blog</x-header>
    <x-button id="btnCreate" style="margin-bottom: 10px" title="Add New Post" href="{{ route('post.create') }}">
    </x-button>

    @table([ 'th' => ['no', 'title post', 'category','thumbnail','komentar','created_at','action'],
    'id' => 'tbl-posts'])

</section>

{{-- Ajax Modal CRUD--}}
{{-- @createOrUpdate()
@delete() --}}
@include('admin.post.data');

@endsection