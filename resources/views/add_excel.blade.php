@extends('master')

@section('content')

<!-- Start Content -->
<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12">
        <div class="panel panel-primary">

            <div class="panel-heading" style="text-align: center;"><b>THÊM DATA BẲNG FILE EXCEL</b></div>

            <div class="panel-body">
                <!-- Modal content-->
                <div class="content" style="margin-bottom:20px">
                    <div class="body">
                        <form action="{{Route('admin.danhMucHeThong.addExcel')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <label for="">Chọn file :</label>
                            <input type="file" name="select_file" value="Chọn file" class="form-control" placeholder="Chọn file" required="required" type="file" accept=".xlsx,.rar"><br>
                            <button class="btn btn-warning" type="submit"><i class="fas fa-upload" style="padding-right:5px"></i>OK</button>
                        </form>
                    </div>
                </div> <!-- End Modal content-->

                <!-- Kiểm tra trang thái -->
                <div style="display:none" class="notification">
                    <div class="alert alert-success" style="margin: 20px 0;text-align: center;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        @if (isset($thongbao))
                        {{$thongbao}}
                        @else
                        {{"Thông báo"}}
                        @endif
                    </div>

                </div>
                <!--End Kiểm tra trang thái -->

            </div>
        </div>
    </div>
</div> <!-- End Content -->


@endsection