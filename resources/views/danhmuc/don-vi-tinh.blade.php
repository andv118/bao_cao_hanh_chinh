@extends('master')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/start/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    function confirmDelete() {
        var r = confirm("Bạn có chắc chắn muốn xóa nhóm người dùng này không?");
        if (r) return true;
        else return false;
    }
</script>

<script>
    $(document).ready(function() {
        // 1: hanhchinh: active - 0: chuyenmon: active
        var choose = 0;
        var timeout = null;

        $('#search-submit').submit(function(e) {
            e.preventDefault();
            var keyword = $('#keyword').val();
            // console.log(choose + " - " + keyword);
            filterData(choose, keyword);
        });

        $('#keyword').autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: "POST",
                    url: "{{Route('admin.danhMucHeThong.search')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        choose: choose,
                        keyword: request.term,
                    },
                    success: function(data) {
                        var resp = $.map(data, function(obj) {
                            // console.log(obj.name);
                            return obj.name;
                        });
                        response(resp);
                        // console.log(data);
                    },
                });
            },
            minLength: 1,
        });

        $('#hanh-chinh').click(function() {
            if (choose != 0) {
                choose = 0;
                filterData(choose, null);
                // alert('hanh chinh');
            }
            $(this).addClass("active-abc");
            $('#chuyen-mon').removeClass("active-abc");

        });

        $('#chuyen-mon').click(function() {
            if (choose != 1) {
                choose = 1;
                filterData(choose, null);
                // alert('chuyen mon');
            }
            $(this).addClass("active-abc");
            $('#hanh-chinh').removeClass("active-abc");
        });

        // loc theo đơn vị
        function filterData(choose, keyword) {
            $.ajax({
                type: "POST",
                url: "{{Route('admin.danhMucHeThong.filter')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    choose: choose,
                    keyword: keyword,
                },
                success: function(data) {
                    console.log(data);
                    $('#tbody').html('');
                    data.forEach(function(value, key) {
                        var name = value['name'];
                        var stt = value['stt'];
                        var type = value['type'];
                        var position = value['position'];
                        if (position == 0) {
                            $('#tbody').append(
                                '<tr>' +
                                '<td style="text-align: center; font-weight: bold; font-size: 17px" ;>' + stt + '</td>' +
                                '<td style="text-align: left; font-weight: bold; font-size: 17px">' + name + '</td>' +
                                '<td style="text-align: center; font-weight: bold; font-size: 17px">' + type + '</td>' +
                                '</tr>'
                            );
                        } else if (position == 1) {
                            $('#tbody').append(
                                '<tr>' +
                                '<td style="text-align: center;">' + stt + '</td>' +
                                '<td style="text-align: left; ">--- ' + name + '</td>' +
                                '<td style="text-align: center">' + type + '</td>' +
                                '</tr>'
                            );
                        }
                    });
                }
            });
        }

        // tìm kiếm
        function searchData(choose, keyword) {
            $.ajax({
                type: "POST",
                url: "{{Route('admin.danhMucHeThong.search')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    choose: choose,
                    keyword: keyword,
                },
                success: function(data) {

                },
                delay: 500,
            });
        }
    });
</script>

<div class="panel panel-default">
    <div class="panel-heading"><b><i class="fa fa-home"></i>/Đơn vị tiêu chí</b></div>
    <div class="panel-body">

        <div class="bootstrap-table">
            <div class="fixed-table-toolbar"></div>
            <div class="fixed-table-container">
                <div class="fixed-table-header">
                    <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-list-alt"></i> DANH SÁCH ĐƠN VỊ TIÊU CHÍ</b></h3>
                </div>

                <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>

                <!-- Table -->
                <div class="table-responsive">
                    <a class="btn btn-success" data-toggle="modal" data-target="#addDonVi" ><i class="fa fa-user-plus"></i> Thêm mới đơn vị tiêu chí</a>
                    <div id="addDonVi" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h3 class="modal-title" style="color: grey;text-align: center;"><b>THÊM ĐƠN VỊ TIÊU CHÍ</b></h3>
                                </div>

                                <div class="modal-body">
                                    <form action="{{Route('admin.danhMucHeThong.addDonViTinh')}}" method="POST">
                                        @csrf
                                        <!-- Đvi tiêu chí -->
                                        <div class="form-group">
                                            <label for="mst" class="control-label">1. Đơn vị tiêu chí</label>
                                            <div>
                                                <input type="text" class="form-control" id="name" name="name">
                                            </div>
                                            <div style="color: red;" id="lbname"></div>
                                        </div>
                                        <!-- End Đvi tiêu chí -->
                                        <br>

                                        <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-refresh"></span> Thêm</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>



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
                                <th style="text-align: center; width:5%;">STT</th>
                                <th style="text-align: center; width:65%;">Đơn vị tiêu chí</th>
                                <th style="text-align: center; width:15%;">Xóa</th>
                                <th style="text-align: center; width:15%;">Cập nhật</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @php
                            $stt = 1;
                            if(isset($_GET['page'])) {
                            $page = $_GET['page'];
                            } else {
                            $page = 1;
                            }
                            $stt += ($page - 1) * 10;
                            @endphp
                            @foreach($listDonViTieuChi as $v)
                            <tr>
                                <td style="text-align: center;">{{$stt++}}</td>
                                <td style="text-align: left;">{{$v->name}}</td>

                                <!-- delete -->
                                <td style="text-align: center;">
                                    <form action="{{Route('admin.danhMucHeThong.deleteDonViTinh')}}" method="post" onsubmit="return confirmDelete();">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$v->id}}">
                                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>

                                <!-- update  -->
                                <td style="text-align: center; width:25%;"><button class="btn btn-primary" data-toggle="modal" data-target="#dvitieuchi{{$v->id}}"><i class="fa fa-edit"></i> Cập nhật</button></td>
                                <div id="dvitieuchi{{$v->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h3 class="modal-title" style="color: grey;text-align: center;"><b>CẬP NHẬT ĐƠN VỊ TIÊU CHÍ</b></h3>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{Route('admin.danhMucHeThong.updateDonViTinh')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$v->id}}">
                                                    <!-- Đvi tiêu chí -->
                                                    <div class="form-group">
                                                        <label for="mst" class="control-label">1. Đơn vị tiêu chí</label>
                                                        <div>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{$v->name}}">
                                                        </div>
                                                        <div style="color: red;" id="lbname"></div>
                                                    </div>
                                                    <!-- End Đvi tiêu chí -->
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
                        {{--$users->links()--}}
                    </div>
                </div>
                <!-- End Table and pagination -->

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection