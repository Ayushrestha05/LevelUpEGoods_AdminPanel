<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LevelUp EGoods Admin Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Outfit -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@700&display=swap" rel="stylesheet">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.admin-home') }}" class="nav-link">Dashboard</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          Admin
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              Home
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
            <!-- Message Start -->
            <div class="media">
              {{ __('Logout') }}
            </div>
            <!-- Message End -->
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('logo/logo.png') }}" alt="LevelUpEGoods Logo" class="brand-image " style="opacity: .8">
      <span class="brand-text font-weight-light">LevelUp EGoods</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.admin-home') }}" class="{{ request()->is('admin/home') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-align-justify"></i>
              <p>
                Dashboard
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->is('admin/categories*') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item {{ request()->is('admin/items*') ? 'menu-open' : 'menu-close' }}">
            <a href="#" class="{{ request()->is('admin/items*') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Items
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.figurine.index') }}" class="{{ request()->is('admin/items/figurine*') ? 'nav-link active' : 'nav-link' }}">
                  <i class="nav-icon fab fa-jenkins"></i>
                  <p>Figurines</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.games.index') }}" class="{{ request()->is('admin/items/games*') ? 'nav-link active' : 'nav-link' }}">
                  <i class="nav-icon fas fa-gamepad"></i>
                  <p>Games</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.gift-card.index') }}" class="{{ request()->is('admin/items/gift-card*') ? 'nav-link active' : 'nav-link' }}">
                  <i class="nav-icon fas fa-gift"></i>
                  <p>Gift Cards</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.illustrations.index') }}" class="{{ request()->is('admin/items/illustrations*') ? 'nav-link active' : 'nav-link' }}">
                  <i class="nav-icon fas fa-image"></i>
                  <p>Illustrations</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.music.index') }}" class="{{ request()->is('admin/items/music*') ? 'nav-link active' : 'nav-link' }}">
                  <i class="nav-icon fas fa-music"></i>
                  <p>Music</p>
                </a>
              </li>
            </ul>            
          </li>
          <li class="nav-item {{ request()->is('admin/report*') ? 'menu-open' : 'menu-close' }}">
            <a href="#" class="{{ request()->is('admin/report*') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-question"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.user-reports.index') }}" class="{{ request()->is('admin/report/user-reports*') ? 'nav-link active' : 'nav-link' }}">
                  <i class="nav-icon fas fa-question"></i>
                  <p>User Reports</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.report-question.index') }}" class="{{ request()->is('admin/report/report-question*') ? 'nav-link active' : 'nav-link' }}">
                  <i class="nav-icon fas fa-question"></i>
                  <p>
                    Report Questions
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.platforms.index') }}" class="{{ request()->is('admin/platforms') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-gamepad"></i>
              <p>
                Platforms
              </p>
            </a>
          </li>   
          
          <li class="nav-item {{ request()->is('admin/orders*') ? 'menu-open' : 'menu-close' }}">
            <a href="#" class="{{ request()->is('admin/orders*') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.pending.index') }}" class="{{ request()->is('admin/orders/pending*') ? 'nav-link active' : 'nav-link' }}">
                  <i class="nav-icon fas fa-shopping-bag"></i>
                  <p>Pending Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.completed.index') }}" class="{{ request()->is('admin/orders/completed*') ? 'nav-link active' : 'nav-link' }}">
                  <i class="nav-icon fas fa-shopping-bag"></i>
                  <p>
                    Completed Orders
                  </p>
                </a>
              </li>
            </ul>
          </li> 
          <li class="nav-item {{ request()->is('admin/reward*') ? 'menu-open' : 'menu-close' }}">
            <a href="#" class="{{ request()->is('admin/reward*') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-gift"></i>
              <p>
                Rewards
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.reward-items.index') }}" class="{{ request()->is('admin/reward-items') ? 'nav-link active' : 'nav-link' }}">
                  <i class="nav-icon fas fa-gift"></i>
                  <p>Reward Items</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.reward-history.index') }}" class="{{ request()->is('admin/reward-history') ? 'nav-link active' : 'nav-link' }}">
                  <i class="nav-icon fas fa-gift"></i>
                  <p>
                    Reward History
                  </p>
                </a>
              </li>               
            </ul>            
          </li>  
          <li class="nav-item">
            <a href="{{ route('admin.notifications.index') }}" class="{{ request()->is('admin/notifications') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Notifications
              </p>
            </a>
          </li> 
          <li class="nav-item {{ request()->is('admin/sale*') ? 'menu-open' : 'menu-close' }}">
            <a href="#" class="{{ request()->is('admin/sale*') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-percent"></i>
              <p>
                Sales
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.checkout.index') }}" class="{{ request()->is('admin/sale/checkout*') ? 'nav-link active' : 'nav-link' }}">
                  <i class="nav-icon fas fa-percent"></i>
                  <p>Checkout Sale</p>
                </a>
              </li>
                            
            </ul>            
          </li> 
          <li class="nav-item">
            <a href="{{ route('admin.artist.index') }}" class="{{ request()->is('admin/artist') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-paint-brush"></i>
              <p>
                Artist
              </p>
            </a>
          </li>           
          <li class="nav-item">
            <a href="{{ route('admin.ads.index') }}" class="{{ request()->is('admin/ads') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fab fa-buysellads"></i>
              <p>
                Ads
              </p>
            </a>
          </li> 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      BrainOutOfBounds
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021-Present <a href="https://github.com/Ayushrestha05">Ayush Shrestha</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- Hidden Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
  @csrf
</form>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>
</body>
</html>
