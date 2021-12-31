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
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>User</p>
            <i class="right fa fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">

            {{-- list user --}}
            <li class="nav-item">
              <a href="{{ route('user.index') }}" class="nav-link">
                <i class="nav-icon fa fa-circle-o"></i>
                <p>List</p>
              </a>
            </li>

            {{-- level user --}}
            <li class="nav-item">
              <a href="{{ route('level.index') }}" class="nav-link">
                <i class="nav-icon fa fa-circle-o"></i>
                <p>Level</p>
              </a>
            </li>
          </ul>
        </li>

        {{-- daftar menu Button --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-birthday-cake"></i>
            <p>Daftar Menu</p>
            <i class="right fa fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">

            {{-- list daftar menu --}}
            <li class="nav-item">
              <a href="{{ route('food-menu.index') }}" class="nav-link">
                <i class="nav-icon fa fa-circle-o"></i>
                <p>List</p>
              </a>
            </li>

            {{-- list kategori --}}
            <li class="nav-item">
              <a href="{{ route('food-category.index') }}" class="nav-link">
                <i class="nav-icon fa fa-circle-o"></i>
                <p>Kategori</p>
              </a>
            </li>

            {{-- list Size --}}
            <li class="nav-item">
              <a href="{{ route('food-size.index') }}" class="nav-link">
                <i class="nav-icon fa fa-circle-o"></i>
                <p>Size</p>
              </a>
            </li>

            {{-- list type --}}
            <li class="nav-item">
              <a href="{{ route('food-type.index') }}" class="nav-link">
                <i class="nav-icon fa fa-circle-o"></i>
                <p>Type</p>
              </a>
            </li>
          </ul>
        </li>


        {{-- daftar menu Button --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-shopping-cart"></i>
            <p>Pesanan</p>
            <i class="right fa fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">

            {{-- list daftar menu --}}
            <li class="nav-item">
              <a href="{{ route('admin.order.index') }}" class="nav-link">
                <i class="nav-icon fa fa-circle-o"></i>
                <p>List Semua</p>
              </a>
            </li>

            {{-- list berhasil --}}
            <li class="nav-item">
              <a href="{{ route('admin.order.index-berhasil') }}" class="nav-link">
                <i class="nav-icon fa fa-circle-o"></i>
                <p>List Berhasil</p>
              </a>
            </li>

            {{-- list batalkan --}}
            <li class="nav-item">
              <a href="{{ route('admin.order.index-batalkan') }}" class="nav-link">
                <i class="nav-icon fa fa-circle-o"></i>
                <p>List Batalkan</p>
              </a>
            </li>

            {{--Lama Process --}}
            <li class="nav-item">
              <a href="{{ route('order-process-time.index') }}" class="nav-link">
                <i class="nav-icon fa fa-circle-o"></i>
                <p>Lama Proses</p>
              </a>
            </li>

            {{-- Order Kurir --}}
            <li class="nav-item">
              <a href="{{ route('order-delivery.index') }}" class="nav-link">
                <i class="nav-icon fa fa-circle-o"></i>
                <p>Kurir</p>
              </a>
            </li>

            {{-- Order Kurir --}}
            <li class="nav-item">
              <a href="{{ route('order-status.index') }}" class="nav-link">
                <i class="nav-icon fa fa-circle-o"></i>
                <p>Status Pemesanan</p>
              </a>
            </li>
            
          </ul>
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