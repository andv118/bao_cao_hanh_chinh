@extends('master')

@section('content')
 <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Báo cáo/Báo cáo rủi ro</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;"><b>BÁO CÁO RỦI RO</b> </h3>
                        </div>
                        <a style="margin-bottom: 20px;" href="{{route('admin.export_error')}}" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</a>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive able-striped jambo_table bulk_action">
                                <thead>
                                    <tr>
                                        <th rowspan="2">STT</th>
                                        <th rowspan="2">Tên cá nhân cho thuê tài sản</th>
                                        <th rowspan="3">MST cá nhân cho thuê tài sản</th>
                                        <th rowspan="2">Mã số thuế bên thuê tài sản (nếu có)</th>
                                        <th colspan="2">Loại tài sản</th>
                                        <th rowspan="2">Địa chỉ tài sản cho thuê/ kinh doanh</th>
                                        <th rowspan="2">Mã số quản lý hợp đồng</th>
                                        <th rowspan="2">Kỳ tính thuế</th>
                                        <th rowspan="2">Hạn nộp</th>
                                        <th rowspan="2">Số ngày quá hạn</th>
                                        <th rowspan="2">Doanh thu năm</th>
                                        <th rowspan="2">Mục đích sử dụng tài sản thuê</th>
                                        <th rowspan="2">Bên thuê có đầu tư xây dựng cơ bản</th>
                                        <th rowspan="2">Diện tích sàn cho thuê</th>
                                        <th rowspan="2">Giá cho thuê 1 tháng đã bao gồm thuế (vnđ)</th>
                                        <th rowspan="2">Ghi chú</th>
                                    </tr>
                                    <tr>
                                        
                                        <th>Bất động sản </th>
                                        <th>Động sản</th>
                                     
                                    </tr>
                                   
                                </thead>
                                <tbody>
                                    <?php $stt=0; ?>
                                    @foreach($data as $v)
                                    <tr>
                                        <td><?php $stt+=1; echo $stt; ?></td>
                                        <td>{{$v->fullname}}</td>
                                        <td>{{$v->tax_code}}</td>
                                        <td></td>
                                        <td><input type="checkbox" checked></td>
                                        <td></td>
                                        <td>{{$v->address}}</td>
                                        <td>{{$v->contract_code}}</td>
                                        @if($v->register==1)
                                        <td>{{$v->precious_declare}}</td>
                                        @elseif($v->register==2)
                                        <td>{{$v->year_declare}}</td>
                                        @endif
                                        <td>{{date("d/m/Y",strtotime($v->deadline))}}</td>
                                        <td>{{-$v->ontime}}</td>
                                        <td>{{$v->payment_year}}</td>
                                        <td>{{$v->method}}</td>
                                        <td>Có</td>
                                        <td>{{$v->area}}</td>
                                        <td>{{number_format($v->cost_month)}}</td>
                                        <td></td>
                                    </tr> 
                                   @endforeach
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