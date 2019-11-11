@extends('master')

@section('content')
 <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Báo cáo</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;"><b>HỢP ĐỒNG CÒN NỢ THUẾ</b> </h3>
                        </div>
                        <div class="fixed-table-body">
                            <a style="margin-bottom: 20px;" href="{{route('admin.export_tax_debt')}}" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</a>
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive able-striped jambo_table bulk_action">
                                 <thead>
                                    <tr>
                                        <th rowspan="3" style="padding-bottom: 20px;text-align: center;">STT</th>
                                        <th rowspan="3" style="padding-bottom: 20px;text-align: center;">Mã hợp đồng</th>
                                      
                                        <th rowspan="3" style="padding-bottom: 20px;text-align: center;">Tổng thuế đã đóng</th>
                                        <th rowspan="3" style="padding-bottom: 20px;text-align: center;">Tổng thuế còn nợ</th>
                                        
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                     <?php $stt=0; ?>
                                    @foreach($data as $v)
                                    <tr>
                                        <td style="text-align: center;"><?php $stt+=1; echo $stt; ?></td>
                                        <td style="text-align: center;">{{$v->id_contractcode}}</td>
                                        <td style="text-align: center;">{{number_format($v->total)}}</td>
                                        <td style="text-align: center;">{{number_format($v->debt)}}</td>
                                        
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