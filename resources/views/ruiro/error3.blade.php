 @extends('master')

@section('content')
  <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Quản lý rủi ro</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                        	<h3 style="text-align: center;"><b>Hợp Đồng Có 
                        		Tổng Giá Trị Thuê Theo Tháng Thấp Hơn 
                        	Với Giá Trị Tài Sản Thực Tế Theo Thông Tin</b></h3>
                        </div>
                       
                        <div class="fixed-table-body" style="margin-top: 30px;">
                             <a style="margin-bottom: 20px;" href="{{route('admin.export_error3')}}" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</a>
                            
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action">
                                <thead >
                                    <tr>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">STT</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Mã Số Thuế</th>
                                        <th colspan="1"  rowspan="2" style="text-align: center;">Mã Tài Sản</th>
                                        <th  colspan="1"  rowspan="2" style="text-align: center;">Tên Chủ Nhà</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Đoạn Đường </th>
                                        <th colspan="1"  rowspan="2" style="text-align: center;">Tuyến Phố </th>
                                        <th  colspan="1" rowspan="2" style="text-align: center;">Vị Trí</th>
                                        <th  colspan="1" rowspan="2" style="text-align: center;">Loại Nhà</th>
                                        <th colspan="2" style="text-align: center;">Quy Mô Tổng Thể</th>
                                        <th colspan="2" style="text-align: center;">Thực Tế Cho Thuê</th>
                                        <th colspan="2" style="text-align: center;">Tổng giá trị tài sản dự kiến</th>
                                        <th colspan="1" rowspan="2" style="text-align: center;">Giá trị thực tế cho thuê/tháng (theo hợp đồng)</th>
                                       
                                    </tr>
                                    <tr>
                                        
                                        <th style="text-align: center;">Số Tầng</th>
                                        <th style="text-align: center;">Diện Tích</th>
                                        <th style="text-align: center;">Số Tầng</th>
                                        <th style="text-align: center;">Diện Tích</th>
                                        <th style="text-align: center;">Giá cho thuê tổng thể tham chiếu/tháng</th>
                                        <th style="text-align: center;">Giá cho thuê thực tế tham chiếu/tháng</th>         
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt = 0; ?>
                                    @foreach($data as $v)
                                    <tr>
                                        <td style="text-align: center;"><?php $stt += 1; echo $stt; ?></td>
                                        <td style="text-align: center;">{{$v->tax_code}}</td>
                                        <td style="text-align: center;">{{$v->code}}</td>
                                        <td style="text-align: center;">{{$v->fullname}}</td>
                                        <td style="text-align: center;">{{$v->street}}</td>
                                        <td style="text-align: center;">{{$v->road}}</td>
                                        <td style="text-align: center;">{{$v->location}}</td>
                                        <td style="text-align: center;">{{$v->house_type}}</td>
                                        <td style="text-align: center;">{{$v->total_floor}}</td>
                                        <td style="text-align: center;">{{$v->total_area}}</td>
                                        <td style="text-align: center;">{{$v->rent_floor}}</td>
                                        <td style="text-align: center;">{{$v->rent_area}}</td>
                                        <td style="text-align: center;">{{number_format($v->total_value)}}</td>
                                        <td style="text-align: center;">{{number_format($v->real_value)}}</td>
                                        <td style="text-align: center;">{{number_format($v->real_price_contract)}}</td>
                                    
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           
                        </div>  
                        <div class="pull-right pagination">
                          
                        </div>
                        <a href="{{route('admin.manage_error')}}" class="btn btn-success"><i class="fa fa-undo-alt"></i> Quay lại</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
  </div>
@endsection