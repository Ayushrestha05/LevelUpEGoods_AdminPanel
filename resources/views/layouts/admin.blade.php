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
        <a href="index3.html" class="nav-link">Dashboard</a>
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
      <img src="data:image/jpeg;base64,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" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
