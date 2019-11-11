<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Đăng nhập thuế tây hồ</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!-- Bootstrap -->
    <link href="public/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="public/admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="public/admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="public/admin/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="public/admin/build/css/custom.min.css" rel="stylesheet">


  </head>

  <body class="login">
    {{$name}}
{{$email}}
{{$content}}

    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <div style="color: black;font-size: 25px;font-weight: 600;">THUẾ TÂY HỒ</div>
            <form method="post" action="{{route('login')}}">
              <h1><b>Đăng nhập</b></h1>
              @csrf
              @if(count($errors)>0)
              <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                {{$err}} <br>
                @endforeach
              </div>
              @endif
              @if(Session::has('flag'))
              <div class="alert alert-{{Session::get('flag')}}">{{Session::get('message')}}</div>
              @endif
              <div class="form-group">
                <label for=""><b>Mã cán bộ/email (*)</b></label><br>
                <input type="text" name="email" class="form-control" placeholder="Username" required="" />
              </div>
              <div class="form-group">
                <label for=""><b>Mật khẩu (*)</b></label><br>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button class="btn btn-default submit" type="submit" >Đăng nhập</button>
                <a class="reset_pass" href="#" data-toggle="modal" data-target="#logoutModal">Quên mật khẩu ?</a>
              </div>
               <!----------------modalbox--------------------->
               <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn quên mật khẩu?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body"><b style="color: red;">Hãy nhập tài khoản email để lấy lại mật khẩu</b></div>
                  <form action="">
                    <div class="modal-body">
                      <label for=""><b>Địa chỉ email:</b></label>
                      <input type="email" class="form form-control" placeholder="Hãy nhập địa chỉ email...">
                    </div>
                   
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                      <a class="btn btn-primary" href="?controller=login&action=login">Gửi email</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
  <!-------------------------------------------------------------------------->
              <div class="clearfix"></div>

              <div class="separator">
                <div>
                  <p>©2016 Copyright about thuetayho</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
