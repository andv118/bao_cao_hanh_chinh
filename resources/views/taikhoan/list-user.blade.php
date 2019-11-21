@extends('master')

@section('content')
<script>
    function confirmDelete() {
        var r = confirm("Bạn có chắc chắn muốn xóa nhóm người dùng này không?");
        if (r) return true;
        else return false;
    }
</script>

<div class="panel panel-default">
    <div class="panel-heading"><b><i class="fa fa-home"></i>/Danh sách nhóm người dùng</b></div>
    <div class="panel-body">

        <div class="bootstrap-table">
            <div class="fixed-table-toolbar"></div>
            <div class="fixed-table-container">
                <div class="fixed-table-header">
                    <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-list-alt"></i> DANH SÁCH NHÓM NGƯỜI DÙNG</b></h3>
                </div>

                <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>

                <!-- Tìm kiếm -->
                <form class="form-search" method="post" onsubmit="return checkValidate();" action="{{route('admin.SearchUser')}}" style="margin: 10px 0;">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="text" name="keyword" placeholder="Tìm kiếm nhóm người dùng" id="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
                    <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
                    <div style="color: red;" id="lbsearch"></div>
                    <div style="margin-left: 20px;margin-bottom: 20px;">
                        <marquee width="300">
                            <b>Chọn từ khóa để tìm kiếm</b>
                        </marquee>
                    </div>
                </form>
                <!-- End Tìm kiếm -->

                <!-- Table -->
                <div class="table-responsive">
                    <a href="{{Route('admin.account.createGroupUsers')}}" class="btn btn-success"><i class="fa fa-user-plus"></i> Thêm nhóm người dùng</a>

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
                                <th colspan="1" style="text-align: center;">Tên tác nhân</th>
                                <th colspan="1" style="text-align: center;">Ghi chú</th>
                                <th colspan="1" style="text-align: center;">Cấp quyền hạn</th>
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
                            @foreach($data as $v)
                            <tr>
                                <td style="text-align: center; width:5%;">{{$stt++}}</td>
                                <td style="text-align: left; width:20%;">{{$v->name}}</td>
                                <td style="text-align: left; width:30%;">{{$v->description}}</td>
                                <td style="text-align: center; width:10%;">Level {{$v->level}}</td>

                                <td style="text-align: center; width:20%;">
                                    <form action="{{Route('admin.account.deleteGroupUser')}}" method="post" onsubmit="return confirmDelete();">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$v->id}}">
                                        <button class="btn btn-danger" type="submit" title="Xóa tài khoản"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>

                                <td style="text-align: center; width:25%;"><button class="btn btn-primary" data-toggle="modal" data-target="#account{{$v->id}}"><i class="fa fa-edit"></i> Cập nhật</button></td>
                                <div id="account{{$v->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h3 class="modal-title" style="color: grey;text-align: center;"><b>CẬP NHẬT NHÓM NGƯỜI DÙNG</b></h3>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{Route('admin.account.updateGroupUser')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$v->id}}">

                                                    <!-- Tên nhóm quản trị -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">1. Tên tác nhân</label>
                                                        <div>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{$v->name}}">
                                                        </div>
                                                        <div style="color: red;" id="lbname"></div>
                                                    </div>
                                                    <!-- End Tên nhóm quản trị -->
                                                    <br>
                                                    <!-- Ghi chú -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">2. Ghi chú</label>
                                                        <div>
                                                            <input type="text" class="form-control" id="description" name="description" value="{{$v->description}}">
                                                        </div>
                                                        <div style="color: red;" id="lbdescription"></div>
                                                    </div>
                                                    <!-- End ghi chú -->
                                                    <br>
                                                    <!-- Level -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">3. Cấp quyền hạn</label>
                                                        <select name="level" id="level" class="form-control" required>
                                                            @for ($i = 1; $i <= 6; $i++) @if ($v->level == $i)
                                                                <option value="{{$i}}" selected>Level {{$i}}</option>
                                                                @else
                                                                <option value="{{$i}}">Level {{$i}}</option>
                                                                @endif
                                                                @endfor
                                                        </select>
                                                        <div style="color: red;" id="lblevel"></div>
                                                    </div>
                                                    <!-- End Level -->
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
                        {{$data->links()}}
                    </div>
                </div>
                <!-- End Table and pagination -->

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection