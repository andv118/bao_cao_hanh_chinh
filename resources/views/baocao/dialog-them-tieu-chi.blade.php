<div id="them-tieu-chi" class="modal fade" role="dialog">
    <div class="modal-dialog" id="dialog-them-tieu-chi">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="color: grey;text-align: center;"><b>THÊM TIÊU CHÍ BÁO CÁO</b></h3>
            </div>

            <div class="modal-body">
                <form action="" method="post">
                    @csrf
                    <!-- Tìm kiếm -->
                    <div class="row">
                        <div class="col-lg-6">
                            <form class="form-search" method="post" onsubmit="return checkValidate();" action="{{route('admin.SearchUser')}}" style="margin: 10px 0;">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="text" name="keyword" placeholder="Tìm kiếm tiêu chí" id="keyword" class="form-control" style="width: 70%;float: left;">&nbsp;
                                <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
                            </form>
                        </div>
                    </div>
                    <!-- End Tìm kiếm -->
                    <br>
                    <label for="email">Danh sách tiêu chí báo cáo</label>
                    <!-- Table -->
                    <div class="table-responsive">
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
                                    <td colspan="1" style="text-align: center;width:20%;">{{$v->code}}</td>
                                    <td colspan="3" style="text-align: left;width:35%;">{{$v->name}}</td>
                                    <td colspan="3" style="text-align: left;width:35%;">{{$v->name}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- pagination -->
                        <div class="pull-right pagination">
                            {{$data2->links()}}
                        </div>
                        <!-- End Table and pagination -->

                        <!-- Thêm -->
                        <button class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Thêm</button>
                        <!-- End Thêm -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>

    </div>
</div>