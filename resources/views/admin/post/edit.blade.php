@extends('admin.partials.default')
@section('content')
<section class="section">
    <x-header>Edit post</x-header>
    {{-- <h2>belum ada data</h2> --}}

    <div class="card">
        <div class="card-body">
            <form role="form" action="{{ route('post.update', $post) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                @if ($errors->any())
                <div style="padding:20px; margin-bottom: 20px" class="aler alert-danger">
                    @foreach ($errors->all() as $err )
                    <li><span>{{ $err }}</span></li>
                    @endforeach
                </div>
                @endif

                <x-input id="title" name="title" label="Title" placeholder="Input Tittle ..."
                    value="{{ $post->title }}" />

                <label>Category</label>

                <div class="form-group">
                    <select id="category" name="category_id" class="form-control select2" style="width:100%!important;">
                        {{-- <option value="" holder>Select Category</option> --}}
                        @foreach ($category as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <label>Tag</label>
                <div class="form-group">
                    <select id="tags" name="tags[]" class="form-control select2" style="width:100%!important;"
                        multiple="multiple">
                        <option value="" holder>Select Tag</option>
                        @foreach ($post->tags as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input id="content" name="content" label="Konten" value="{{ $post->content }}" />

                <label><b>Thumbnail</b></label><br>

                <img id="img_thum" name="img_thum" style=" padding-bottom:5px" src="{{ asset($post->getThumbnail()) }}"
                    height="200px">

                <input type="text" value="default" id="thumb_stat" name="thumb_stat" style="display: none" />

                <div class="form-group">
                    <a id="btnDelThumbnail" href="javascript:void(0)"
                        style=" display: inline-block; margin-bottom: 10px" class="btn btn-danger btn-sm delete"
                        role="button" aria-pressed="true"> <i class="fa fa-trash"></i>
                        Delete thumbnail</a>
                    <br>
                    <input type="file" value="" id="thumbnail" name="thumbnail" onchange="previewImage();" />
                </div>


                <div class="form-group" style="float: right">
                    <x-button color="success" title="Back" href="{{ route('post.index')}}" />
                    <button type="submit" class="btn btn-primary">Publish Post</button>
                </div>

            </form>
        </div>

    </div>


</section>

<script>
    $('#category').val({!! json_encode($post->category_id) !!}).trigger('change');
  


    //Delete img thumnbnail
    $('#btnDelThumbnail').click(function(){
         $("#img_thum").attr("src","https://via.placeholder.com/150x200.png?text=No+Cover");
         document.getElementById("btnDelThumbnail").style.display = "none";
         $("#thumb_stat").val("hapus");

    });

    //check kondisi jika image null/ tidak ada cover
    let thumbnail = {!! json_encode($post->getThumbnail()) !!} ;
    if(thumbnail=='https://via.placeholder.com/150x200.png?text=No+Cover'){
        document.getElementById("btnDelThumbnail").style.display = "none";
    }


    //Reload ketika image di pilih dari direktori
    function previewImage() {
        document.getElementById("img_thum").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("thumbnail").files[0]);
    
        oFReader.onload = function(oFREvent) {
            document.getElementById("img_thum").src = oFREvent.target.result;
            document.getElementById("btnDelThumbnail").style.display = "inline-block";

        };
       
    };

  
    let tags_id = [];  
    {!! json_encode($post->tags) !!}.forEach(tag => {
        tags_id.push(tag.id);
    });
    $('#tags').val(tags_id).trigger('change');


</script>

@endsection