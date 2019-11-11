 @extends('master')

@section('content')
  <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Báo cáo</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                        	<h3 style="text-align: center;"><b>Hợp Đồng Phải Nộp Thuế</b></h3>
                        </div>
                        <div class="fixed-table-body" style="margin-top: 30px;">
                            <a style="margin-bottom: 20px;" href="{{route('admin.export_declare')}}" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</a>
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action">
                                <thead >
                                    <tr>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">STT</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Mã Hợp Đồng</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Mã Số Thuế</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Mã Tài Sản</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Tên Chủ Nhà</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Giá hợp đồng theo tháng</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Giá hợp đồng theo năm</th>                                 
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt = 0; ?>
                                    @foreach($data as $v)
                                    <tr>
                                        <td style="text-align: center;"><?php $stt+=1; echo $stt; ?></td>
                                        <td style="text-align: center;">{{$v->contract_code}}</td>
                                        <td style="text-align: center;">{{$v->tax_code}}</td>
                                        <td style="text-align: center;">{{$v->property_code}}</td>
                                        <td style="text-align: center;">{{$v->fullname}}</td>
                                        <td style="text-align: center;">{{number_format($v->total_cost)}}</td>
                                        <td style="text-align: center;"><b style="color: red;">{{number_format($v->payment_year)}}</b></td>
                                        
                                    </tr>
                                    @endforeach                                   
                                </tbody>
                            </table>
                           
                        </div>  
                        <div class="pull-right pagination">
                          
                        </div>
                        <a href="{{route('admin.report_total')}}" class="btn btn-success"><i class="fa fa-undo-alt"></i> Quay lại</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
  </div>
@endsection