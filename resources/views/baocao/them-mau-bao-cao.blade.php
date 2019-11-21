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
    <div class="panel-heading"><b><i class="fa fa-home"></i>/Thêm mới mẫu báo cáo</b></div>

    <div class="panel-body">
        <button href="" data-toggle="modal" data-target="#import_excel_mau-bao-cao" class="btn btn-success"><i class="fa fa-upload"></i> Nhập từ Excel</button>

        <!------------------Modal box --------------------------------->
        <div id="import_excel_mau-bao-cao" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title" style="color: green;text-align: center;"><b>NHẬP FILE EXEL</b></h3>
                    </div>
                    <div class="modal-body">
                        <form class="form-submit" action="#" enctype="multipart/form-data" method="POST">
                            @csrf
                            <label for="">Chọn file :</label>
                            <input type="file" name="select_file" value="Chọn file" class="form-control" placeholder="Chọn file" required="required" accept=".xlsx, .xls"><br>
                            <button class="btn btn-success" type="submit"><i class="fas fa-upload" style="padding-right:5px"></i>Upload</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- End modal box -->

        <div class="bootstrap-table">
            <div class="fixed-table-toolbar"></div>
            <div class="fixed-table-container">
                <div class="fixed-table-header">
                    <h3 style="text-align: center;padding: 20px 20px;"><b>THÊM MỚI MẪU BÁO CÁO</b></h3>
                </div>

                <div class="fixed-table-body">
                    <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>

                    @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                        {{$err}} <br>
                        @endforeach
                    </div>
                    @endif
                    @if(Session::has('thanhcong'))
                    <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
                    @endif

                    <form class="col-sm-8 form-horizontal col-sm-offset-2" method="post" action="{{route('admin.register')}}" onsubmit="return checkValidate();">
                        @csrf
                        <!-- Mã báo cáo -->
                        <div class="form-group">
                            <label for="mst" class="col-sm-2 control-label">1. Mã báo cáo</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="fullname" name="name" placeholder="Mã báo cáo">
                            </div>
                            <div style="color: red;" id="lbfullname"></div>
                        </div>
                        <!-- End Mã báo cáo -->

                        <!-- Tên công văn -->
                        <div class="form-group">
                            <label for="phoneNumber" class="col-sm-2 control-label">2. Tên công văn</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Tên phụ lục">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Tên báo cáo">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Ghi chú">
                            </div>
                            <div style="color: red;" id="lbphone"></div>

                        </div>
                        <!-- End Tên công văn -->

                        <!-- Qúy báo cáo -->
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">3. Qúy báo cáo</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Qúy báo cáo">
                            </div>
                            <div style="color: red;" id="lbemail"></div>
                        </div>
                        <!-- End Qúy báo cáo -->

                        <!-- Năm báo cáo -->
                        <div class="form-group">
                            <label for="addressTd" class="col-sm-2 control-label">4. Năm báo cáo</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Năm báo cáo">
                            </div>
                            <div style="color: red;" id="lbpassword"></div>
                        </div>
                        <!-- End Năm báo cáo -->

                        <!-- Table -->
                        <div class="table-responsive">
                            <p> <label for="addressTd">5. Chọn tiêu chí</label></p>
                            <table data-toggle="table" class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                                <thead>
                                    <tr>
                                        <th colspan="1" style="text-align: center; vertical-align:middle">Lựa chọn</th>
                                        <th colspan="1" style="text-align: center; vertical-align:middle">Mã tiêu chí</th>
                                        <th colspan="3" style="text-align: center; vertical-align:middle">Nội dung tiêu chí báo cáo</th>
                                        <th colspan="3" style="text-align: center; vertical-align:middle">Danh mục</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach($data2 as $v)
                                    <tr>
                                        <td colspan="1" style="text-align: center;width:10%;"> <input class="custom-control-label" type="checkbox" name="vehicle1"></td>
                                        <td colspan="1" style="text-align: center;width:20%;">{{$v->code}}</td>
                                        <td colspan="3" style="text-align: left;width:35%;">{{$v->name}}</td>
                                        <td colspan="3" style="text-align: left;width:35%;">{{$v->name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End table -->

                        <!-- Submit -->
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success" style="margin-left: 204px;">Thêm</button>
                            </div>
                        </div>
                        <!-- End Submit -->
                    </form>

                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>
@endsection