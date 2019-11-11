@extends('master')

@section('content')
 <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Báo cáo/Báo cáo tổng hợp</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;margin: 30px 0;"><b>BÁO CÁO TỔNG HỢP</b></h3>
                        </div>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <table data-toggle="table" class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action">
                                <thead>
                                    <tr>
                                        <th colspan="3" style="text-align: center;">Kê khai</th>
                                        <th colspan="4" style="text-align: center;">Nộp thuế</th>
                                        <th colspan="2" style="text-align: center;">Nợ thuế</th>
                                        <th colspan="5" style="text-align: center;">Rủi ro</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2" style="text-align: center;">Chưa kê khai</th>
                                        <th colspan="2" style="text-align: center;">Đã Kê Khai</th>
                                        <th rowspan="2">Phải nộp</th>
                                        
                                        <th rowspan="2" style="text-align: center;">Đã Nộp </th>
                                        <th rowspan="2" style="text-align: center;">Đúng Hạn</th>
                                        <th rowspan="2" style="text-align: center;">Quá Hạn</th>
                                        <th rowspan="2" style="text-align: center;">Kỳ thuế</th>
                                        <th rowspan="2" style="text-align: center;">Tổng Nợ</th>
                                        <th rowspan="2" style="text-align: center;"> Rủi ro 1 (<span style="color: red;">*</span>)</th>
                                        <th rowspan="2" style="text-align: center;"> Rủi ro 2 (<span style="color: red;">*</span>)</th>
                                        <th rowspan="2" style="text-align: center;"> Rủi ro 3 (<span style="color: red;">*</span>)</th>
                                        <th rowspan="2" style="text-align: center;"> Rủi ro 4 (<span style="color: red;">*</span>)</th>
                                        <th rowspan="2" style="text-align: center;"> Rủi ro 5 (<span style="color: red;">*</span>)</th>
                                    </tr>
                                    <tr>
                                       
                                        <th>Đúng hạn </th>
                                        <th>Quá hạn</th>
                                      
                                    </tr>
                                   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3 style="text-align: center;"><b>{{$baocaophainop}}</b></h3>
                                            <a href="{{route('admin.error2')}}" style="text-align: center;">Xem chi tiết</a>
                                        </td>
                                        <td>
                                            <h3 style="text-align: center;"><b>{{$baocaodunghan}}</b></h3>
                                            <a href="{{route('admin.declare_ontime')}}" style="text-align: center;">Xem chi tiết</a>
                                        </td>
                                        <td>
                                            <h3 style="text-align: center;"><b>{{$baocaoquahan}}</b></h3>
                                            <a href="{{route('admin.declare_outtime')}}" style="text-align: center;">Xem chi tiết</a>
                                        </td>
                                        <td>
                                            <h3 style="text-align: center;"><b>{{$baocaophainop2}}</b></h3>
                                            <a href="{{route('admin.declare')}}" style="text-align: center;">Xem chi tiết</a>
                                        </td>
                                        <td>
                                            <h3 style="text-align: center;"><b>{{$baocaodakekhai}}</b></h3>
                                            <a href="{{route('admin.declared')}}" style="text-align: center;">Xem chi tiết</a>
                                        </td>
                                        <td>
                                            <h3 style="text-align: center;"><b>{{$baocaokekhaidunghan}}</b></h3>
                                            <a href="{{route('admin.submit_ontime')}}" style="text-align: center;">Xem chi tiết</a>
                                        </td>
                                        <td>
                                            <h3 style="text-align: center;"><b>{{$baocaokekhaiquahan}}</b></h3>
                                            <a href="{{route('admin.submit_outtime')}}" style="text-align: center;">Xem chi tiết</a>
                                        </td>
                                        <td>
                                            <h3 style="text-align: center;"><b>{{$baocaokythue}}</b></h3>
                                            <a href="{{route('admin.period')}}" style="text-align: center;">Xem chi tiết</a>
                                        </td>
                                        <td>
                                            <h3 style="text-align: center;"><b>{{$baocaonothue}}</b></h3>
                                            <a href="{{route('admin.tax_debt')}}" style="text-align: center;">Xem chi tiết</a>
                                        </td>
                                        <td>
                                            <h3 style="text-align: center;"><b>{{$err5}}</b></h3>
                                            <a href="{{route('admin.error1')}}" style="text-align: center;">Xem chi tiết</a>
                                        </td>
                                        <td>
                                            <h3 style="text-align: center;"><b>{{$err4}}</b></h3>
                                            <a href="{{route('admin.error2')}}" style="text-align: center;">Xem chi tiết</a>
                                        </td>
                                        <td>
                                            <h3 style="text-align: center;"><b>{{$err3}}</b></h3>
                                            <a href="{{route('admin.error3')}}" style="text-align: center;">Xem chi tiết</a>
                                        </td>
                                        <td>
                                            <h3 style="text-align: center;"><b>{{$err1}}</b></h3>
                                            <a href="{{route('admin.error4')}}" style="text-align: center;">Xem chi tiết</a>
                                        </td>
                                        <td>
                                            <h3 style="text-align: center;"><b>{{$err2}}</b></h3>
                                            <a href="{{route('admin.error5')}}" style="text-align: center;">Xem chi tiết</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>  
                        <div class="pull-right pagination">
                            
                        </div>               
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

        </div>
@endsection