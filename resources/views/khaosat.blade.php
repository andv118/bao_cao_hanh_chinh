<!DOCTYPE html>
<html lang="en">
<head>
	<title>Hệ thống quản lý hiệp hội</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="sở nội vụ" />

	<script src="public/admin/vendors/jquery/dist/jquery.min.js"></script>
    <script src="public/canvasjs.min.js"></script>
    <script src="public/js/jquery-1.9.1.js"></script>
    <script src="public/js/jquery-ui.js"></script>
    <script src="public/js/bootstrap3-typeahead.min.js"></script>  
    <!-- Latest compiled JavaScript -->
	


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
    <link href="public/admin/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="public/admin/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="public/admin/build/css/custom.min.css" rel="stylesheet">
    <link href="public/admin/build/css/style.css" rel="stylesheet">
   <meta name="csrf-token" content="{{ csrf_token() }}" />
	<style type="text/css">
		@media (min-width: 1200px) {
			.container{
				max-width: 1000px;
			}
		}
		body{
			background: #fff;
		}
		.relative{
			position: relative;
		}
		.absolute{
			position: absolute;
		}
		header .form_search{
			right: 10px;
    		bottom: 20px;
		}
		
		header .form_search form input{
			opacity: .8;
			height: 30px;
		}
		header .form_search form .btn{
			right: 0;
			top: 50%;
			transform: translateY(-50%);
			margin: 0;
    		padding: 2px 5px;
    		margin-right: 2px;
    		border-radius: 0;
		}
		.navbar{
			border-radius: 0;
		}
		.navbar-inverse{
			background-color: #015ab4;
			border: 0;
			min-height: 36px;
		}
		.navbar-header{
			background-color: #015ab4;
		}
		.nav.navbar-nav>li>a{
			color: #fff !important;
		}
		.navbar-brand{
			height: 36px;
    		padding: 12px 3px;
    		font-size: 15px;
		}
		.navbar-brand, .navbar-nav>li>a{
			line-height: 15px;
			text-transform: uppercase;
		}
		ul li{
			list-style-type: none;
		}
		.list-group-item:first-child{
			border-radius: 0 !important;
		}
		.list-group-item:last-child{
			border-radius: 0 !important;
		}
		.list-group-item{
			background-color: #015ab4;
		}
		.list-group-item a{
			color: #fff;
		}
		.list-group.v2 .list-group-item{
			background: #fff;
			border: 0 !important;
			padding: 0;
		}
		.content_main .title{
			border-bottom: 1px solid #eee;
			color: #015ab4;
			margin-bottom: 30px;
		}
		.content_main .title:before{
			content: '';
			width: 50px;
			height: 1px;
			position: absolute;
			bottom: 0;
			left: 0;
			background: #000;
		}
		.title_v2{
			color: #100404;
			font-weight: bold;
			margin-bottom: 30px;
		}
		.content_main .content_child .title_child{
			font-size: 14px;
			color: #000;
			font-weight: 600;
			margin-bottom: 20px;
			line-height: 20px;
		}
		.content_main .content_child h4{
			color: #000;
			font-weight: bold;
			font-size: 14px;
		}
		.content_main .content_child .item{
			margin-bottom: 30px;
			border: 1px solid #eee;
			padding: 20px;
		}
		p{
			line-height: 22px;
			color: #868686;
		}
		footer{
			padding: 20px;
			background: #015ab4;
			display: flex;
			color: #fff;
			margin: 0;
		}
		footer img{
			margin-right: 20px;
    		object-fit: contain;
		}
	</style>
