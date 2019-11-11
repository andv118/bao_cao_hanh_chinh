@extends('master')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading"><b><i class="fa fa-home"></i>/Quản lý rủi ro</b></div>
    <div class="panel-body">
        <div class="bootstrap-table">
            <div class="fixed-table-toolbar"></div>
            <div class="fixed-table-container">
                <div class="fixed-table-header">
                    <h3 style="text-align: center;"><b>DANH SÁCH RỦI RO </b><span style="color: red;"><b><i class="fas fa-exclamation-triangle"></i></b></span></h3>
                </div>
                <div class="fixed-table-body" style="height: 800px;">        
                <div class="row" style="margin-top: 20px;">
                  <div class="col-md-12">
                    <div class="">
                      <div class="x_content">
                        <div class="row">
                          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" >
                            <div class="tile-stats" style="background-color: #8cd6a963;box-shadow: 4px 4px grey;height: 190px;">
                              <div class="icon"><i style="color: orange;" class="fas fa-exclamation-circle"></i>
                              </div>
                              <div class="count" style="padding-left: 20px;">{{$err5}}</div>

                              <div style="padding: 10px 10px;text-align: center;font-size: 15px;margin-top: 20px;">
                                <b>Sai Lệch Về Giá trên hợp đồng so với dữ liệu quản lý thuế</b>

                             </div>
                             <div style="text-align: center;"><a href="{{route('admin.error1')}}" >Xem chi tiết</a></div>
                             
                            </div>
                          </div>
                          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats" style="background-color: #8cd6a963;box-shadow: 4px 4px grey;height: 190px;">
                              <div class="icon"><i style="color: orange;" class="fas fa-exclamation-circle"></i>
                              </div>
                              <div class="count" style="padding-left: 20px;">{{$err4}}</div>

                             <div style="padding: 10px 10px;text-align: center;font-size: 15px;margin-top: 20px;">
                                <b>Hợp đồng có giá trị trên 100 triệu (năm) chưa quản lý</b>

                             </div>
                             <div style="text-align: center;"><a href="{{route('admin.error2')}}" >Xem chi tiết</a></div>
                            </div>
                          </div>
                          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats" style="background-color: #8cd6a963;box-shadow: 4px 4px grey;">
                              <div class="icon"><i style="color: orange;" class="fas fa-exclamation-circle"></i>
                              </div>
                              <div class="count" style="padding-left: 20px;">{{$err3}}</div>

                             <div style="padding: 10px 10px;text-align: center;font-size: 15px;margin-top: 20px;">
                                <b>Hợp Đồng Có Tổng 
                                    Giá Trị Theo Tháng Thấp Hơn 
                                Với Giá Trị Tài Sản thực tế theo thông tin</b>

                             </div>
                             <div style="text-align: center;"><a href="{{route('admin.error3')}}" >Xem chi tiết</a></div>
                            </div>
                          </div>
                          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats" style="background-color: #8cd6a963;box-shadow: 4px 4px grey;">
                              <div class="icon"><i style="color: orange;" class="fas fa-exclamation-circle"></i>
                              </div>
                              <div class="count" style="padding-left: 20px;">{{$err1}}</div>

                             <div style="padding: 10px 10px;text-align: center;font-size: 15px;margin-top: 20px;">
                                <b>Có Thông Tin giá tham khảo Cho Thuê trên 100 triệu Nhưng Chưa Quản Lý</b>

                             </div>
                             <div style="text-align: center;"><a href="{{route('admin.error4')}}" >Xem chi tiết</a></div>
                            </div>
                          </div>
                          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats" style="background-color: #8cd6a963;box-shadow: 4px 4px grey;">
                              <div class="icon"><i style="color: orange;" class="fas fa-exclamation-circle"></i>
                              </div>
                              <div class="count" style="padding-left: 20px;">{{$err2}}</div>

                              
                             <div style="padding: 10px 10px;text-align: center;font-size: 15px;margin-top: 20px;">
                                <b>Có Thông Tin về Tài Sản cho thuê thấp Hơn Giá Trị Tổng Thể( Quy Mô TS)</b>

                             </div>
                             <div style="text-align: center;"><a href="{{route('admin.error5')}}" >Xem chi tiết</a></div>
                            </div>
                          </div>
                        </div>
                       </div>
                </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
  </div>
@endsection