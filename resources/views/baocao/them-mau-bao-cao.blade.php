@extends('master')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading"><b><i class="fa fa-home"></i>/Thêm mới mẫu báo cáo</b></div>

    <div class="panel-body">
        <button href="" data-toggle="modal" data-target="#import_excel_mau-bao-cao" class="btn btn-success"><i class="fa fa-upload"></i> Nhập từ Excel</button>

        <!------------------Modal box --------------------------------->
        <div id="import_excel_mau-bao-cao" class="modal fade" role="dialog">
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
        <!-- End modal box -->

        <div class="bootstrap-table">
            <div class="fixed-table-toolbar"></div>
            <div class="fixed-table-container">
                <div class="fixed-table-header">
                    <h3 style="text-align: center;padding: 20px 20px;"><b>THÊM MỚI MẪU BÁO CÁO</b></h3>
                </div>

                <div class="fixed-table-body">
                    <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>

                    @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                        {{$err}} <br>
                        @endforeach
                    </div>
                    @endif
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @elseif(Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach (Session::get('error') as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form class="col-sm-8 form-horizontal col-sm-offset-2" action="{{Route('admin.registerModelReport')}}" method="POST">
                        @csrf
                        <!-- Mã báo cáo -->
                        <div class="form-group">
                            <label for="mst" class="col-sm-2 control-label">1. Mã báo cáo</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="code" name="code" placeholder="Mã báo cáo">
                            </div>
                            <div style="color: red;" id="lbcode"></div>
                        </div>
                        <!-- End Mã báo cáo -->

                        <!-- Kiểu báo cáo -->
                        <div class="form-group">
                            <label for="mst" class="col-sm-2 control-label">2. Kiểu báo cáo</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="type" id="type">
                                    <option value="0">Chọn kiểu báo cáo</option>
                                    <option value="1">Mẫu báo cáo</option>
                                    <option value="2">Mẫu tổng hợp</option>
                                </select>
                            </div>
                            <div style="color: red;" id="lbtype"></div>
                        </div>
                        <!-- End Kiểu báo cáo -->

                        <!-- Tên công văn -->
                        <div class="form-group">
                            <label for="phoneNumber" class="col-sm-2 control-label">3. Tên công văn</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="phuluc" name="phuluc" placeholder="Tên phụ lục">
                                <input type="text" class="form-control" id="baocao" name="baocao" placeholder="Tên báo cáo">
                                <input type="text" class="form-control" id="ghichu" name="ghichu" placeholder="Ghi chú">
                            </div>
                            <div style="color: red;" id="lbcongvan"></div>
                        </div>
                        <!-- End Tên công văn -->

                        <!-- Qúy báo cáo -->
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">4. Qúy báo cáo</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="quy" name="quy" placeholder="Qúy báo cáo">
                            </div>
                            <div style="color: red;" id="lbquy"></div>
                        </div>
                        <!-- End Qúy báo cáo -->

                        <!-- Năm báo cáo -->
                        <div class="form-group">
                            <label for="addressTd" class="col-sm-2 control-label">5. Năm báo cáo</label>
                            <div class="col-sm-8">
                                <input type="text" name="year" id="year" class="form-control" placeholder="Năm báo cáo">
                            </div>
                            <div style="color: red;" id="lbyear"></div>
                        </div>
                        <!-- End Năm báo cáo -->

                        <!-- Cấp báo cáo -->
                        <div class="form-group">
                            <label for="mst" class="col-sm-2 control-label">6. Cấp báo cáo</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="level" id="level">
                                    <option value="0">Chọn cấp báo cáo</option>
                                    <option value="1">Cấp 1 - Quận, Huyện, Thị Xã</option>
                                    <option value="2">Cấp 2 - Sở và các cơ quan ngang Sở</option>
                                    <option value="3">Cấp 3 - Xã, Phường, Thị Trấn</option>
                                </select>
                            </div>
                            <div style="color: red;" id="lbtype"></div>
                        </div>
                        <!-- End Cấp báo cáo -->

                        <!-- Table -->
                        {{--
                        <div class="table-responsive">
                            <p> <label for="addressTd">5. Chọn tiêu chí</label></p>
                            <table data-toggle="table" class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                                <thead>
                                    <tr>
                                        <th colspan="1" style="text-align: center; vertical-align:middle">Lựa chọn</th>
                                        <th colspan="1" style="text-align: center; vertical-align:middle">Mã tiêu chí</th>
                                        <th colspan="3" style="text-align: center; vertical-align:middle">Nội dung tiêu chí báo cáo</th>
                                        <th colspan="3" style="text-align: center; vertical-align:middle">Danh mục</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach($data2 as $v)
                                    <tr>
                                        <td colspan="1" style="text-align: center;width:10%;"> <input class="custom-control-label" type="checkbox" name="vehicle1"></td>
                                        <td colspan="1" style="text-align: center;width:20%;">$v->code</td>
                                        <td colspan="3" style="text-align: left;width:35%;">$v->name</td>
                                        <td colspan="3" style="text-align: left;width:35%;">$v->name</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        --}}
                        <!-- End table -->

                        <!-- Submit -->
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success" style="margin-left: 204px;">Thêm</button>
                            </div>
                        </div>
                        <!-- End Submit -->
                    </form>

                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>
@endsection