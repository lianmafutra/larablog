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
        @yield('content')

      </div>
      @include('admin.partials.footer')
    </div>
  </div>
  @include('admin.partials.scripts')
</body>

</html>