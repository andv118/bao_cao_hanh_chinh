@extends('master')

@section('content')

<div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>|Thống kê theo người đứng đầu|Thống kê lãnh đạo theo giới tính</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-list-alt"></i> DANH SÁCH HỘI CÓ LÃNH ĐẠO THEO GIỚI TÍNH</b></h3>
                        </div>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <button type="button" class="btn btn-info"><i class="fa fa-download"></i> Xuất Excel</button>

                           <form class="form-search" method="post" onsubmit="return checkValidate();" action="" style="margin: 10px 0;">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="text" name="keyword" placeholder="Tìm kiếm hội" id="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
                                <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
                                <div style="color: red;" id="lbsearch"></div> 
                                <div style="margin-left: 20px;margin-bottom: 20px;">
                                  <marquee width="300">
                                    <b>Nhập tên hoặc mã hội để tìm kiếm</b>
                                  </marquee>
                                </div>
                            </form>


                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                               <thead>
                                    <tr>
                                        <th colspan="1" style="text-align: center;">STT</th>
                                        <th colspan="1" style="text-align: center;">Tên hội</th>
                                        <th colspan="1" style="text-align: center;">Địa chỉ</th>
                                        <th colspan="1" style="text-align: center;">Lãnh đạo</th>
                                        <th colspan="1" style="text-align: center;">Cơ quan quản lý</th>
                                        <th colspan="1" style="text-align: center;">Giới tính</th>
                                        <th colspan="1" style="text-align: center;">Thành phố</th>
                                        <th colspan="1" style="text-align: center;">Quận huyện</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">1</td>
                                       <td style="text-align: center;font-size: 16px;">Hội cựu thanh niên xung phong huyện Ứng Hòa</td>
                                       <td style="text-align: center;font-size: 16px;">5c Lê Lợi, thị trấn Vân Đình, huyện Ứng Hòa, tp Hà Nội</td>
                                       <td style="text-align: center;font-size: 16px;">Lê Xuân Loan</td>
                                       <td style="text-align: center;font-size: 16px;color: red;">Sở nội vụ</td>
                                       <td style="text-align: center;font-size: 16px;color: orange;">Nam</td>
                                       <td style="text-align: center;font-size: 16px;"><input type="checkbox" checked="true"></td>
                                       <td style="text-align: center;font-size: 16px;"></td>

                                   </tr>
                                   <tr>
                                       <td style="text-align: center;font-size: 16px;">2</td>
                                       <td style="text-align: center;font-size: 16px;">Hội văn thư lưu trữ thành phố Hải Phòng</td>
                                       <td style="text-align: center;font-size: 16px;">Số 20 Huỳnh Thúc Kháng, quận Đống Đa, thành phố Hả Nội</td>
                                       <td style="text-align: center;font-size: 16px;">Lê Ngọc Anh</td>
                                       <td style="text-align: center;font-size: 16px;color: red;">Sở nội vụ</td>
                                       <td style="text-align: center;font-size: 16px;color: orange;">Nữ</td>
                                      <td style="text-align: center;font-size: 16px;"><input type="checkbox" checked="true"></td>
                                       <td style="text-align: center;font-size: 16px;"></td>

                                   </tr>

                                    <tr>
                                       <td style="text-align: center;font-size: 16px;">3</td>
                                       <td style="text-align: center;font-size: 16px;">Hội ô tô thành phố Hà Nội</td>
                                       <td style="text-align: center;font-size: 16px;">Số 75 Vương Thừa Vũ, quận Thanh Xuân, thành phố Hả Nội</td>
                                       <td style="text-align: center;font-size: 16px;">Nguyễn Văn Nam</td>
                                       <td style="text-align: center;font-size: 16px;color: red;">Sở nội vụ</td>
                                       <td style="text-align: center;font-size: 16px;color: orange;">Nam</td>
                                       <td style="text-align: center;font-size: 16px;"><input type="checkbox" checked="true"></td>
                                       <td style="text-align: center;font-size: 16px;"></td>

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