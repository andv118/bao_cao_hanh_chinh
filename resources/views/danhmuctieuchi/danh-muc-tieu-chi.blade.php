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

<script>
    $(document).ready(function() {
        $(document).on('click', '#btn-danhmuc', function(e) {
            e.preventDefault();
            var type = 0;
            var id = $(this).children("input[name =danhmuc-id]").val();
            var parent_id = $(this).children("input[name =danhmuc-parent-id]").val();
            data(type, id, parent_id);
        });
        $(document).on('click', '#btn-tieuchi', function(e) {
            e.preventDefault();
            var type = 1;
            var id = $(this).children("input[name =danhmuc-id]").val();
            var parent_id = $(this).children("input[name =danhmuc-parent-id]").val();
            data(type, id, parent_id);
        });

        function data(type, id, parent_id) {
            $.ajax({
                type: "POST", 
                url: "{{Route('admin.viewUpdateDanhMucTieuChi')}}",
                data: {
                    type: type,
                    id: id,
                    parentId: parent_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    console.log(data);
                    // $('.table-content').html(data);
                }
            });
        }
    });
</script>

<div class="panel panel-default">
    <div class="panel-heading"><b><i class="fa fa-home"></i>/Quản lý danh mục & tiêu chí</b></div>
    <div class="panel-body">

        <div class="bootstrap-table">
            <div class="fixed-table-toolbar"></div>
            <div class="fixed-table-container">
                <div class="fixed-table-header">
                    <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-list-alt"></i> QUẢN LÝ DANH MỤC & TIÊU CHÍ</b></h3>
                </div>

                <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>

                <!-- Tìm kiếm -->
                <form class="form-search" method="post" onsubmit="return checkValidate();" action="{{route('admin.SearchUser')}}" style="margin: 10px 0;">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="text" name="keyword" placeholder="Tìm kiếm tiêu chí hoặc danh mục" id="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
                    <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
                    <div style="color: red;" id="lbsearch"></div>
                    <div style="margin-left: 20px;margin-bottom: 20px;">
                        <marquee width="300">
                            <b>Chọn từ khóa để tìm kiếm</b>
                        </marquee>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="1" name="select" required>Tiêu chí</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="2" name="select" required>Danh mục</label>
                    </div>
                </form>
                <!-- End Tìm kiếm -->

                <!-- Table -->
                <div class="table-responsive">
                    <a href="{{Route('admin.createModelReport')}}" class="btn btn-success"><i class="fa fa-folder-plus"></i> Thêm tiêu chí & danh mục</a>

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
                                <th rowspan="1" style="text-align: center; vertical-align:middle">Nội dung</th>
                                <th rowspan="1" style="text-align: center; vertical-align:middle">Đơn vị</th>
                                <th rowspan="1" style="text-align: center; vertical-align:middle">Cập nhật</th>
                                <th rowspan="1" style="text-align: center; vertical-align:middle">Xóa</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach($listTieuChi as $v)
                            <tr>
                                <td style="text-align: left; width:60%; font-weight:bold ;font-size:15px; vertical-align:middle">{{$v['stt'] . ": " . $v['title']}}</td>
                                <td style="text-align: left; width:10%; vertical-align:middle"></td>
                                <!-- Sửa -->
                                <td id="btn-danhmuc" style="text-align: center; vertical-align:middle">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#danhmuc{{$v['id']}}"><i class="fa fa-edit"></i> Cập nhật</button>
                                        <input type="hidden" name="danhmuc-id" value="{{$v['id']}}">
                                        <input type="hidden" name="danhmuc-parent-id" value="{{$v['parent_id']}}">
                                </td>
                                <div id="danhmuc{{$v['id']}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h3 class="modal-title" style="color: grey;text-align: center;"><b>CẬP NHẬT DANH MỤC</b></h3>
                                            </div>
                                            <div class="modal-body">
                                                
                                                
                                                <form action="{{Route('admin.updateModelReport')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$v['id']}}">
                                                    <!-- nội dung -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">1. Nội dung</label>
                                                        <div>
                                                            <input type="text" class="form-control" id="title" name="title" value="{{$v['title']}}">
                                                        </div>
                                                        <div style="color: red;" id="lbtitle"></div>
                                                    </div>
                                                    <!-- End nội dung -->
                                                    <!-- Danh mục -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">2. Danh mục cha</label>
                                                        <select class="form-control" name="position" id="position">
                                                            <option value="0">Root</option>
                                                        </select>
                                                        <div style="color: red;" id="lbposition"></div>
                                                    </div>
                                                    <!-- End Danh mục -->
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
                                <!-- Xóa -->
                                <td style="text-align: center; vertical-align:middle">
                                    <form action="{{Route('admin.deleteDanhMucTieuChi')}}" method="POST" onsubmit="return confirmDelete();">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$v['id']}}">
                                        <input type="hidden" name="type" value="0">
                                        <button class="btn btn-danger" type="submit" title="Xóa mẫu báo cáo"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @if($v['tieuchi'] != null)
                                @foreach($v['tieuchi'] as $tieuchi)
                                <tr>
                                    <td colspan="1" style="text-align: left;width:60%; vertical-align:middle">
                                        <?php
                                        $char = null;
                                        if ($tieuchi['position'] == 0) {
                                            $char = '- ';
                                        } elseif ($tieuchi['position'] == 1) {
                                            $char = '+ ';
                                        } elseif ($tieuchi['position'] == 2) {
                                            $char = '. ';
                                        } elseif ($tieuchi['position'] == 3) {
                                            $char = '.. ';
                                        } elseif ($tieuchi['position'] == 4) {
                                            $char = '... ';
                                        }
                                        echo str_repeat('&nbsp;&nbsp;&nbsp;', $tieuchi['position']) . $char . $tieuchi['title']
                                        ?>
                                    </td>
                                    <td colspan="1" style="text-align: center;width:10%; vertical-align:middle">{{$tieuchi['unit']}}</td>
                                    <!-- Sửa -->
                                    <td style="text-align: center; vertical-align:middle">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#tieuchi{{$v['id']}}"><i class="fa fa-edit"></i> Cập nhật</button>
                                        <input type="hidden" name="danhmuc-id" value="{{$tieuchi['id']}}">
                                        <input type="hidden" name="danhmuc-parent-id" value="{{$tieuchi['parent_id']}}">
                                    </td>
                                    <!-- Xóa -->
                                    <td style="text-align: center; vertical-align:middle">
                                        <form action="{{Route('admin.deleteDanhMucTieuChi')}}" method="POST" onsubmit="return confirmDelete();">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$tieuchi['id']}}">
                                            <input type="hidden" name="type" value="1">
                                            <button class="btn btn-danger" type="submit" title="Xóa mẫu báo cáo"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                            @endforeach
                        </tbody>
                    </table>

                    <div class="pull-right pagination">
                        {{--$units->links()--}}
                    </div>
                </div>
                <!-- End Table and pagination -->

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection