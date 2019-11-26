@extends('master')

@section('content')

<style>
    .title {
        text-align: center;
        padding: 3px 3px;
    }

    #dialog-them-tieu-chi {
        width: 80%;
    }
</style>

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
    <div class="panel-heading"><b><i class="fa fa-home"></i>/ Chi tiết mẫu báo cáo</b></div>
    <div class="panel-body">

        <div class="bootstrap-table">
            <div class="fixed-table-toolbar"></div>
            <div class="fixed-table-container">

                {{-- Title --}}
                <div class="fixed-table-header">
                    <h4 class="title"><b>{{$mauBaoCao->name_phuluc}}</b></h4>
                    <h4 class="title"><b>{{$mauBaoCao->name_baocao}}</b></h4>
                    <h5 class="title"><b>{{$mauBaoCao->name_ghichu}}</b></h5>
                </div>
                {{-- End Title --}}

                <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>

                <!-- Tìm kiếm -->
                <form class="form-search" method="post" onsubmit="return checkValidate();" action="{{route('admin.SearchUser')}}" style="margin: 10px 0;">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="text" name="keyword" placeholder="Tìm kiếm tiêu chí" id="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
                    <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
                    <div style="color: red;" id="lbsearch"></div>
                    <div style="margin-left: 20px;margin-bottom: 20px;">
                        <marquee width="300">
                            <b>Chọn từ khóa để tìm kiếm</b>
                        </marquee>
                    </div>
                </form>
                <!-- End Tìm kiếm -->

                <!-- Thêm tiêu chí -->
                <a data-toggle="modal" data-target="#them-tieu-chi" class="btn btn-success"><i class="fa fa-plus"></i> Thêm tiêu chí báo cáo</a>
                @include('baocao.dialog-them-tieu-chi')
                <!-- End Thêm tiêu chí -->

                <!-- Table -->
                <div class="table-responsive">
                    <table data-toggle="table" class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                        <thead>
                            <tr>
                                <th colspan="1" style="text-align: center; vertical-align:middle">TT</th>
                                <th colspan="2" style="text-align: center; vertical-align:middle">Nội dung báo cáo của
                                    đơn vị</th>
                                <th colspan="1" style="text-align: center; vertical-align:middle">Số lượng</th>
                                <th colspan="1" style="text-align: center; vertical-align:middle">Đơn vị tính</th>
                                <th colspan="3" style="text-align: center; vertical-align:middle">Giải trình/tên văn
                                    bản, số ký hiệu, ngày tháng năm ban hành văn bản/tài liệu đính kèm</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach($data2 as $v)
                            <tr>
                                <td colspan="1" style="text-align: center;width:5%;">{{$v->code}}</td>
                                <td colspan="2" style="text-align: center;width:65%;">{{$v->name}}</td>
                                <td colspan="1" style="text-align: center;width:5%;"></td>
                                <td colspan="1" style="text-align: center;width:5%;"></td>
                                <td colspan="3" style="text-align: center;width:20%;"></td>
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