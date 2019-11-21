@extends('master')

@section('content')
<script>
    function confirmDelete() {
        var r = confirm("Bạn có chắc chắn muốn xóa tài khoản này không?");
        if (r) return true;
        else return false;
    }
</script>
<script>
    function checkValidate() {
        //Tiến hành lấy dữ liệu trên Form
        var keyword = document.getElementById("keyword").value;
        var status = false; //Biến trạng thái

        if (keyword == "") {
            document.getElementById("keyword").style.borderColor = "red";
            document.getElementById("keyword").style.display = "block";
            document.getElementById("lbsearch").innerHTML = "Hãy nhập từ khóa tìm kiếm";
            status = true;
        } else {

            document.getElementById("keyword").style.borderColor = "#D8D8D8";
            document.getElementById("lbsearch").style.display = "none";

        }


        if (status == true) {
            //alert(msg);
            return false;
        } else {
            return true;
        }

    }

    function checkValidate2() {

        var filter = document.getElementById("filter").value;
        var status = false; //Biến trạng thái

        if (filter == "") {
            document.getElementById("filter").style.borderColor = "red";
            document.getElementById("filter").style.display = "block";
            document.getElementById("lbfilter").innerHTML = "Hãy chọn phường tìm kiếm";
            status = true;
        } else {

            document.getElementById("filter").style.borderColor = "#D8D8D8";
            document.getElementById("lbfilter").style.display = "none";

        }


        if (status == true) {
            //alert(msg);
            return false;
        } else {
            return true;
        }
    }
