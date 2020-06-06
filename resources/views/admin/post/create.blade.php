@extends('admin.partials.default')
@section('content')
<section class="section">
    <x-header>Creata new post</x-header>
    {{-- <h2>belum ada data</h2> --}}

    <div class="card">
        <div class="card-body">
            <form action="{{ route('post.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                @if ($errors->any())
                <div style="padding:20px; margin-bottom: 20px" class="aler alert-danger">
                    @foreach ($errors->all() as $err )
                    <li><span>{{ $err }}</span></li>
                    @endforeach
                </div>
                @endif
                <x-input id="title" name="title" label="Title" placeholder="Input Tittle ..." />
                <label>Category</label>
                <div class="form-group">
                    <select id="category" name="category_id" class="form-control select2" style="width:100%!important;">
                        <option value="" holder>Select Category</option>
                        @foreach ($category as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <label>Tag</label>
                <div class="form-group">
                    <select id="tag" name="tag" class="form-control select2" style="width:100%!important;"
                        multiple="multiple">
                        <option value="" holder>Select Tag</option>
                        @foreach ($tags as $item)
                        <option value="{{ $item->name}}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input id="content" name="content" label="Konten" placeholder="" />
                <x-input type="file" id="thumbnail" name="thumbnail" label="Thumbnail" />
                <x-button color="success" title="Back" href="{{ route('post.index')}}" />
                <button type="submit" class="btn btn-primary">Publish Post</button>
            </form>
        </div>

    </div>


</section>

<script>
    $('#category').select2(
      
        allowClear: true,
    );
    $('#tag').select2(
      
      allowClear: true,
  );

</script>

@endsection