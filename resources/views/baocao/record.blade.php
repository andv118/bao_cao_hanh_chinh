@extends('master')

@section('content')
 <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Báo cáo/Báo cáo ghi thu</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;"><b>BÁO CÁO GHI THU</b> </h3>
                        </div>
                        <a style="margin-bottom: 20px;" href="{{route('admin.export_record')}}" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</a>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive able-striped jambo_table bulk_action">
                                <thead>
                                    <tr>
                                        <th >STT</th>
                                        <th>MST</th>
                                        <th>Họ và tên</th>
                                        <th>Địa chỉ</th>
                                        <th>Kỳ kê khai</th>
                                        <th>Từ ngày đến ngày</th>
                                        <th>Tổng thuế</th>
                                        <th>Thuế GTGT</th>
                                        <th>Thuế TNCN</th>
                                        <th>Phí và Lệ Phí MB</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                   
                                </thead>
                                <tbody>
                                    <?php $stt=0; ?>
                                    @foreach($data as $v)
                                    <tr>
                                        <td><?php $stt+=1; echo $stt; ?></td>
                                        <td>{{$v->tax_code}}</td>
                                        <td>{{$v->fullname}}</td>
                                        <td>{{$v->address}}</td>
                                        @if($v->register==1)
                                        <td style="text-align: center;">{{$v->precious}}</td>
                                        @elseif($v->register==2)
                                        <td style="text-align: center;">{{$v->year}}</td>
                                        @endif
                                        <td>{{$v->from_to}}</td>
                                        <td>{{number_format($v->total_tax)}}</td>
                                        <td>{{number_format($v->total_tax/2)}}</td>
                                        <td>{{number_format($v->total_tax/2)}}</td>
                                        <td>300,000</td>
                                        <td>Chi cục Thuế Tây Hồ</td>
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