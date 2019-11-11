 @extends('master')

@section('content')
  <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Quản lý rủi ro</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                        	<h3 style="text-align: center;"><b>Sai Lệch Về Giá trên hợp đồng so với dữ liệu quản lý thuế</b></h3>
                        </div>
                         <a href="{{route('admin.export_error1')}}" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</a>
                        <div class="fixed-table-body" style="margin-top: 30px;">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action">
                                <thead >
                                    <tr>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">STT</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Tên chủ nhà</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Mã số thuế</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Mã tài sản</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Mã Hợp Đồng</th>
                                        <th colspan="1"  rowspan="2" style="text-align: center;">Giá Trên Hợp Đồng Gốc Thu Thập</th>
                                        <th  colspan="1"  rowspan="2" style="text-align: center;">Giá Trên Hợp Đồng Kê Khai Thuế</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt = 0; ?>
                                    @foreach($data as $v)
                                    <tr>
                                        <td style="text-align: center;"><?php $stt += 1; echo $stt; ?></td>
                                        <td style="text-align: center;">{{$v->fullname}}</td>
                                        <td style="text-align: center;">{{$v->tax_code}}</td>
                                        <td style="text-align: center;">{{$v->property_code}}</td>
                                        <td style="text-align: center;">{{$v->contract_code}}</td>
                                        <td style="text-align: center;"><b style="color:red;">{{number_format($v->total_cost)}}</b></td>
                                        <td style="text-align: center;"><b style="color:red;">{{number_format($v->price_contract)}}</b></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           
                        </div>  
                        <div class="pull-right pagination">
                           {{$data->links()}}
                        </div>
                         <a href="{{route('admin.manage_error')}}" class="btn btn-success"><i class="fa fa-undo-alt"></i> Quay lại</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
  </div>
@endsection