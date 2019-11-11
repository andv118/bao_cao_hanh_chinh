@extends('master')

@section('content')

<div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>|Thống kê pháp nhân|Thống kê hội thuộc sở ngành</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-list-alt"></i> THỐNG KÊ HỘI THUỘC SỞ NGÀNH</b></h3>
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
                                    <b>Nhập tên hoặc mã cơ quan để tìm kiếm</b>
                                  </marquee>
                                </div>
                            </form>

                            <!-- Modal -->
                            

                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                               <thead>
                                    <tr>
                                        <th colspan="1" style="text-align: center;">STT</th>
                                        <th colspan="1" style="text-align: center;">Tên hội</th>
                                        <th colspan="1" style="text-align: center;">Tên hội thành viên</th>
                                        <th colspan="1" style="text-align: center;">Địa chỉ</th>
                                        <th colspan="1" style="text-align: center;">Số điện thoại</th>
                                </thead>
                                <tbody>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">1</td>
                                       <td style="text-align: center;font-size: 16px;">Hiệp hội nữ doanh nhân thành phố</td>
                                       <td style="text-align: center;font-size: 16px;">Tạp chí phái đẹp ELLE</td>
                                       <td style="text-align: center;">Tầng 5 tòa nhà Sông Hồng Land, 165 Thái Hà, Đống Đa</td>
                                       <td style="text-align: center;">03747468</td>
                                   </tr>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">2</td>
                                       <td style="text-align: center;font-size: 16px;">Hội đông y thành phố Hà Nội</td>
                                       <td style="text-align: center;font-size: 16px;">Hội Đông Y quận Ba Đình</td>
                                       <td style="text-align: center;"></td>
                                       <td style="text-align: center;">0913395144</td>
                                   </tr>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">3</td>
                                       <td style="text-align: center;font-size: 16px;">Hội đúc luyện kim Hà Nội</td>
                                       <td style="text-align: center;font-size: 16px;">Trung tâm đúc luyện kim Hà Nội</td>
                                       <td style="text-align: center;">38 ngõ 48 Mai Dịch, Từ Liêm Hà Nội</td>
                                       <td style="text-align: center;">0435762657</td>
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