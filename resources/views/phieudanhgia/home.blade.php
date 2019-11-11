@extends('master')

@section('content')

<div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>|Quản lý phiếu đánh giá hội</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-list-alt"></i> DANH SÁCH PHIẾU ĐÁNH GIÁ</b></h3>
                        </div>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <a href="{{route('admin.quanlyphieu.create')}}" class="btn btn-info" ><i class="fa fa-plus"></i> Thêm phiếu đánh giá</a>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-download"></i> Xuất excel kết quả đánh giá</button>

                           <form class="form-search" method="post" onsubmit="return checkValidate();" action="" style="margin: 10px 0;">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="text" name="keyword" placeholder="Tìm kiếm phiếu đánh giá" id="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
                                <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
                                <div style="color: red;" id="lbsearch"></div> 
                                <div style="margin-left: 20px;margin-bottom: 20px;">
                                  <marquee width="300">
                                    <b>Nhập tên hoặc mã phiếu để tìm kiếm</b>
                                  </marquee>
                                </div>
                            </form>


                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                               <thead>
                                    <tr>
                                        <th colspan="1" rowspan="2" style="text-align: center;">STT</th>
                                        <th colspan="1" rowspan="2" style="text-align: center;">Mã phiếu</th>
                                        <th colspan="1" rowspan="2" style="text-align: center;">Tên phiếu</th>
                                        <th colspan="1" rowspan="2" style="text-align: center;">Kiểu loại</th>
                                        <th colspan="1" rowspan="2" style="text-align: center;">Sửa lần cuối</th>
                                        <th colspan="1" rowspan="2" style="text-align: center;">Hiệu lực</th>
                                        <th colspan="1" rowspan="2" style="text-align: center;">Trạng thái</th>
                                        <th colspan="1" rowspan="2" style="text-align: center;">Số lượng</th>
                                        <th colspan="4"  style="text-align: center;">Thao tác</th>
                                      </tr>
                                      <tr>
                                         <th  style="text-align: center;">Sửa</th>
                                         <th style="text-align: center;">Xóa</th>
                                         <th style="text-align: center;">Xem chi tiết</th>
                                         <th style="text-align: center;">Thống kê kết <br> quả đánh giá</th>
                                      </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">1</td>
                                       <td style="text-align: center;font-size: 16px;">PH001 </td>
                                       <td style="text-align: center;font-size: 16px;">Đánh giá hội</td>
                                       <td style="text-align: center;font-size: 16px;">Chung</td>
                                       <td style="text-align: center;font-size: 16px;">22/10/2019 07:54:00</td>
                                       <td style="text-align: center;font-size: 16px;">12/02/2019 - 21/10/2021</td>
                                       <td style="text-align: center;font-size: 16px;color: red;">Đã xuất bản</td>
                                       <td style="text-align: center;font-size: 16px;color: green;">1/0</td>
                                       <td style="text-align: center;">
                                        <a href="{{route('admin.quanlyphieu.update')}}"  class="btn btn-success" title="Sửa"><i class="fa fa-edit"></i> Sửa</a>
                                      </td>
                                       <td style="text-align: center;"><a href="" data-toggle="tooltip" class="btn btn-danger" title="Xóa"><i class="fas fa-trash-alt"></i></a></td>  
                                       <td style="text-align: center;"><a href="{{route('admin.quanlyphieu.view')}}" data-toggle="tooltip" class="btn btn-danger" title="Xem chi tiết">Xem chi tiết</a></td>
                                        <td style="text-align: center;width: 100px;"><button href="" data-toggle="modal" data-target="#updatecoquan" class="btn btn-warning" title="Xem chi tiết">Thống kê kết quả</button></td>
                                   </tr>
                                      <tr>
                                       <td style="text-align: center;font-size: 16px;">2</td>
                                       <td style="text-align: center;font-size: 16px;">PH002 </td>
                                       <td style="text-align: center;font-size: 16px;">Đánh khảo sát hội</td>
                                       <td style="text-align: center;font-size: 16px;">Khảo sát</td>
                                       <td style="text-align: center;font-size: 16px;">22/10/2019 07:54:00</td>
                                       <td style="text-align: center;font-size: 16px;">12/02/2019 - 21/10/2021</td>
                                       <td style="text-align: center;font-size: 16px;color: black;">Chưa xuất bản</td>
                                       <td style="text-align: center;font-size: 16px;color: green;">1/0</td>
                                        <td style="text-align: center;">
                                        <a href="{{route('admin.quanlyphieu.update')}}"  class="btn btn-success" title="Sửa"><i class="fa fa-edit"></i> Sửa</a>
                                       </td>
                                       <td style="text-align: center;"><a href="" data-toggle="tooltip" class="btn btn-danger" title="Xóa"><i class="fas fa-trash-alt"></i></a></td>  
                                       <td style="text-align: center;"><a href="{{route('admin.quanlyphieu.view')}}" data-toggle="tooltip" class="btn btn-danger" title="Xem chi tiết">Xem chi tiết</a></td>
                                        <td style="text-align: center;width: 100px;"><a href="#" data-toggle="tooltip" class="btn btn-warning" title="Xem chi tiết">Thống kê kết quả</a></td>
                                   </tr>
                                    <tr>
                                       <td style="text-align: center;font-size: 16px;">3</td>
                                       <td style="text-align: center;font-size: 16px;">PH003 </td>
                                       <td style="text-align: center;font-size: 16px;">Khảo sát hội tháng 10 năm 2019</td>
                                       <td style="text-align: center;font-size: 16px;">Khảo sát</td>
                                       <td style="text-align: center;font-size: 16px;">22/10/2019 07:54:00</td>
                                       <td style="text-align: center;font-size: 16px;">12/02/2019 - 21/10/2021</td>
                                       <td style="text-align: center;font-size: 16px;color: black;">Chưa xuất bản</td>
                                       <td style="text-align: center;font-size: 16px;color: green;">1/2</td>
                                       <td style="text-align: center;">
                                        <a href="{{route('admin.quanlyphieu.update')}}"  class="btn btn-success" title="Sửa"><i class="fa fa-edit"></i> Sửa</a>
                                      </td>
                                       <td style="text-align: center;"><a href="" data-toggle="tooltip" class="btn btn-danger" title="Xóa"><i class="fas fa-trash-alt"></i></a></td>  
                                       <td style="text-align: center;"><a href="{{route('admin.quanlyphieu.view')}}" data-toggle="tooltip" class="btn btn-danger" title="Xem chi tiết">Xem chi tiết</a></td>
                                        <td style="text-align: center;width: 100px;"><a href="#" data-toggle="tooltip" class="btn btn-warning" title="Xem chi tiết">Thống kê kết quả</a></td>
                                   </tr>
                                    <tr>
                                       <td style="text-align: center;font-size: 16px;">4</td>
                                       <td style="text-align: center;font-size: 16px;">PH004 </td>
                                       <td style="text-align: center;font-size: 16px;">Bảng khảo sát hội tháng 11 năm 2018</td>
                                       <td style="text-align: center;font-size: 16px;">Khảo sát</td>
                                       <td style="text-align: center;font-size: 16px;">22/10/2018 07:54:00</td>
                                       <td style="text-align: center;font-size: 16px;">12/02/2018 - 21/10/2021</td>
                                       <td style="text-align: center;font-size: 16px;color: red;">Đã xuất bản</td>
                                       <td style="text-align: center;font-size: 16px;color: green;">1/2</td>
                                       <td style="text-align: center;">
                                        <a href="{{route('admin.quanlyphieu.update')}}"  class="btn btn-success" title="Sửa"><i class="fa fa-edit"></i> Sửa</a>
                                      </td>
                                       <td style="text-align: center;"><a href="" data-toggle="tooltip" class="btn btn-danger" title="Xóa"><i class="fas fa-trash-alt"></i></a></td>  
                                       <td style="text-align: center;"><a href="{{route('admin.quanlyphieu.view')}}" data-toggle="tooltip" class="btn btn-danger" title="Xem chi tiết">Xem chi tiết</a></td>
                                        <td style="text-align: center;width: 100px;"><a href="#" data-toggle="tooltip" class="btn btn-warning" title="Xem chi tiết">Thống kê kết quả</a></td>
                                   </tr>
                                
                                   
                                </tbody>
                            </table>
                              <!-- Update cơ quan -->
                            <div id="updatecoquan" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h3 class="modal-title" style="text-align: center;color: green;"><b>THỐNG KÊ KẾT QUẢ</b></h3>
                                            </div>
                                            <div class="modal-body">
                                               <form class="form-horizontal" action="">
                                                   <div class="form-group">
                                                        <label class="control-label col-sm-2" for="email">1.Tên phiếu:</label>
                                                        <div class="col-sm-10">
                                                          <input type="email" class="form-control"  required="true" value="Đánh giá hội">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2" for="pwd">2.Mã phiếu:</label>
                                                        <div class="col-sm-10"> 
                                                          <input type="text" class="form-control"  required="true" value="PH001">
                                                       </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="control-label col-sm-2" for="pwd">3.Lượt đánh giá:</label>
                                                        <div class="col-sm-10"> 
                                                          <input type="number" class="form-control"  required="true" value="10">
                                                       </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2" for="pwd">4.Đạt:</label>
                                                        <div class="col-sm-10"> 
                                                          <input type="text" class="form-control"  required="true" value="6/10">
                                                       </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2" for="pwd">5.Không đạt:</label>
                                                        <div class="col-sm-10"> 
                                                          <input type="text" class="form-control"  required="true" value="4/10">
                                                       </div>
                                                    </div>
                                                    <div class="form-group"> 
                                                        <div class="col-sm-offset-2 col-sm-10">
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

                            <div class="pull-right pagination">
                            </div>
                        </div>
                       
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