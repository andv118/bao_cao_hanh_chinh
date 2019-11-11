@extends('master')

@section('content')
 <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Báo cáo</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;"><b>HỢP ĐỒNG CÓ KỲ KHAI THUẾ CẦN PHẢI NỘP</b> </h3>
                        </div>
                        <div class="fixed-table-body">
                            <a style="margin-bottom: 20px;" href="{{route('admin.export_period')}}" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</a>
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive able-striped jambo_table bulk_action">
                                 <thead>
                                    <tr>
                                        <th rowspan="3" style="padding-bottom: 20px;text-align: center;">STT</th>
                                        <th rowspan="3" style="padding-bottom: 20px;text-align: center;">Tên người nộp thuế</th>
                                        <th rowspan="3" style="padding-bottom: 20px;text-align: center;">Mã số thuế người nộp thuế</th>
                                        <th rowspan="3" style="padding-bottom: 20px;text-align: center;">Địa chỉ liên hệ</th>
                                        <th rowspan="3" style="padding-bottom: 20px;text-align: center;">Mã hợp đồng</th>
                                        <th rowspan="3" style="padding-bottom: 20px;text-align: center;">Kỳ khai thuế (Quý/Năm)</th>
                                        <th rowspan="3" style="padding-bottom: 20px;text-align: center;">Hạn nộp HSKT (Quý/Năm)</th>
                                        <th rowspan="3" style="padding-bottom: 20px;text-align: center;">Số thuế GTGT dự kiến</th>
                                        <th rowspan="3" style="padding-bottom: 20px;text-align: center;">Số thuế TNCN dự kiến</th>
                                        
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                     <?php $stt=0; ?>
                                    @foreach($data as $v)
                                    <tr>
                                        <td style="text-align: center;"><?php $stt+=1; echo $stt; ?></td>
                                        <td style="text-align: center;">{{$v->fullname}}</td>
                                        <td style="text-align: center;">{{$v->tax_code}}</td>
                                        <td style="text-align: center;">{{$v->address}}</td>
                                        <td style="text-align: center;">{{$v->contract_code}}</td>
                                        @if($v->register==1)
                                        <td style="text-align: center;">{{$v->precious}}</td>
                                        @elseif($v->register==2)
                                        <td style="text-align: center;">{{date("d/m/Y",strtotime($v->year))}}</td>
                                        @endif
                                        <td style="text-align: center;">{{date("d/m/Y",strtotime($v->deadline))}}</td>
                                        <td style="text-align: center;">{{number_format($v->total_tax/2)}}</td>
                                        <td style="text-align: center;">{{number_format($v->total_tax/2)}}</td>
                                        
                                    </tr> 
                                     @endforeach
                                </tbody>
                            </table>
                                <div class="pull-right pagination">
                                   
                                </div>
                                <a href="{{route('admin.report_total')}}" class="btn btn-success"><i class="fa fa-undo-alt"></i> Quay lại</a>
                        </div>
                       
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

@endsection