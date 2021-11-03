<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        {{-- dashboard button --}}
        <li class="nav-item">
          <a href="{{ route('admin.home') }}" class="nav-link">
            <i class="nav-icon fa fa-tachometer"></i>
            <p>Dashboard</p>
          </a>
        </li>

        {{-- user button --}}
        <li class="nav-item">
          <a href="{{ route('user.index') }}" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>User</p>
          </a>
        </li>

        {{-- logout button --}}
        <li class="nav-item">
          <a 
          href="{{ route('logout') }}" 
          class="nav-link primary text-danger font-weight-bold"  
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-icon fa fa-sign-out"></i>
            <p>Logout</p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
</div>