<!DOCTYPE html>
<html lang="en">
<head>
<title>Đăng nhập hệ thống quản lý hiệp hội</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Thuế tây hồ" />

<!-- css files -->
<link href="public/login/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
<link href="public/login/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- /css files -->

<!-- online fonts -->
<link href="//fonts.googleapis.com/css?family=Sirin+Stencil" rel="stylesheet">
<!-- online fonts -->
<!-- Latest compiled and minified CSS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<body>
<div class="container demo-1">

	<div class="content">
        <div id="large-header" class="large-header">
            <div class="container" style="padding-top: 50px;">
            	<marquee tên-thuộc-tính="giá-trị-thuộc-tính".... các-thuộc-tính-khác>

            		<h2 style="color: white;"><b>Đăng nhập hệ thống quản lý hiệp hội </b></h2>

            	</marquee>   	
            </div>
			<h1 style="font-family: sans-serif;">Hệ thống quản lý hiệp hội </h1>
				<div class="main-agileits">
				<!--form-stars-here-->
						<div class="form-w3-agile">
							
							<div class="logo" style="display: flex;align-items: center;justify-content: center;">
								<img src="public/images/logo.png" style="height: 100px; width: auto;">
							</div>
							<h2 style="font-family: sans-serif;margin-top: 20px;">Đăng Nhập</h2>
							<form  action="{{route('login')}}" method="post">
							  @csrf
				              @if(count($errors)>0)
				              <div class="alert alert-danger" style="color:red;margin: 20px 0;text-align: center;">
				                @foreach($errors->all() as $err)
				                {{$err}} <br>
				                @endforeach
				              </div>
				              @endif
				              @if(Session::has('flag'))
				              <div class="alert alert-{{Session::get('flag')}}" style="color:red;margin: 20px 0;text-align: center;">{{Session::get('message')}}</div>
				              @endif
								<div class="form-sub-w3">
									<input type="text" name="email" placeholder="Tên đăng nhập" required="" />
								<div class="icon-w3">
									<i class="fa fa-user" aria-hidden="true"></i>
								</div>
								</div>
								<div class="form-sub-w3">
									<input type="password" name="password" placeholder="Mật khẩu " required="" />
								<div class="icon-w3">
									<i class="fa fa-unlock-alt" aria-hidden="true"></i>
								</div>
								</div>
								<p class="p-bottom-w3ls">Quên mật khẩu?  <a class="btnModal" style="cursor: pointer;">Click Here</a></p>
								<div class="clear"></div>
								<div class="submit-w3l">
									<input type="submit" value="Đăng nhập">
								</div>
							</form>
							<div class="social w3layouts" style="height: 10px;">
								<div class="icons">
									
								</div>
								<div class="clear"></div>
							</div>
							
						</div>
				<!--//form-ends-here-->
				</div><!-- copyright -->
					<div class="copyright w3-agile">
						<p> © 2019 HTN . All rights reserved | Design by HTNSOFT </p>
					</div>
					<!-- //copyright --> 
        </div>
	</div>
</div>	
<div class="modal" id="modal" style="position: absolute;top:0px;background-color: rgba(255, 255, 255, 0.5);width: 100%;height: 100%;display: none;z-index: 999;">
	<form action="" style="background-color: grey;width: 250px;margin-top: 200px;height: 300px;box-shadow: 5px 5px black;padding: 30px 30px;border-radius: 5px;position: relative;">
		<button style="color: red;position: absolute;top: 5px;border-radius: 5px;left: 5px;" class="btnClose"><i class="fa fa-times-circle"></i></button>
		<h3 style="margin-top: 20px;"><b>Bạn Quên Mật Khẩu ?</b></h3>
		<label for="" style="margin-top: 20px;">Email</label><br>
		<input type="text" placeholder="Nhập email">
		<button class="btn btn-success">Gửi</button>
	</form>
</div>
<script>
	$(document).ready(function(){
		$('.btnModal').click(function(){
			$('.modal').show();
		});
		$('.btnClose').click(function(){
			$('.modal').hide();
		});
	});
</script>

</body>
</html>