</script>
<div class="panel panel-default">
    <div class="panel-heading"><b><i class="fa fa-home"></i>/Danh sách người dùng</b></div>
    <div class="panel-body">

        <div class="bootstrap-table">
            <div class="fixed-table-toolbar"></div>
            <div class="fixed-table-container">
                <div class="fixed-table-header">
                    <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-list-alt"></i> DANH SÁCH NGƯỜI DÙNG</b></h3>
                </div>
                <!-- Nhập excel -->
                <a href="" data-toggle="modal" data-target="#import_excel_nguoi_dung" class="btn btn-success"><i class="fa fa-upload"></i> Nhập file excel danh sách</a>
                <!------------------Modal box --------------------------------->
                <div id="import_excel_nguoi_dung" class="modal fade" role="dialog">
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
                <!-- End Nhập excel -->

                <!-- Xuất excel -->
                <a href="{{route('admin.export_users')}}" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file excel danh sách</a>
                <!-- End xuất excel -->

                <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>

                <!-- Lọc theo nhóm người dùng và đơn vị quản lý -->
                <form class="form-search" method="post" action="{{route('admin.SearchUser')}}" onsubmit="return checkValidate2();" style="margin: 10px 0;">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <select type="text" id="filter" name="filter_donviquanly" class="form-control" style="width: 25%;float: left;">
                        <option value="">Lọc theo đơn vị quản lý</option>
                        @foreach($data3 as $v)
                        <option value="{{$v->id}}">{{$v->street_name}}</option>
                        @endforeach
                    </select>&nbsp;

                    <select type="text" id="filter" name="filter_nhomnguoidung" class="form-control" style="width: 25%;float: left;">
                        <option value="">Lọc theo nhóm người dùng</option>
                        @foreach($data3 as $v)
                        <option value="{{$v->id}}">{{$v->street_name}}</option>
                        @endforeach
                    </select>&nbsp;

                    <span><button class="btn btn-danger" type="submit" id="search"><i class="fas fa-filter"></i> Lọc</button></span>
                    <div style="color: red;" id="lbfilter"></div>
                </form>
                <!-- End Lọc theo nhóm người dùng và đơn vị quản lý -->

                <!-- Tìm kiếm -->
                <form class="form-search" method="post" onsubmit="return checkValidate();" action="{{route('admin.SearchUser')}}" style="margin: 10px 0;">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="text" name="keyword" placeholder="Tìm kiếm tài khoản, tên người dùng" id="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
                    <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
                    <div style="color: red;" id="lbsearch"></div>
                    <div style="margin-left: 20px;margin-bottom: 20px;">
                        <marquee width="300">
                            <b>Chọn từ khóa để tìm kiếm</b>
                        </marquee>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="1" name="select" required>Mã cán bộ</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="2" name="select" required>Tên cán bộ</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="3" name="select" required>Email</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="4" name="select" required>Số điện thoại</label>
                    </div>
                </form>
                <!-- End Tìm kiếm -->

                <!-- Table -->
                <div class="table-responsive">
                    <a href="{{Route('admin.account.createUsers')}}" class="btn btn-success"><i class="fa fa-user-plus"></i> Thêm người dùng</a>

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
                    @elseif(Session::has('loi'))
                        <div class="alert alert-danger">{{Session::get('loi')}}</div>
                    @endif

                    <table data-toggle="table" class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                        <thead>
                            <tr>
                                <th colspan="1" style="text-align: center;">STT</th>
                                <th colspan="1" style="text-align: center;">Tên cán bộ</th>
                                <th colspan="1" style="text-align: center;">Email</th>
                                <th colspan="1" style="text-align: center;">Số điện thoại</th>
                                <th colspan="1" style="text-align: center;">Đơn vị quản lý</th>
                                <th colspan="1" style="text-align: center;">Quyền hạn</th>
                                <th colspan="1" style="text-align: center;">Xóa</th>
                                <th colspan="1" style="text-align: center;">Cập nhật</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                            $stt = 1;
                            if(isset($_GET['page'])) {
                            $page = $_GET['page'];
                            } else {
                            $page = 1;
                            }
                            $stt += ($page - 1) * 10;
                            @endphp
                            @foreach($users as $v)
                            <tr>
                                <td style="text-align: center; width:5%; ">{{$stt++}}</td>
                                <td style="text-align: left;   width:10%;">{{$v->name}}</td>
                                <td style="text-align: left;   width:10%;">{{$v->email}}</td>
                                <td style="text-align: center; width:10%;">{{$v->phone}}</td>
                                <td style="text-align: left;   width:15%;">{{$v->don_vi_quan_ly}}</td>
                                <td style="text-align: left;   width:15%;">{{$v->cap_quan_ly}}</td>
                                <td style="text-align: center; width:15%;">
                                    <form action="{{route('admin.account.deleteUser')}}" method="POST" onsubmit="return confirmDelete();">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$v->id}}">
                                        <button class="btn btn-danger" type="submit" title="Xóa người dùng"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                                <td style="text-align: center; width:15%;"><button class="btn btn-primary" data-toggle="modal" data-target="#account{{$v->id}}"><i class="fa fa-edit"></i> Cập nhật</button></td>
                                <div id="account{{$v->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h3 class="modal-title" style="color: grey;text-align: center;"><b>CẬP NHẬT NGƯỜI DÙNG</b></h3>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{Route('admin.account.updateUser')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$v->id}}">

                                                    <!-- Tên cán bộ -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">1. Tên cán bộ</label>
                                                        <div>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{$v->name}}">
                                                        </div>
                                                        <div style="color: red;" id="lbname"></div>
                                                    </div>
                                                    <!-- End Tên cán bộ -->
                                                    <!-- Email -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">2.Email</label>
                                                        <div>
                                                            <input type="text" class="form-control" id="email" name="email" value="{{$v->email}}">
                                                        </div>
                                                        <div style="color: red;" id="lbemail"></div>
                                                    </div>
                                                    <!-- End Email -->
                                                    <!-- Phone -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">3.Số điện thoại</label>
                                                        <div>
                                                            <input type="text" class="form-control" id="phone" name="phone" value="{{$v->phone}}">
                                                        </div>
                                                        <div style="color: red;" id="lbphone"></div>
                                                    </div>
                                                    <!-- End Phone -->
                                                    <!-- Đv Quản lý -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">4.Đơn vị quản lý</label>
                                                        <div>
                                                            <input type="text" class="form-control" id="dvquanly" name="dvquanly" value="{{$v->don_vi_quan_ly}}">
                                                        </div>
                                                        <div style="color: red;" id="lbdvquanly"></div>
                                                    </div>
                                                    <!-- End Đv Quản lý -->
                                                    <!-- Quyền hạn -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">5. Cấp quyền hạn</label>
                                                        <select name="role" id="role" class="form-control" required>
                                                            @foreach ($role as $vrole)
                                                            @if ($vrole->level == $v->role)
                                                            <option value="{{$vrole->level}}" selected>{{$v->cap_quan_ly}}</option>
                                                            @else
                                                            <option value="{{$vrole->level}}">{{$vrole->name}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                        <div style="color: red;" id="lbrole"></div>
                                                    </div>
                                                    <!-- End Quyền hạn -->
                                                    <br>

                                                    <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-refresh"></span> Cập nhật</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="pull-right pagination">
                        {{$data2->links()}}
                    </div>
                </div>
                <!-- End Table and pagination -->
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection