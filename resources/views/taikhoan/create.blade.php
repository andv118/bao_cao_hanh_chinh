@extends('master')

@section('content')
<script>
    function checkValidate() {
        var fullname = document.getElementById("fullname").value;
        var phone = document.getElementById("phone").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var repassword = document.getElementById("repassword").value;
        var role = document.getElementById("role").value;
        var street = document.getElementById("street").value;

        var status = false; //Biến trạng thái



        if (fullname == "") {
            document.getElementById("fullname").style.borderColor = "red";
            document.getElementById("fullname").style.display = "block";
            document.getElementById("lbfullname").innerHTML = "Hãy nhập tên chủ cán bộ";
            status = true;
        } else {

            document.getElementById("fullname").style.borderColor = "#D8D8D8";
            document.getElementById("lbfullname").style.display = "none";

        }

        if (email == "") {
            document.getElementById("email").style.borderColor = "red";
            document.getElementById("email").style.display = "block";
            document.getElementById("lbemail").innerHTML = "Hãy nhập địa chỉ email";
            status = true;
        } else {

            document.getElementById("email").style.borderColor = "#D8D8D8";
            document.getElementById("lbemail").style.display = "none";

        }

        if (phone == "") {
            document.getElementById("phone").style.borderColor = "red";
            document.getElementById("phone").style.display = "block";
            document.getElementById("lbphone").innerHTML = "Hãy nhập số điện thoại";
            status = true;
        } else {

            document.getElementById("phone").style.borderColor = "#D8D8D8";
            document.getElementById("lbphone").style.display = "none";

        }

        if (password == "") {
            document.getElementById("password").style.borderColor = "red";
            document.getElementById("password").style.display = "block";
            document.getElementById("lbpassword").innerHTML = "Hãy nhập mật khẩu";
            status = true;
        } else {

            document.getElementById("password").style.borderColor = "#D8D8D8";
            document.getElementById("lbpassword").style.display = "none";

        }

        if (repassword == "") {
            document.getElementById("repassword").style.borderColor = "red";
            document.getElementById("repassword").style.display = "block";
            document.getElementById("lbrepassword").innerHTML = "Hãy nhập lại mật khẩu";
            status = true;
        } else {

            document.getElementById("repassword").style.borderColor = "#D8D8D8";
            document.getElementById("lbrepassword").style.display = "none";

        }

        if (role == "") {
            document.getElementById("role").style.borderColor = "red";
            document.getElementById("role").style.display = "block";
            document.getElementById("lbrole").innerHTML = "Hãy chọn quyền";
            status = true;
        } else {

            document.getElementById("role").style.borderColor = "#D8D8D8";
            document.getElementById("lbrole").style.display = "none";

        }

        if (street == "") {
            document.getElementById("street").style.borderColor = "red";
            document.getElementById("street").style.display = "block";
            document.getElementById("lbstreet").innerHTML = "Hãy chọn phường quản lý";
            status = true;
        } else {

            document.getElementById("street").style.borderColor = "#D8D8D8";
            document.getElementById("lbstreet").style.display = "none";

        }


        if (status == true) {

            return false;
        } else {
            return true;
        }




    }
</script>
<div class="panel panel-default">
    <div class="panel-heading"><b><i class="fa fa-home"></i>/Thêm mới người dùng</b></div>
    <div class="panel-body">

        <div class="bootstrap-table">
            <div class="fixed-table-toolbar"></div>
            <div class="fixed-table-container">

                <div class="fixed-table-header">
                    <h3 style="text-align: center;padding: 20px 20px;"><b>THÊM MỚI NGƯỜI DÙNG</b></h3>
                </div>

                <div class="fixed-table-body">
                    <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @elseif(Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach (Session::get('error') as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{route('admin.account.registerUsers')}}" class="col-sm-8 form-horizontal col-sm-offset-2" method="POST" onsubmit="return checkValidate();">
                        @csrf
                        <!-- Tên -->
                        <div class="form-group">
                            <label for="mst" class="col-sm-2 control-label">1. Họ tên cán bộ</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên cán bộ">
                            </div>
                            <div style="color: red;" id="lbname"></div>
                        </div>
                        <!-- End Tên -->

                        <!-- Điện thoại -->
                        <div class="form-group">
                            <label for="phoneNumber" class="col-sm-2 control-label">2. Điện Thoại</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Điện Thoại">
                            </div>
                            <div style="color: red;" id="lbphone"></div>

                        </div>
                        <!-- End Điện thoại -->

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">3. Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                            <div style="color: red;" id="lbemail"></div>

                        </div>
                        <!-- End Email -->

                        <!-- Mật khẩu -->
                        <div class="form-group">
                            <label for="addressTd" class="col-sm-2 control-label">4. Mật khẩu</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu">
                            </div>
                            <div style="color: red;" id="lbpassword"></div>

                        </div>
                        <!-- End Mật khẩu -->

                        <!-- Nhập lại Mật khẩu -->
                        <div class="form-group">
                            <label for="addressTd" class="col-sm-2 control-label">5. Nhập lại mật khẩu</label>
                            <div class="col-sm-8">
                                <input type="password" name="repassword" id="repassword" class="form-control" placeholder="Nhập lại mật khẩu">
                            </div>
                            <div style="color: red;" id="lbrepassword"></div>
                        </div>
                        <!-- End Nhập lại Mật khẩu -->

                        <!-- Đơn vị quản lý -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">6. Đơn vị quản lý</label>
                            <div class="col-sm-8">
                                <input type="text" name="dvquanly" id="dvquanly" class="form-control" placeholder="Nhập đơn vị quản lý">
                            </div>
                            <div style="color: red;" id="lbdvquanly"></div>

                        </div>
                        <!-- End Đơn vị quản lý -->

                        <!-- Quyền -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">7. Quyền hạn</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="role" id="role">
                                    <option value="0">Chọn quyền hạn</option>
                                    @foreach($role as $v)
                                    <option value="{{$v->level}}">{{$v->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="color: red;" id="lbrole"></div>

                        </div>
                        <!-- End Quyền -->

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success" style="margin-left: 204px;">Thêm</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection