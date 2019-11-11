@extends('master')
@section('content')
<style>
    tbody tr td {
        text-align: center;
        font-size: 16px;
        vertical-align: middle !important;
    }
</style>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
    $(document).ready(function() {
        var timeout = null;
        $('#data_search').keyup(function() {
            clearTimeout(timeout);
            var data = $('#data_search').val();
            var _token = $('input[name="_token"]').val();

            timeout = setTimeout(function() {
                $.ajax({
                    url: "{{route('admin.ajax-search')}}",
                    data: {
                        data: data,
                        _token: _token
                    },
                    type: "post",
                    success: function(data) {
                        // console.log(data);
                        $("#data_search").autocomplete({
                            source: data
                        });
                    },
                    error: function(errs) {
                        console.log(errs);
                    }
                });
            }, 300);
        });
    });
</script>

<div class="panel panel-default">
    <div class="panel-heading"><b><i class="fa fa-home"></i>/PHIẾU CUNG CẤP THÔNG TIN VỀ HỘI</b></div>
    <div class="panel-body">
        <div class="bootstrap-table">
            <div class="table-responsive">
                <form class="form-search" method="get" action="{{Route('admin.list-info')}}" onsubmit="return checkValidate();" style="margin: 10px 0;">
                    @csrf
                    <input type="text" name="keyword" placeholder="Tìm kiếm hội..." id="data_search" class="form-control" style="width: 25%;float: left;">&nbsp;
                    <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
                    <div style="color: red;" id="lbsearch"></div>
                    <div style="margin-left: 20px;margin-bottom: 20px;">
                        <marquee width="300">
                            <b>Nhập tên hội để tìm kiếm</b>
                        </marquee>
                    </div>
                </form>
                <table class="table table-bordered jambo_table">
                    <thead>
                        <tr>
                            <th width="40px">STT</th>
                            <th>Tên hội</th>
                            <th>Tên tiếng anh</th>
                            <th width="60px">Xem chi tiết</th>
                            <th width="40px">Sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 0; ?>
                        @foreach($list_info as $list)
                        <tr>
                            <td>
                                {{$stt+=1}}
                            </td>
                            <td>
                                {{$list->TenTiengViet}}
                            </td>
                            <td>
                                {{$list->TenTiengAnh}}
                            </td>
                            <td>
                                <a href="{{route('admin.detail-info',$list->MaHoi)}}">Xem chi tiết</a>
                            </td>
                            <td>
                                <a href="{{route('admin.edit-info',$list->MaHoi)}}" class="btn btn-primary">Sửa</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$list_info->links()}}
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection