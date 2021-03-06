@extends('master')

@section('content')

<div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>|Báo cáo chung|Báo cáo số lượng biên chế hợp đồng</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-list-alt"></i> BÁO CÁO SỐ LƯỢNG BIÊN CHẾ HỢP ĐỒNG</b></h3>
                        </div>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-download"></i> Xuất Excel</button>

                           <form class="form-search" method="post" onsubmit="return checkValidate();" action="" style="margin: 10px 0;">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="text" name="keyword" placeholder="Tìm kiếm cơ quan" id="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
                                <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
                                <div style="color: red;" id="lbsearch"></div> 
                                <div style="margin-left: 20px;margin-bottom: 20px;">
                                  <marquee width="300">
                                    <b>Nhập tên hoặc mã thành viên để tìm kiếm</b>
                                  </marquee>
                                </div>
                            </form>

                            <!-- Modal -->
                            

                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                               <thead>
                                    <tr>
                                        <th colspan="1" style="text-align: center;">STT</th>
                                        <th colspan="1" style="text-align: center;">Họ và tên</th>
                                        <th colspan="1" style="text-align: center;">Ngày sinh</th>
                                        <th colspan="1" style="text-align: center;">Giới tính</th>
                                        <th colspan="1" style="text-align: center;">Chức vụ</th>
                                        <th colspan="1" style="text-align: center;">Quá trình tham gia</th>
                                </thead>
                                <tbody>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">1</td>
                                       <td style="text-align: center;font-size: 16px;">Phạm Văn Dương</td>
                                       <td style="text-align: center;font-size: 16px;">06-09-1997</td>
                                       <td style="text-align: center;">Nam</td>
                                       <td style="text-align: center;">Phó hội trưởng</td>
                                       <td style="text-align: center;"></td>
                                   </tr>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">2</td>
                                       <td style="text-align: center;font-size: 16px;">Hoàng Văn Kiên</td>
                                       <td style="text-align: center;font-size: 16px;">01-02-1994</td>
                                       <td style="text-align: center;">Nam</td>
                                       <td style="text-align: center;">Quản lý hội</td>
                                       <td style="text-align: center;"></td>
                                   </tr>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">3</td>
                                       <td style="text-align: center;font-size: 16px;">Hoàng Văn Phú</td>
                                       <td style="text-align: center;font-size: 16px;">07-09-1991</td>
                                       <td style="text-align: center;">Nam</td>
                                       <td style="text-align: center;">Trưởng hội</td>
                                       <td style="text-align: center;"></td>
                                   </tr>
                                </tbody>
                            </table>
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