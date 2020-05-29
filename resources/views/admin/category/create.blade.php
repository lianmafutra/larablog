@extends('admin.partials.default')
@section('content')
  <section class="section">
    <div class="section-header" >
      <h1>Tambah Data Category</h1>
    </div>
    <div class="section-body card"> 
      <div class="card-body">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session('success') }}
                </div>
            @endif
          <form action="{{ route('category.store') }}" method="POST">
              @csrf


                @textinput(['label' => 'Input Category Name' ,'name' => 'name'])
          
                <div class="form-group">
                    <a class="btn btn-success" href="{{ route('category.index') }}" role="button"></i> Back</a>
                    <x-button type="primary" title="Tambah Data"/>
                </div>
            </div>
          </form>
    </div>
  </section>
@endsection