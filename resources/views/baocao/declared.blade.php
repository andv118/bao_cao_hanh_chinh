 @extends('master')

@section('content')
  <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Báo cáo</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                        	<h3 style="text-align: center;"><b>Hợp Đồng Đã Nộp Thuế</b></h3>
                        </div>
                        <div class="fixed-table-body" style="margin-top: 30px;">
                            <a style="margin-bottom: 20px;" href="{{route('admin.export_declared')}}" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</a>
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action">
                                <thead >
                                    <tr>
                                        <th style="text-align: center;">STT</th>
                                        <th style="text-align: center;">Mã Hợp Đồng</th>
                                        <th style="text-align: center;">Mã Số Thuế</th>
                                        <th style="text-align: center;">Mã Tài Sản</th>
                                        <th style="text-align: center;">Tên Chủ Nhà</th>
                                        <th style="text-align: center;">Quý/Năm</th>
                                        <th style="text-align: center;">Ngày Nộp Tiền</th>
                                        <th style="text-align: center;">Số Tiền Nộp</th>
                                        <th style="text-align: center;">Nợ</th>
                                                         
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt = 0; ?>
                                    @foreach($data as $v)
                                    <tr>
                                        <td style="text-align: center;"><?php $stt+=1; echo $stt; ?></td>
                                        <td style="text-align: center;">{{$v->id_contractcode}}</td>
                                        <td style="text-align: center;">{{$v->tax_code}}</td>
                                        <td style="text-align: center;">{{$v->property_code}}</td>
                                        <td style="text-align: center;">{{$v->fullname}}</td>
                                        @if($v->register==1)
                                        <td style="text-align: center;">{{$v->precious}}</td>
                                        @elseif($v->register==2)
                                        <td style="text-align: center;">{{date("d/m/Y",strtotime($v->year))}}</td>
                                        @endif
                                        <td style="text-align: center;"><b style="color: red;">{{date("d/m/Y",strtotime($v->payed_date))}}</b></td>
                                        <td style="text-align: center;">{{number_format($v->payed)}}</td>
                                        <td style="text-align: center;">{{number_format($v->difference)}}</td> 
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