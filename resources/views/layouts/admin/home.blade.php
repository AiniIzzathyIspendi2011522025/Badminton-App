<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('templatesAdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('templatesAdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('templatesAdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('templatesAdminLTE/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('templatesAdminLTE/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('templatesAdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('templatesAdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('templatesAdminLTE/plugins/summernote/summernote-bs4.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('templatesAdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{asset('templatesAdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{asset('templatesAdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
   <!-- SweetAlert2 -->
   <link rel="stylesheet" href="{{ asset('templates/css/sweetalert.css') }}">
   <!-- <link rel="stylesheet" href="{{asset('templatesAdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> -->
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('templatesAdminLTE/plugins/toastr/toastr.min.css') }}">

  @yield('css')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('templates/img/football.png') }}" alt="Futsal" height="60" width="60">
  </div> --}} -->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    @include('layouts.admin.navbar.navbar-left')

    <!-- Right navbar links -->
    @include('layouts.admin.navbar.navbar-right')
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    @include('layouts.admin.sidebar.sidebar-menu')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- AdminLTE App -->
<script src="{{asset('templatesAdminLTE/js/adminlte.min.js') }}"></script>

<!-- jQuery -->
<script src="{{asset('templatesAdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('templatesAdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('templatesAdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{asset('templatesAdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{asset('templatesAdminLTE/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{asset('templatesAdminLTE/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{asset('templatesAdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('templatesAdminLTE/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{asset('templatesAdminLTE/plugins/moment/moment.min.js') }}"></script>
<script src="{{asset('templatesAdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('templatesAdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{asset('templatesAdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('templatesAdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('templatesAdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('templatesAdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{asset('templatesAdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{asset('templatesAdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{asset('templatesAdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{asset('templatesAdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{asset('templatesAdminLTE/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{asset('templatesAdminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{asset('templatesAdminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{asset('templatesAdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{asset('templatesAdminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{asset('templatesAdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{asset('templatesAdminLTE/js/adminlte.js') }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('templatesAdminLTE/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('templates/js/page/bootstrap-modal.js') }}"></script>

<script src="{{ asset('templates/js/sweetalert.min.js') }}"></script>

<!-- SweetAlert2 -->
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<!-- Toastr -->
<script src="{{asset('templatesAdminLTE/plugins/toastr/toastr.min.js') }}"></script>
<script>
    @if(Session::has('success'))
      toastr.success("{{ session('success') }}")
    @endif
    @if(Session::has('info'))
    toastr.info("{{ session('info') }}")
    @endif
    @if(Session::has('error'))
    toastr.error("{{ session('error') }}")
    @endif
    @if(Session::has('warning'))
    toastr.warning("{{ session('warning') }}")
    @endif

      function logout() {
            event.preventDefault();
            $("#logout-form").submit();
      }

</script>
@yield ('script')

</body>
</html>
