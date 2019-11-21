@extends('master')

@section('content')
<script>
    function checkValidate() {
        var name = document.getElementById("name").value;
        var description = document.getElementById("description").value;
        var level = document.getElementById("level").value;

        var status = false; //Biến trạng thái

        if (name == "") {
            document.getElementById("name").style.borderColor = "red";
            document.getElementById("name").style.display = "block";
            document.getElementById("lbname").innerHTML = "Hãy nhập tên tác nhân";
            status = true;
        } else {
            document.getElementById("fullname").style.borderColor = "#D8D8D8";
            document.getElementById("lbname").style.display = "none";
        }

        if (description == "") {
            document.getElementById("description").style.borderColor = "red";
            document.getElementById("description").style.display = "block";
            document.getElementById("lbdescription").innerHTML = "Hãy nhập ghi chú";
            status = true;
        } else {
            document.getElementById("description").style.borderColor = "#D8D8D8";
            document.getElementById("lbdescription").style.display = "none";
        }

        if (level == 0) {
            document.getElementById("level").style.borderColor = "red";
            document.getElementById("level").style.display = "block";
            document.getElementById("lblevel").innerHTML = "Hãy chọn quyền";
            status = true;
        } else {
            document.getElementById("level").style.borderColor = "#D8D8D8";
            document.getElementById("lblevel").style.display = "none";

        }

        if (status == true) {
            return false;
        } else {
            return true;
        }
    }
</script>

<div class="panel panel-default">
    <div class="panel-heading"><b><i class="fa fa-home"></i>/Thêm mới nhóm người dùng</b></div>
    <div class="panel-body">

        <div class="bootstrap-table">
            <div class="fixed-table-toolbar"></div>
            <div class="fixed-table-container">

                <div class="fixed-table-header">
                    <h3 style="text-align: center;padding: 20px 20px;"><b>THÊM MỚI NHÓM NGƯỜI DÙNG</b></h3>
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
                    @endif

                    <form class="col-sm-8 form-horizontal col-sm-offset-2" method="POST" action="{{Route('admin.account.registerGroupUser')}}">
                        @csrf
                        <!-- Tên tác nhân -->
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">1. Tên tác nhân</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Tên tác nhân">
                            </div>
                            <div style="color: red;" id="lbname"></div>
                        </div>
                        <!-- End Tên tác nhân -->

                        <!-- Ghi chú -->
                        <div class="form-group">
                            <label for="phoneNumber" class="col-sm-2 control-label">2. Ghi chú</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="description" name="description" placeholder="Ghi chú">
                            </div>
                            <div style="color: red;" id="lbdescription"></div>

                        </div>
                        <!-- End Ghi chú -->

                        <!-- Quyền -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">3. Cấp quyền hạn</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="level" id="level">
                                    <option value="0">Chọn quyền hạn</option>
                                    <option value="1">Level 1</option>
                                    <option value="2">Level 2</option>
                                    <option value="3">Level 3</option>
                                    <option value="4">Level 4</option>
                                    <option value="5">Level 5</option>
                                    <option value="6">Level 6</option>
                                </select>
                            </div>
                            <div style="color: red;" id="lblevel"></div>

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