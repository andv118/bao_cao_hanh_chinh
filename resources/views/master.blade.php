<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="public/admin/sourcepublicpublic/admin/source/images//favicon.ico" type="image/ico" />
  <!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"> -->

  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

  <title>Hệ thống báo cáo cải cách</title>
  <base href="{{asset('')}}">
  <script src="public/admin/vendors/jquery/dist/jquery.min.js"></script>
  <script src="public/canvasjs.min.js"></script>
  <script src="public/js/jquery-1.9.1.js"></script>
  <script src="public/js/jquery-ui.js"></script>
  <script src="public/js/bootstrap3-typeahead.min.js"></script>

  <!-- Bootstrap -->
  <link href="public/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="public/admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="public/admin/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="public/admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="public/admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="public/admin/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="public/admin/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="public/admin/build/css/custom.min.css" rel="stylesheet">
  <link href="public/admin/build/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      @include('header')

      @include('slidebar')

      <!-- page content -->
      <div class="right_col">
        <!-- top tiles -->
        @yield('content')
      </div>
      <!-- /page content -->

      @include('footer')

    </div>
  </div>

  <!-- jQuery -->

  <!-- Bootstrap -->
  <script src="public/admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="public/admin/vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="public/admin/vendors/nprogress/nprogress.js"></script>
  <!-- Chart.js -->
  <script src="public/admin/vendors/Chart.js/dist/Chart.min.js"></script>
  <!-- gauge.js -->
  <script src="public/admin/vendors/gauge.js/dist/gauge.min.js"></script>
  <!-- bootstrap-progressbar -->
  <script src="public/admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  <!-- iCheck -->
  <script src="public/admin/vendors/iCheck/icheck.min.js"></script>
  <!-- Skycons -->
  <script src="public/admin/vendors/skycons/skycons.js"></script>
  <!-- Flot -->
  <script src="public/admin/vendors/Flot/jquery.flot.js"></script>
  <script src="public/admin/vendors/Flot/jquery.flot.pie.js"></script>
  <script src="public/admin/vendors/Flot/jquery.flot.time.js"></script>
  <script src="public/admin/vendors/Flot/jquery.flot.stack.js"></script>
  <script src="public/admin/vendors/Flot/jquery.flot.resize.js"></script>
  <!-- Flot plugins -->
  <script src="public/admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
  <script src="public/admin/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
  <script src="public/admin/vendors/flot.curvedlines/curvedLines.js"></script>
  <!-- DateJS -->
  <script src="public/admin/vendors/DateJS/build/date.js"></script>
  <!-- JQVMap -->
  <script src="public/admin/vendors/jqvmap/dist/jquery.vmap.js"></script>
  <script src="public/admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="public/admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="public/admin/vendors/moment/min/moment.min.js"></script>
  <script src="public/admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="public/admin/build/js/custom.min.js"></script>
  <script src="public/admin/build/js/admin.js"></script>
  <script src="public/ckeditor/ckeditor.js"></script>
</body>

</html>