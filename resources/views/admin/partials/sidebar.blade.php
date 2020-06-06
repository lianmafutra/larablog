<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="#">Blog APP</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class=" nav-item dropdown">
      <li class="{{set_active('admin.home')}}">
        <a href="/" class="nav-link"><i class=" fas
          fa-home"></i><span>Dashboard</span></a>
      </li>
      </li>
      <li class="menu-header">Menu</li>
      <li class="{{set_active('post.index')}}">
        <a class="nav-link active" href="{{ route('post.index') }}"><i
            class="far fa-sticky-note"></i><span>Posts</span></a>
      </li>
      <li class="{{set_active('category.index')}}"><a class="nav-link" href="{{ route('category.index') }}"><i
            class="fas fa-th-list"></i><span>Category</span></a>
      </li>

      <li class="{{ set_active('tag.index') }}"><a class="nav-link" href="{{ route('tag.index') }}"><i
            class="fas fa-tags"></i><span>Tag</span></a>
      </li>

      <li class="nav-item dropdown {{set_active('user.index')}}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-friends"></i> <span>Users</span></a>
        <ul class="dropdown-menu">
          <li><a class=" nav-link" href="{{ route('user.index') }}">List
              Users</a>
          </li>
        </ul>
      </li>
      <li><a class="nav-link" href="{{ route('category.index') }}"><i class="fas fa-cog"></i><span>Settings</span></a>
      </li>
    </ul>
  </aside>
</div>