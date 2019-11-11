<!DOCTYPE html>
<html lang="en">

<head>
	<title>Hệ thống quản lý hiệp hội</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="sở nội vụ" />
	<base href="{{asset('')}}">
	<script src="public/admin/vendors/jquery/dist/jquery.min.js"></script>
	<script src="public/canvasjs.min.js"></script>
	<script src="public/js/jquery-1.9.1.js"></script>
	<script src="public/js/jquery-ui.js"></script>
	<script src="public/js/bootstrap3-typeahead.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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

	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<style type="text/css">
		@media (min-width: 1200px) {
			.container {
				max-width: 1000px;
			}
		}

		body {
			background: #fff;
		}

		.relative {
			position: relative;
		}

		.absolute {
			position: absolute;
		}

		header .form_search {
			right: 10px;
			bottom: 20px;
		}

		header .form_search form input {
			opacity: .8;
			height: 40px;
			box-shadow: unset;
			border-radius: 30px;
			width: 100%;
		}

		header .form_search form .btn {
			right: 8px;
			top: 38%;
			transform: translateY(-50%);
			margin: 0;
			margin-right: 2px;
			border-radius: 0;
			background-color: transparent !important;
			color: #222 !important;
			font-size: 18px;
			border: 0;
			box-shadow: unset;
		}

		.navbar {
			border-radius: 0;
		}

		.navbar-inverse {
			background-color: #015ab4;
			border: 0;
			min-height: 36px;
		}

		.navbar-header {
			background-color: #015ab4;
		}

		.nav.navbar-nav>li>a {
			color: #fff !important;
		}

		.navbar-brand {
			height: 36px;
			padding: 12px 3px;
			font-size: 15px;
		}

		.navbar-brand,
		.navbar-nav>li>a {
			line-height: 15px;
			text-transform: uppercase;
		}

		ul li {
			list-style-type: none;
		}

		.list-group-item:first-child {
			border-radius: 0 !important;
		}

		.list-group-item:last-child {
			border-radius: 0 !important;
		}

		.list-group-item {
			background-color: #015ab4;
		}

		.list-group-item a {
			color: #fff;
		}

		.list-group.v2 .list-group-item {
			background: #fff;
			border: 0 !important;
			padding: 0;
		}

		.content_main .title {
			border-bottom: 1px solid #eee;
			color: #015ab4;
			margin-bottom: 30px;
		}

		.content_main .title:before {
			content: '';
			width: 50px;
			height: 1px;
			position: absolute;
			bottom: 0;
			left: 0;
			background: #000;
		}

		.title_v2 {
			color: #100404;
			font-weight: bold;
			margin-bottom: 30px;
		}

		.content_main .content_child .title_child {
			font-size: 14px;
			color: #000;
			font-weight: 600;
			margin-bottom: 20px;
			line-height: 20px;
		}

		.content_main .content_child h4 {
			color: #000;
			font-weight: bold;
			font-size: 14px;
		}

		.content_main .content_child .item {
			margin-bottom: 30px;

		}

		.content_main .content_child .item .item-child {
			border: 1px solid #eee;
			padding: 20px;
			height: 450px;
			border-radius: 5px;
			box-shadow: 5px 10px 6px 5px #888888;
		}

		.content_main .content_child .item .item-child:hover {
			transform: scale(0.9);
			box-shadow: 5px 10px 6px 5px #bac7eb;
			cursor: pointer;
		}

		strong {
			color: #000 !important;
		}

		p {
			line-height: 22px;
			color: #868686;
		}

		footer {
			padding: 20px;
			background: #015ab4;
			display: flex;
			color: #fff;
			margin: 0;
		}

		footer img {
			margin-right: 20px;
			object-fit: contain;
		}

		@media all and (min-width: 320px) {

			.col-md-1:nth-child(12n+1),
			.col-md-2:nth-child(6n+1),
			.col-md-3:nth-child(4n+1),
			.col-md-4:nth-child(3n+1),
			.col-md-6:nth-child(2n+1),
			.col-lg-1:nth-child(12n+1),
			.col-lg-2:nth-child(6n+1),
			.col-lg-3:nth-child(4n+1),
			.col-lg-4:nth-child(3n+1),
			.col-lg-6:nth-child(2n+1),
			.col-sm-1:nth-child(12n+1),
			.col-sm-2:nth-child(6n+1),
			.col-sm-3:nth-child(4n+1),
			.col-sm-4:nth-child(3n+1),
			.col-sm-6:nth-child(2n+1) {
				clear: none;
			}

			.col-xs-1:nth-child(12n+1),
			.col-xs-2:nth-child(6n+1),
			.col-xs-3:nth-child(4n+1),
			.col-xs-4:nth-child(3n+1),
			.col-xs-6:nth-child(2n+1) {
				clear: left;
			}
		}

		@media all and (min-width: 768px) {

			.col-md-1:nth-child(12n+1),
			.col-md-2:nth-child(6n+1),
			.col-md-3:nth-child(4n+1),
			.col-md-4:nth-child(3n+1),
			.col-md-6:nth-child(2n+1),
			.col-lg-1:nth-child(12n+1),
			.col-lg-2:nth-child(6n+1),
			.col-lg-3:nth-child(4n+1),
			.col-lg-4:nth-child(3n+1),
			.col-lg-6:nth-child(2n+1),
			.col-xs-1:nth-child(12n+1),
			.col-xs-2:nth-child(6n+1),
			.col-xs-3:nth-child(4n+1),
			.col-xs-4:nth-child(3n+1),
			.col-xs-6:nth-child(2n+1) {
				clear: none;
			}

			.col-sm-1:nth-child(12n+1),
			.col-sm-2:nth-child(6n+1),
			.col-sm-3:nth-child(4n+1),
			.col-sm-4:nth-child(3n+1),
			.col-sm-6:nth-child(2n+1) {
				clear: left;
			}
		}

		@media all and (min-width: 992px) {

			.col-sm-1:nth-child(12n+1),
			.col-sm-2:nth-child(6n+1),
			.col-sm-3:nth-child(4n+1),
			.col-sm-4:nth-child(3n+1),
			.col-sm-6:nth-child(2n+1),
			.col-lg-1:nth-child(12n+1),
			.col-lg-2:nth-child(6n+1),
			.col-lg-3:nth-child(4n+1),
			.col-lg-4:nth-child(3n+1),
			.col-lg-6:nth-child(2n+1),
			.col-xs-1:nth-child(12n+1),
			.col-xs-2:nth-child(6n+1),
			.col-xs-3:nth-child(4n+1),
			.col-xs-4:nth-child(3n+1),
			.col-xs-6:nth-child(2n+1) {
				clear: none;
			}

			.col-md-1:nth-child(12n+1),
			.col-md-2:nth-child(6n+1),
			.col-md-3:nth-child(4n+1),
			.col-md-4:nth-child(3n+1),
			.col-md-6:nth-child(2n+1) {
				clear: left;
			}
		}

		@media (min-width: 1200px) {

			.col-md-1:nth-child(12n+1),
			.col-md-2:nth-child(6n+1),
			.col-md-3:nth-child(4n+1),
			.col-md-4:nth-child(3n+1),
			.col-md-6:nth-child(2n+1),
			.col-sm-1:nth-child(12n+1),
			.col-sm-2:nth-child(6n+1),
			.col-sm-3:nth-child(4n+1),
			.col-sm-4:nth-child(3n+1),
			.col-sm-6:nth-child(2n+1),
			.col-xs-1:nth-child(12n+1),
			.col-xs-2:nth-child(6n+1),
			.col-xs-3:nth-child(4n+1),
			.col-xs-4:nth-child(3n+1),
			.col-xs-6:nth-child(2n+1) {
				clear: none;
			}
	</style>
</head>
<script>
	function checkValidate() {
		//Tiến hành lấy dữ liệu trên Form
		var data_search = document.getElementById("data_search").value;
		var status = false; //Biến trạng thái

		if (data_search == "") {
			document.getElementById("data_search").style.borderColor = "red";
			document.getElementById("data_search").style.display = "block";
			document.getElementById("lbdata_search").innerHTML = "Hãy nhập từ khóa tìm kiếm";
			status = true;
		} else {

			document.getElementById("data_search").style.borderColor = "#D8D8D8";
			document.getElementById("lbdata_search").style.display = "none";

		}

		if (status == true) {
			return false;
		} else {
			return true;
		}


	}
</script>
<script type="text/javascript">
	$(document).ready(function() {

		$('#data_search').keyup(function() {
			var data = $('#data_search').val();
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: "{{route('AjaxSearch')}}",
				data: {
					data: data,
					_token: _token
				},
				type: "post",
				success: function(data) {

					$("#data_search").autocomplete({
						source: data
					});
				},
				error: function(errs) {
					console.log(errs);
				}
			});
		});
	});
</script>

<body class="container">
	<header>
		<div class="relative text-center" style="padding: 30px;margin-bottom: 30px;">
			<a href="{{route('userview')}}" style="font-size: 36px;font-weight: 600;color: #222;">
				HỆ THỐNG QUẢN LÝ HIỆP HỘI
			</a>
			@if(Session::has('username'))
			<a href="{{route('logout')}}" style="position: absolute;right: 0;top: 20px;font-size: 16px;"><span class="glyphicon glyphicon-user"></span><b>{{Session::get('username')}}</b> | Đăng xuất</a>
			@else
			<a href="{{route('loginn')}}" style="position: absolute;right: 0;top: 20px;font-size: 16px;"><span class="glyphicon glyphicon-user"></span> Đăng nhập</a>
			@endif
		</div>
		<div class="form_search">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<form class="relative" style="" method="get" action="#" onsubmit="return checkValidate();">
				<div class="form-group">
					<input type="text" name="param" class="form-control" placeholder="Nhập tên hội để tìm kiếm..." id="data_search">
					<div style="color: red;" id="lbdata_search"></div>
				</div>
				<button type="submit" name="search" class="btn btn-primary absolute"><i class="fa fa-search"></i></button>
			</form>
		</div>

	</header>
	<main>
		@yield('content')
	</main>
	<footer>
		<img src="public/images/logo-mic.png" class="img-responsive" alt="">
		<div>
			<div>CƠ QUAN CHỦ QUẢN: SỞ NỘI VỤ THÀNH PHỐ HÀ NỘI</div>
			<div>Copyright 2019 © HTN SOFTWARE</div>
		</div>
	</footer>
</body>

</html>