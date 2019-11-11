@extends('master')

@section('content')
 <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Báo cáo/Báo cáo dự kiến</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;"><b>BÁO CÁO DỰ KIẾN</b> </h3>
                        </div>
                        <a style="margin-bottom: 20px;" href="{{route('admin.export_submit')}}" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</a>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive able-striped jambo_table bulk_action">
                               <thead>
                                    <tr>
                                        <th rowspan="2">STT</th>
                                        <th colspan="3" style="text-align:center;">Thông tin người nộp thuế</th>
                                        <th colspan="3" style="text-align:center;">Thông tin tổ chức khai thay (nếu có)</th>
                                        <th rowspan="2">Hợp đồng kê khai thuế</th>
                                        <th rowspan="2">Kỳ khai thuế (Quý/Năm)</th>
                                        <th rowspan="2">Số lượng hợp đồng dự kiến phải khai thuế </th>
                                        <th rowspan="2">Hạn nộp hồ sơ khai thuế (Quý/Năm)</th>
                                        <th rowspan="2">Số thuế GTGT dự kiến</th>
                                        <th rowspan="2">Số thuế TNCN dự kiến</th>
                                    </tr>
                                    <tr>
                                        
                                        <th>Tên </th>
                                        <th>MST</th>
                                        
                                        <th>Địa chỉ liên hệ</th>
                                        <th>Tên </th>
                                        <th>MST</th>
                                        <th>Địa chỉ liên hệ</th>
                                        
                                    </tr>
                                   
                                </thead>
                                <tbody>
                                    <?php $stt=0; ?>
                                    @foreach($data as $v)
                                    <tr>
                                        <td style="text-align:center;"><?php $stt+=1; echo $stt; ?></td>
                                        <td style="text-align:center;">{{$v->fullname}}</td>
                                        <td style="text-align:center;">{{$v->tax_code}}</td>
                                        <td style="text-align:center;">{{$v->address}}</td>
                                        <td style="text-align:center;"></td>
                                        <td style="text-align:center;"></td>
                                        <td style="text-align:center;"></td>
                                        <td style="text-align:center;">{{$v->contract_code}}</td>
                                         @if($v->register==1)
                                        <td style="text-align: center;">{{$v->precious}}</td>
                                        @elseif($v->register==2)
                                        <td style="text-align: center;">{{date("d/m/Y",strtotime($v->year))}}</td>
                                        @endif
                                        <td style="text-align:center;">1</td>
                                        <td style="text-align:center;">{{date("d/m/Y",strtotime($v->deadline))}}</td>
                                        <td style="text-align:center;">{{number_format($v->total_tax/2)}}</td>
                                        <td style="text-align:center;">{{number_format($v->total_tax/2)}}</td>
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