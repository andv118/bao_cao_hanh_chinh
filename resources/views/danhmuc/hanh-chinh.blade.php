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
    <div class="panel-heading"><b><i class="fa fa-home"></i>/Danh mục hành chính</b></div>
    <div class="panel-body">

        <div class="bootstrap-table">
            <div class="fixed-table-toolbar"></div>
            <div class="fixed-table-container">
                <div class="fixed-table-header">
                    <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-list-alt"></i> CƠ CẤU TỔ CHỨC THÀNH PHỐ HÀ NỘI</b></h3>
                </div>

                <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>

                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <button id="hanh-chinh" style="float: right; width: 50%" type="button" class="btn btn-infor active-abc">Các cơ quan hành chính<br>(Quận, Huyện, Xã Phường)</button>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <button id="chuyen-mon" style="float: left; width: 50%" type="button" class="btn btn-infor">Các cơ quan chuyên môn<br>(Sở, Ban, Ngành)</button>
                    </div>
                </div>
                <style>
                    .active-abc {
                        background-color: aqua;
                        color: white !important;
                    }
                </style>

                <!-- Tìm kiếm -->
                <form id="search-submit" class="form-search" style="margin: 10px 0;">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="text" name="keyword" placeholder="Tìm kiếm đơn vị hành chính" id="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
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
                    <a style="display: none;" href="{{Route('admin.account.createGroupUsers')}}" class="btn btn-success"><i class="fa fa-user-plus"></i> Thêm nhóm người dùng</a>

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
                                <th style="text-align: center; width:75%;">Đơn vị hành chính</th>
                                <th style="text-align: center; width:25%;">Type</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach($listDvHanhChinh as $v)
                            @if($v['position'] == 0)
                            <tr>
                                <td style="text-align: center; font-weight: bold; font-size: 17px" ;>{{$v['stt']}}</td>
                                <td style="text-align: center; font-weight: bold; font-size: 17px">{{$v['name']}}</td>
                                <td style="text-align: center; font-weight: bold; font-size: 17px">{{$v['type']}}</td>
                            </tr>
                            @elseif($v['position'] == 1)
                            <tr>
                                <td style="text-align: center;">{{$v['stt']}}</td>
                                <td style="text-align: left; "><?php echo str_repeat("-", 3) . " " . $v['name']; ?></td>
                                <td style="text-align: center; ">{{$v['type']}}</td>
                            </tr>
                            @endif
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