</head>
<body class="container">
	<header>
		<div class="relative text-center" style="padding: 30px;margin-bottom: 30px;">
			<a href="#" style="font-size: 36px;font-weight: 600;color: #222;">
				HỆ THỐNG QUẢN LÝ HIỆP HỘI
			</a>
			@if(Session::has('username'))
			<a href="{{route('logout')}}" style="position: absolute;right: 0;top: 20px;font-size: 16px;"><span class="glyphicon glyphicon-user"></span><b>{{Session::get('username')}}</b> | Đăng xuất</a>
			@else
			<a href="{{route('loginn')}}" style="position: absolute;right: 0;top: 20px;font-size: 16px;"><span class="glyphicon glyphicon-user"></span> Đăng nhập</a>
			@endif
			<!-- <div class="form_search absolute">
				<form class="relative">
					<input type="text" name="s">
					<button type="submit" class="btn btn-primary absolute"><i class="fa fa-search"></i></button>
				</form>
			</div> -->
		</div>
		<div class="form_search">
			<form class="relative" style="">
		      <div class="form-group">
		        <input type="text" class="form-control">
		      </div>
		      <button type="submit" class="btn btn-primary absolute"><i class="fa fa-search"></i></button>
		    </form>
		</div>
		
		
	</header>
	<main>
		<div class="row">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content_main">
				<h3 class="title relative">PHIẾU KHẢO SÁT NĂNG LỰC HỘI NÔNG DÂN VIỆT NAM</h3>
				<h3 class="title_v2">Các tổ chức hội, hiệp hội ngành Thông tin và Truyền thông</h3>
				 <form method="post">
                    <div class="form-group">
                        <label for="email">Tên phiếu:</label>
                        <input type="text" value="Đánh giá hội" placeholder="Nhập tên phiếu" class="form-control"  style="width: 400px;">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mã phiếu:</label>
                        <input type="text" value="PH001" placeholder="Nhập mã phiếu" class="form-control" style="width: 400px;">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Tiêu chuẩn:</label>
                        <input type="text" value="Năng lực hội" placeholder="Nhập mã tiêu chuẩn" class="form-control" style="width: 400px;">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Tiêu chí:</label>
                        <input type="text" value="Đánh giá năng lực hội" placeholder="Nhập tiêu chí" class="form-control" style="width: 400px;">
                    </div>
                    <p><b>1. Mô tả hiện trạng (Mô tả theo từng mức đánh giá đối với từng chỉ báo):</b></p>
                    <div class="form-group">
                        <label for="pwd">1.1.Mức 1:</label><br>
                       <b> a)</b><input type="text" class="form-control" style="width: 400px;"> 
                       <b> b)</b><input type="text" class="form-control" style="width: 400px;"> 
                       <b> c)</b><input type="text" class="form-control" style="width: 400px;">
                    </div>
                     <div class="form-group">
                        <label for="pwd">1.2.Mức 2 (Nếu có):</label><br>
                        <input type="text" class="form-control" style="width: 400px;"> 
                    </div> 
                    <div class="form-group">
                        <label for="pwd">1.3.Mức 3 (Nếu có):</label><br>
                        <input type="text" class="form-control" style="width: 400px;"> 
                    </div>
                     <div class="form-group">
                        <label for="pwd">2.Điểm mạnh:</label><br>
                         <textarea style="width: 400px;"></textarea>
                    </div>
                     <div class="form-group">
                        <label for="pwd">3.Điểm yếu:</label><br>
                        <textarea style="width: 400px;"></textarea> 
                    </div>
                    <div class="form-group">
                        <label for="pwd">4.Kế hoạch phát triển hội:</label><br>
                       <textarea style="width: 600px;"></textarea>
                    </div>
                    <p><b>5.Tự đánh giá</b></p>
                    <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action">
                        <thead >
                            <tr>
                                <th  colspan="2"  style="text-align: center;">Mức 1</th>
                                <th  colspan="2"   style="text-align: center;">Mức 2</th>
                                <th  colspan="2"   style="text-align: center;">Mức 3</th>
                            </tr>
                            <tr>
                                <th  style="text-align: center;">Chỉ báo</th>
                                <th  style="text-align: center;">Đạt/ Không đạt</th> 
                                <th  style="text-align: center;">Chỉ báo</th>
                                <th  style="text-align: center;">Đạt/ Không đạt (Nếu có)</th>
                                <th  style="text-align: center;">Chỉ báo</th>
                                <th  style="text-align: center;">Đạt/ Không đạt (Nếu có)</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;">Đạt/ Không đạt</td>
                                <td colspan="2" style="text-align: center;">Đạt/ Không đạt</td>
                                <td colspan="2" style="text-align: center;">Đạt/ Không đạt</td>
                            </tr>
                        </tbody>
                    </table>
                     <a href="{{route('userview')}}" class="btn btn-info">Nộp phiếu</a>
                </form>
	
			</div>
		</div>
		
       
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