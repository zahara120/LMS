<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- validation modal -->
  <meta name="_token" content="{{csrf_token()}}" />
  
  <title>Training | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('style/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('style/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('style/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('style/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('style/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('style/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('style/plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('style/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('style/dist/css/skins/_all-skins.min.css')}}">
  <!-- filePond progress bar -->
  <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script> -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="sidebar-mini skin-purple" style="height: auto; min-height: 100%;">
{{-- <body class="hold-transition skin-blue sidebar-mini"> --}}
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>G</b>T</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Training </b>GT</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('style/dist/img/default-user.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('style/dist/img/default-user.jpg')}}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->name }} - Web Developer
                  {{-- <small>Member since Nov. 2012</small> --}}
                </p>
              </li>
              <!-- Menu Body -->
              {{-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li> --}}
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    <button type="submit" class="btn btn-default btn-flat">Log out</a>
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
    @include('layout.navbar')

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
    <!-- Content Header (Page header) -->
    <h1>@yield('title')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  {{-- <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.13
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
    reserved.
  </footer> --}}

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
<!-- filePond progress bar -->
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<!-- jQuery 3 -->
<script src="{{asset('style/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('style/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>pt>
@yield('scripts') 
<!-- DataTables -->
<script src="{{asset('style/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('style/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('style/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('style/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('style/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset('style/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('style/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('style/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('style/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('style/dist/js/demo.js')}}"></script>
<script>
  $('#table').DataTable();
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
  //Timepicker
  $('.timepicker').timepicker({
      showInputs: false
    })
  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
</script>
</body>
</html>