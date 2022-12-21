<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Hệ thống quản lí</title>
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
  <!-- thongbao -->
  <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
  <link src="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">

  <style>
    .div-table .table-custom {
      border: 1px solid black;
      border-collapse: separate;
      border-spacing: 0px;
      min-width: max-content;
    }

    .div-table .table-custom thead tr th {
      position: sticky;
      top: 0px;
      background-color: #6c757d;
      color: white;
    }

    .div-table .table-custom th,
    td {
      border: 1px solid black;
      padding: 10px;
    }


    div.dataTables_wrapper {
      margin: 0 auto;
    }
  </style>
  @yield('style-detection')

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
          <a href="{{ asset('/admin') }}" class="nav-link">Trang chủ</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('/logout') }}">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <center>
        <a href="#" class="brand-link">
          <span class="brand-text font-weight-light-bold">Trường CNTT&TT</span>
        </a>
      </center>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">
              <center>
                <?php
              $name = Session::get('name');
              if($name){
                  echo $name;
              }
              ?>
            </a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php
              $cv = Session::get('cv');
              if($cv == '0'){?>
            <li class="nav-item">
              <a href="{{ asset('/admin/bomon') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Quản lý bộ môn
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/giangvien" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Quản lý giảng viên
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/hocki" class="nav-link">
                <i class="nav-icon fas fa-business-time"></i>
                <p>
                  Quản lý học kì
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/nienkhoa" class="nav-link">
                <i class="nav-icon fas fa-clock"></i>
                <p>
                  Quản lý niên khóa
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/hocphan" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                  Quản lý học phần
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/lophocphan" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Quản lý lớp học phần
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/phong" class="nav-link">
                <i class="nav-icon fas fa-city"></i>
                <p>
                  Quản lý phòng
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/kehoach" class="nav-link">
                <i class="nav-icon fas fa-folder"></i>
                <p>
                  Quản lý kế hoạch
                </p>
              </a>
            </li>

            {{-- <li class="nav-item">
              <a href="/admin/tiethoc" class="nav-link">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                  Quản lý tiết học
                </p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href="/admin/lichthi" class="nav-link">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                  Quản lý lịch thi
                </p>
              </a>
            </li>

            <?php }else{
              ?>
            <li class="nav-item">
              <a href="/admin/dangkithi" class="nav-link">
                <i class="nav-icon fas fa-city"></i>
                <p>
                  Xem lớp học phần
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/video" class="nav-link">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                  Xem lịch thi
                </p>
              </a>
            </li>
            <?php 
            }
            ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    @yield('maincontent')
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
      </div>
      <strong>Copyright &copy; 2022 <a href="#">Phu Nguyen</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('http://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
  <!-- jQuery timepicker library -->
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

  {{-- Autocomplete --}}

  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js')}}"></script>

  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  {{-- <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script> --}}
  <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
  <!-- Filterizr-->
  <script src="{{ asset('plugins/filterizr/jquery.filterizr.min.js') }}"></script>
  {!! Toastr::message() !!}
  <!-- Select2 -->
  <script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
  @yield('script-cv')
  @yield('script-video')
  @yield('js-lichthi')
  @yield('script-detection')
  <script>
    $(document).ready(function () {
    $("#example1").DataTable({
    "responsive": false, "lengthChange": false, "autoWidth": false, 'sorting':false,
    // "buttons": ["excel"],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    $(document).ready(function () {
    $("#example2").DataTable({
    "responsive": false, "lengthChange": false, "autoWidth": false, 'sorting':false,
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
    
    $(document).ready(function () {
    $("#example").DataTable({
    "responsive": false, "lengthChange": false, "autoWidth": false,
    // "buttons": ["excel"],
    scrollX: true,
    }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    });
  var checkboxes = document.querySelectorAll("input[type='checkbox']");
          function checkAll(myCheckbox){
          if(myCheckbox.checked == true){
          checkboxes.forEach (function(checkbox){
          checkbox.checked = true;
          })
          }else{
          checkboxes.forEach(function(checkbox){
          checkbox.checked = false;
          })
          }
          }
    $(document).ready(function() {
    $('.select-sv').select2();
    });
     
  </script>

</body>

</html>