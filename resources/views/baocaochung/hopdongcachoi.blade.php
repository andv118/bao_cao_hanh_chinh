@extends('master')

@section('content')

<div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>|Báo cáo chung|Thống kê hợp đồng các hội</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-list-alt"></i> DANH SÁCH HỘI THEO HỢP SỐ LƯỢNG ĐỒNG</b></h3>
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
                                        <th colspan="1" style="text-align: center;">Cơ quan quản lý</th>
                                        <th colspan="1" style="text-align: center;">Số lượng hợp đồng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">1</td>
                                       <td style="text-align: center;font-size: 16px;">Hội kế toán Hà Nội</td>
                                       <td style="text-align: center;font-size: 16px;">Hội kế toán thành phố Hà Nội</td>
                                       <td style="text-align: center;">UBND phường Chương Dương</td>
                                       <td style="text-align: center;font-weight: bold;">Sở nội vụ</td>
                                       <td style="text-align: center;color: red;font-weight: bold;">12</td>
                                   </tr>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">2</td>
                                       <td style="text-align: center;font-size: 16px;">Hội cựu thanh niên xung phong quận Hoàn Kiếm</td>
                                       <td style="text-align: center;font-size: 16px;">Hội cựu TNXP phường Cửa Đông</td>
                                       <td style="text-align: center;">UBND phường Cửa Đông</td>
                                       <td style="text-align: center;font-weight: bold;">Sở nội vụ</td>
                                       <td style="text-align: center;color: red;font-weight: bold;">6</td>
                                   </tr>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">3</td>
                                       <td style="text-align: center;font-size: 16px;">Hội cựu thanh niên xung phong quận Hoàn Kiếm</td>
                                       <td style="text-align: center;font-size: 16px;">Hội cựu hội TNXP phường Cửa Nam</td>
                                       <td style="text-align: center;">UBND phường Cửa Nam</td>
                                       <td style="text-align: center;font-weight: bold;">Sở nội vụ</td>
                                       <td style="text-align: center;color: red;font-weight: bold;">8</td>
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

@endsection