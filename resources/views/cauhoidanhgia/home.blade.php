@extends('master')

@section('content')

<div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>|Quản lý các câu hỏi đánh giá hội</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-list-alt"></i> DANH SÁCH CÂU HỎI ĐÁNH GIÁ</b></h3>
                        </div>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Thêm câu hỏi</button>

                           <form class="form-search" method="post" onsubmit="return checkValidate();" action="" style="margin: 10px 0;">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="text" name="keyword" placeholder="Tìm kiếm câu hỏi" id="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
                                <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
                                <div style="color: red;" id="lbsearch"></div> 
                                <div style="margin-left: 20px;margin-bottom: 20px;">
                                  <marquee width="300">
                                    <b>Nhập tên hoặc mã câu hỏi để tìm kiếm</b>
                                  </marquee>
                                </div>
                            </form>

                            <!-- Modal -->
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h3 class="modal-title" style="text-align: center;color: green;"><b><i class="fas fa-question-circle"></i> THÊM CÂU HỎI</b></h3>
                                        </div>
                                        <div class="modal-body">
                                           <form class="form-horizontal" action="/action_page.php">
                                               <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">1.Tên câu hỏi:</label>
                                                    <div class="col-sm-10">
                                                      <input type="email" class="form-control" placeholder="Nhập tên câu hỏi..." required="true">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="pwd">2.Mã câu hỏi:</label>
                                                    <div class="col-sm-10"> 
                                                      <input type="text" class="form-control"  placeholder="Nhập mã câu hỏi..." required="true">
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="pwd">3.Thang điểm đánh giá:</label>
                                                    <div class="col-sm-10"> 
                                                      <input type="number" class="form-control"  placeholder="Nhập thang điểm..." required="true">
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

                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                               <thead>
                                    <tr>
                                        <th colspan="1" style="text-align: center;">STT</th>
                                        <th colspan="1" style="text-align: center;">Mã câu hỏi</th>
                                        <th colspan="1" style="text-align: center;">Tên câu hỏi</th>
                                        <th colspan="1" style="text-align: center;">Thang điểm đánh giá</th>
                                        <th colspan="1" style="text-align: center;">Sửa</th>
                                        <th colspan="1" style="text-align: center;">Xóa</th>
                                       
                                </thead>
                                <tbody>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">1</td>
                                       <td style="text-align: center;font-size: 16px;">CH001 </td>
                                       <td style="text-align: center;font-size: 16px;">Những trở ngại hay thách thức nào sẽ cản trở việc phát triển của hội ?</td>
                                       <td style="text-align: center;font-size: 16px;">10 </td>
                                       <td style="text-align: center;"><button data-toggle="modal" data-target="#updatecoquan" class="btn btn-success" title="Sửa"><i class="fa fa-edit"></i> Sửa</button></td>
                                       <td style="text-align: center;"><a href="" data-toggle="tooltip" class="btn btn-danger" title="Xóa"><i class="fas fa-trash-alt"></i></a></td>
                                   </tr>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">2</td>
                                       <td style="text-align: center;font-size: 16px;">CH002 </td>
                                       <td style="text-align: center;font-size: 16px;">Hội đã đem lại nhiều lợi ích cho các thành viên từ ngày thành lập ?</td>
                                       <td style="text-align: center;font-size: 16px;">5 </td>
                                       <td style="text-align: center;"><button data-toggle="modal" data-target="#updatecoquan2" class="btn btn-success" title="Sửa"><i class="fa fa-edit"></i> Sửa</button></td>
                                       <td style="text-align: center;"><a href="" data-toggle="tooltip" class="btn btn-danger" title="Xóa"><i class="fas fa-trash-alt"></i></a></td>
                                   </tr>
                                    <tr>
                                       <td style="text-align: center;font-size: 16px;">3</td>
                                       <td style="text-align: center;font-size: 16px;">CH003 </td>
                                       <td style="text-align: center;font-size: 16px;">Anh/chị có thể nêu ra những sự công nhận mà anh/chị đã nhận được gần đây và sự công nhận ấy đã thúc đẩy anh/chị gắn bó với tổ chức, hiệp hội?</td>
                                       <td style="text-align: center;font-size: 16px;">5 </td>
                                       <td style="text-align: center;"><button data-toggle="modal" data-target="#updatecoquan" class="btn btn-success" title="Sửa"><i class="fa fa-edit"></i> Sửa</button></td>
                                       <td style="text-align: center;"><a href="" data-toggle="tooltip" class="btn btn-danger" title="Xóa"><i class="fas fa-trash-alt"></i></a></td>
                                   </tr>
                                    <tr>
                                       <td style="text-align: center;font-size: 16px;">4</td>
                                       <td style="text-align: center;font-size: 16px;">CH004 </td>
                                       <td style="text-align: center;font-size: 16px;">Hạn chế nào của hội bạn cảm thấy hội cần hoàn thiện hơn nữa?</td>
                                       <td style="text-align: center;font-size: 16px;">5 </td>
                                       <td style="text-align: center;"><button data-toggle="modal" data-target="#updatecoquan" class="btn btn-success" title="Sửa"><i class="fa fa-edit"></i> Sửa</button></td>
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
                                            <h3 class="modal-title" style="text-align: center;color: green;"><b>SỬA CÂU HỎI</b></h3>
                                        </div>
                                        <div class="modal-body">
                                           <form class="form-horizontal" action="">
                                               <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">1.Tên câu hỏi:</label>
                                                    <div class="col-sm-10">
                                                      <input type="email" class="form-control"  required="true" value="Những trở ngại hay thách thức nào sẽ cản trở việc phát triển của hội ?">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="pwd">2.Mã câu hỏi:</label>
                                                    <div class="col-sm-10"> 
                                                      <input type="text" class="form-control"   required="true" value="CH001">
                                                   </div>
                                                </div>
                                                 <div class="form-group">
                                                    <label class="control-label col-sm-2" for="pwd">3.Thang điểm đánh giá:</label>
                                                    <div class="col-sm-10"> 
                                                      <input type="number" class="form-control"  required="true" value="10">
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

                        <div id="updatecoquan2" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h3 class="modal-title" style="text-align: center;color: green;"><b>SỬA CÂU HỎI</b></h3>
                                        </div>
                                        <div class="modal-body">
                                           <form class="form-horizontal" action="">
                                               <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">1.Tên câu hỏi:</label>
                                                    <div class="col-sm-10">
                                                      <input type="email" class="form-control"  required="true" value="Hội đã đem lại nhiều lợi ích cho các thành viên từ ngày thành lập ?">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="pwd">2.Mã câu hỏi:</label>
                                                    <div class="col-sm-10"> 
                                                      <input type="text" class="form-control"   required="true" value="CH002">
                                                   </div>
                                                </div>
                                                 <div class="form-group">
                                                    <label class="control-label col-sm-2" for="pwd">3.Thang điểm đánh giá:</label>
                                                    <div class="col-sm-10"> 
                                                      <input type="number" class="form-control"  required="true" value="5">
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