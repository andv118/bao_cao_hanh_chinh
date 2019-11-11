 @extends('master')

@section('content')
  <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Quản lý rủi ro</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                        	<h3 style="text-align: center;"><b>Hợp Đồng Kê Khai Thuế Quá Hạn</b></h3>
                        </div>
                        <div class="fixed-table-body" style="margin-top: 30px;">
                            <a style="margin-bottom: 20px;" href="{{route('admin.export_submit_outtime')}}" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</a>
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action">
                                <thead >
                                    <tr>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">STT</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Mã Hợp Đồng</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Kỳ Kê Khai Thuế</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Từ Ngày Đến Ngày</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Hạn Kê Khai Thuế</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;">Ngày Nộp Tờ Khai</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt = 0; ?>
                                    @foreach($data as $v)
                                    <tr>
                                        <td style="text-align: center;"><?php $stt+=1; echo $stt; ?></td>
                                        <td style="text-align: center;">{{$v->id_contractcode}}</td>
                                        @if($v->register==1)
                                        <td style="text-align: center;">{{$v->precious}}</td>
                                        @elseif($v->register==2)
                                        <td style="text-align: center;">{{$v->year}}</td>
                                        @endif
                                        <td style="text-align: center;">{{$v->from_to}}</td>
                                        <td style="text-align: center;"><b style="color: red;">{{date("d/m/Y",strtotime($v->deadline))}}</b></td> 
                                        <td style="text-align: center;"><b style="color: red;">{{date("d/m/Y",strtotime($v->payed_date))}}</b></td>
                                        
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