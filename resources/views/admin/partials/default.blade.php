<!DOCTYPE html>
<html lang="en">

@include('admin.partials.head')


<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

      @include('admin.partials.header')
      @include('admin.partials.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        <div class="row">
          <div class="col-12 ">
            @yield('content')
          </div>

        </div>
      </div>
      @include('admin.partials.footer')
    </div>
  </div>
  @include('admin.partials.scripts')

</body>

<script>

</script>

</html>