@extends('master')

@section('content')

<div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>|Danh mục hệ thống|Danh mục xã phường</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-list-alt"></i> DANH SÁCH XÃ PHƯỜNG</b></h3>
                        </div>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Thêm xã phường</button>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal2"><i class="fa fa-upload"></i> Nhập từ excel</button>

                           <form class="form-search" method="post" onsubmit="return checkValidate();" action="" style="margin: 10px 0;">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="text" name="keyword" placeholder="Tìm kiếm xã phường" id="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
                                <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
                                <div style="color: red;" id="lbsearch"></div> 
                                <div style="margin-left: 20px;margin-bottom: 20px;">
                                  <marquee width="300">
                                    <b>Nhập tên hoặc mã xã phường để tìm kiếm</b>
                                  </marquee>
                                </div>
                            </form>

                            <!-- Thêm xã phường-->
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h3 class="modal-title" style="text-align: center;color: green;"><b>THÊM XÃ PHUƯỜNG</b></h3>
                                        </div>
                                        <div class="modal-body">
                                           <form class="form-horizontal" action="/action_page.php">
                                               <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">1.Tên xã phường:</label>
                                                    <div class="col-sm-10">
                                                      <input type="email" class="form-control" placeholder="Nhập tên xã phường..." required="true">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="pwd">2.Mã xã phường:</label>
                                                    <div class="col-sm-10"> 
                                                      <input type="text" class="form-control"  placeholder="Nhập mã xã phường..." required="true">
                                                   </div>
                                                </div>
                                                <div class="form-group"> 
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                      <button type="submit" class="btn btn-primary">Lưu</button>
                                                </div>
                                              </div>
                                           </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Nhập excel -->
                            <div id="myModal2" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><b>NHẬP FILE EXCEL</b></h4>
                                  </div>
                                  <div class="modal-body">
                                    <form action="/action_page.php"  enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="email">Chọn file:</label>
                                            <input type="file" name="file" class="form-control" >
                                        </div>
                                       
                                        <button type="submit" class="btn btn-danger">Upload</button>
                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>

                              </div>
                            </div>
                            <!-- end -->
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                               <thead>
                                    <tr>
                                        <th colspan="1" style="text-align: center;">STT</th>
                                        <th colspan="1" style="text-align: center;">Tên xã phường</th>
                                        <th colspan="1" style="text-align: center;">Mã xã phường</th>
                                        <th colspan="1" style="text-align: center;"></th>
                                        <th colspan="1" style="text-align: center;"></th>
                                       
                                </thead>
                                <tbody>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">1</td>
                                       <td style="text-align: center;font-size: 16px;">Phường nhân chính</td>
                                       <td style="text-align: center;font-size: 16px;">NC</td>
                                       <td style="text-align: center;"><button data-toggle="modal" data-target="#updatecoquan" class="btn btn-success" title="Sửa"><i class="fa fa-edit"></i> Sửa</button></td>
                                       <td style="text-align: center;"><a href="" data-toggle="tooltip" class="btn btn-danger" title="Xóa"><i class="fas fa-trash-alt"></i></a></td>
                                   </tr>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">2</td>
                                       <td style="text-align: center;font-size: 16px;">Phường Phú Diễn</td>
                                       <td style="text-align: center;font-size: 16px;">PD</td>
                                       <td style="text-align: center;"><button data-toggle="tooltip" class="btn btn-success" title="Sửa"><i class="fa fa-edit"></i> Sửa</button></td>
                                       <td style="text-align: center;"><a href="" data-toggle="tooltip" class="btn btn-danger" title="Xóa"><i class="fas fa-trash-alt"></i></a></td>
                                   </tr>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">3</td>
                                       <td style="text-align: center;font-size: 16px;">Phường Cổ Nhuế</td>
                                       <td style="text-align: center;font-size: 16px;">CN</td>
                                       <td style="text-align: center;"><button data-toggle="tooltip" class="btn btn-success" title="Sửa"><i class="fa fa-edit"></i> Sửa</button></td>
                                       <td style="text-align: center;"><a href="" data-toggle="tooltip" class="btn btn-danger" title="Xóa"><i class="fas fa-trash-alt"></i></a></td>
                                   </tr>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">4</td>
                                       <td style="text-align: center;font-size: 16px;">Phường Tây Tựu</td>
                                       <td style="text-align: center;font-size: 16px;">TT</td>
                                       <td style="text-align: center;"><button data-toggle="tooltip" class="btn btn-success" title="Sửa"><i class="fa fa-edit"></i> Sửa</button></td>
                                       <td style="text-align: center;"><a href="" data-toggle="tooltip" class="btn btn-danger" title="Xóa"><i class="fas fa-trash-alt"></i></a></td>
                                   </tr>
                                </tbody>
                            </table>
                                <div class="pull-right pagination">
                                </div>
                        </div>
                       <!-- Update cơ quan -->
                        <div id="updatecoquan" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h3 class="modal-title" style="text-align: center;color: green;"><b>SỬA xã phường
                                        </div>
                                        <div class="modal-body">
                                           <form class="form-horizontal" action="">
                                               <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">1.Tên xã phường:</label>
                                                    <div class="col-sm-10">
                                                      <input type="email" class="form-control"  required="true" value="Phường Nhân Chính">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="pwd">2.Mã xã phường:</label>
                                                    <div class="col-sm-10"> 
                                                      <input type="text" class="form-control"  required="true" value="NC">
                                                   </div>
                                                </div>
                                                <div class="form-group"> 
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                      <button type="submit" class="btn btn-primary" data-dismiss="modal">Sửa</button>
                                                </div>
                                              </div>
                                           </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                        </div>
                        <!-- end -->
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <script>
            $(document).ready(function(){
              $('[data-toggle="tooltip"]').tooltip(); 
          });
      </script>
@endsection