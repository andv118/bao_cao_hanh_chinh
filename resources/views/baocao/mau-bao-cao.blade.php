@extends('master')

@section('content')
<script>
    function confirmDelete() {
        var r = confirm("Bạn có chắc chắn muốn xóa mẫu báo cáo này không?");
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
    <div class="panel-heading"><b><i class="fa fa-home"></i>/Quản lý mẫu báo cáo</b></div>
    <div class="panel-body">

        <div class="bootstrap-table">
            <div class="fixed-table-toolbar"></div>
            <div class="fixed-table-container">
                <div class="fixed-table-header">
                    <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-list-alt"></i> QUẢN LÝ MẪU BÁO CÁO</b></h3>
                </div>

                <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>

                <!-- Tìm kiếm -->
                <form class="form-search" method="post" onsubmit="return checkValidate();" action="{{route('admin.SearchUser')}}" style="margin: 10px 0;">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="text" name="keyword" placeholder="Tìm kiếm mẫu báo cáo" id="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
                    <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
                    <div style="color: red;" id="lbsearch"></div>
                    <div style="margin-left: 20px;margin-bottom: 20px;">
                        <marquee width="300">
                            <b>Chọn từ khóa để tìm kiếm</b>
                        </marquee>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="1" name="select" required>Mã báo cáo</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="2" name="select" required>Tên công văn</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="3" name="select" required>Quý báo cáo</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="4" name="select" required>Năm báo cáo</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="4" name="select" required>Tiêu chí báo cáo <span>(tìm kiếm nâng cao)</span></label>
                    </div>
                </form>
                <!-- End Tìm kiếm -->

                <!-- Table -->
                <div class="table-responsive">
                    <a href="{{Route('admin.createModelReport')}}" class="btn btn-success"><i class="fa fa-folder-plus"></i> Thêm mẫu báo cáo</a>

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
                        <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif

                    <table data-toggle="table" class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align:middle">Mã mẫu báo cáo</th>
                                <th rowspan="2" style="text-align: center; vertical-align:middle">Kiểu mẫu báo cáo</th>
                                <th rowspan="2" style="text-align: center; vertical-align:middle">Tên công văn</th>
                                <th rowspan="2" style="text-align: center; vertical-align:middle">Qúy báo cáo</th>
                                <th rowspan="2" style="text-align: center; vertical-align:middle">Năm báo cáo</th>
                                <th rowspan="2" style="text-align: center; vertical-align:middle">Cấp báo cáo</th>
                                <th colspan="4" style="text-align: center;">Hành động</th>
                            </tr>
                            <tr>
                                <th colspan="1" style="text-align: center; vertical-align:middle">Xem chi tiết</th>
                                <th colspan="1" style="text-align: center; vertical-align:middle">Xuất excel</th>
                                <th colspan="1" style="text-align: center; vertical-align:middle">Xóa</th>
                                <th colspan="1" style="text-align: center; vertical-align:middle">Cập nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mauBaoCao as $v)
                            <tr>
                                <td style="text-align: center; vertical-align:middle">{{$v->code}}</td>
                                <td style="text-align: center; vertical-align:middle">{{$v->kieubaocao}}</td>
                                <td style="text-align: left; vertical-align:middle">{{$v->name_baocao}}</td>
                                <td style="text-align: center; vertical-align:middle">Qúy {{$v->quarter_year}}</td>
                                <td style="text-align: center; vertical-align:middle">{{$v->year}}</td>
                                <td style="text-align: left; vertical-align:middle">{{$v->capBaoCao}}</td>

                                <!-- Xem chi tiết -->
                                <td style="text-align: center; vertical-align:middle">
                                    <a href="{{Route('admin.detailModelReport',$v->id)}}" class="btn btn-success"><i class="fa fa-info"></i></a>
                                </td>
                                <!-- End Xem chi tiết -->

                                <!-- Xuất excel -->
                                <td style="text-align: center; vertical-align:middle">
                                    <form action="{{route('admin.DeleteUser')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$v->id}}">
                                        <button class="btn btn-warning" type="submit" title="Xuất excel"><i class="far fa-file-excel"></i></button>
                                    </form>
                                </td>
                                <!-- End Xuất excel -->

                                <!-- Xóa -->
                                <td style="text-align: center; vertical-align:middle">
                                    <form action="{{Route('admin.deleteModelReport')}}" method="POST" onsubmit="return confirmDelete();">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$v->id}}">
                                        <button class="btn btn-danger" type="submit" title="Xóa mẫu báo cáo"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                                <!-- End Xóa -->

                                <!-- Sửa -->
                                <td style="text-align: center; vertical-align:middle"><button class="btn btn-primary" title="Cập nhật mẫu báo cáo" data-toggle="modal" data-target="#account{{$v->id}}"><i class="fa fa-edit"></i> Cập nhật</button></td>
                                <div id="account{{$v->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h3 class="modal-title" style="color: grey;text-align: center;"><b>CẬP NHẬT MẪU BÁO CÁO</b></h3>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{Route('admin.updateModelReport')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$v->id}}">
                                                    <!-- Mã báo cáo -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">1. Mã báo cáo</label>
                                                        <div>
                                                            <input type="text" class="form-control" id="code" name="code" value="{{$v->code}}">
                                                        </div>
                                                        <div style="color: red;" id="lbcode"></div>
                                                    </div>
                                                    <!-- End Mã báo cáo -->
                                                    <!-- Kiểu báo cáo -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">2. Kiểu báo cáo</label>
                                                        <select class="form-control" name="type" id="type">
                                                            @if($v->type == 1)
                                                            <option value="1" selected>Mẫu báo cáo</option>
                                                            <option value="2">Mẫu tổng hợp</option>
                                                            @elseif($v->type == 2)
                                                            <option value="1">Mẫu báo cáo</option>
                                                            <option value="2" selected>Mẫu tổng hợp</option>
                                                            @endif


                                                        </select>
                                                        <div style="color: red;" id="lbtype"></div>
                                                    </div>
                                                    <!-- End Kiểu báo cáo -->
                                                    <!-- Tên công văn -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">2. Tên công văn</label>
                                                        <div>
                                                            <label for="mst" class="control-label">2.1. Tên phụ lục</label>
                                                            <input type="text" class="form-control" id="phuluc" name="phuluc" value="{{$v->name_phuluc}}">
                                                            <label for="mst" class="control-label">2.2. Tên báo cáo</label>
                                                            <input type="text" class="form-control" id="baocao" name="baocao" value="{{$v->name_baocao}}">
                                                            <label for="mst" class="control-label">2.3. Ghi chú</label>
                                                            <input type="text" class="form-control" id="ghichu" name="ghichu" value="{{$v->name_ghichu}}">
                                                        </div>
                                                        <div style="color: red;" id="lbcongvan"></div>
                                                    </div>
                                                    <!-- End Tên công văn -->
                                                    <!-- Qúy báo cáo -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">3. Qúy báo cáo</label>
                                                        <div>
                                                            <input type="text" class="form-control" id="quy" name="quy" value="{{$v->quarter_year}}">
                                                        </div>
                                                        <div style="color: red;" id="lbquy"></div>
                                                    </div>
                                                    <!-- End Qúy báo cáo -->
                                                    <!-- Năm báo cáo -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">4. Năm báo cáo</label>
                                                        <div>
                                                            <input type="text" class="form-control" id="year" name="year" value="{{$v->year}}">
                                                        </div>
                                                        <div style="color: red;" id="lbquy"></div>
                                                    </div>
                                                    <!-- End Năm báo cáo -->
                                                    <!-- Cấp báo cáo -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">6. Cấp báo cáo</label>
                                                        <select class="form-control" name="level" id="level">
                                                            @if($v->level == 1)
                                                            <option value="1" selected >Cấp 1 - Quận, Huyện, Thị Xã</option>
                                                            <option value="2">Cấp 2 - Sở và các cơ quan ngang Sở</option>
                                                            <option value="3">Cấp 3 - Xã, Phường, Thị Trấn</option>
                                                            @elseif($v->level == 2)
                                                            <option value="1"  >Cấp 1 - Quận, Huyện, Thị Xã</option>
                                                            <option value="2" selected>Cấp 2 - Sở và các cơ quan ngang Sở</option>
                                                            <option value="3">Cấp 3 - Xã, Phường, Thị Trấn</option>
                                                            @elseif($v->level == 3)
                                                            <option value="1"  >Cấp 1 - Quận, Huyện, Thị Xã</option>
                                                            <option value="2">Cấp 2 - Sở và các cơ quan ngang Sở</option>
                                                            <option value="3" selected>Cấp 3 - Xã, Phường, Thị Trấn</option>
                                                            @endif
                                                            
                                                        </select>
                                                        <div style="color: red;" id="lblevel"></div>
                                                    </div>
                                                    <!-- End Cấp báo cáo -->
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
                                <!-- End Sửa -->
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