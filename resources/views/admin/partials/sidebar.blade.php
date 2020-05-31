<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="#">Blog APP</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header active ">Dashboard</li>
      <li class="nav-item dropdown">
        <a href="/" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li>
      <li class="menu-header">Menu</li>
      <li><a class="nav-link" href="{{ route('post.index') }}"><i class="far fa-square"></i><span>Posts</span></a>
      </li>
      <li><a class="nav-link" href="{{ route('category.index') }}"><i
            class="far fa-square"></i><span>Category</span></a>
      </li>
    </ul>
  </aside>
</div>