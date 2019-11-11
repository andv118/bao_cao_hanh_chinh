@extends('master')

@section('content')

<div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Lịch sử hoạt động</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-history"></i> LỊCH SỬ HOẠT ĐỘNG</b></h3>
                        </div>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                           
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                               <thead>
                                    <tr>
                                        <th colspan="1" style="text-align: center;">STT</th>
                                        <th colspan="1" style="text-align: center;">Mã cán bộ</th>
                                        <th colspan="1" style="text-align: center;">Tên cán bộ</th>
                                        <th colspan="1" style="text-align: center;">Hoạt động</th>
                                        <th colspan="1" style="text-align: center;">Thời gian</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt = 0; ?>
                                    @foreach($data as $v)
                                    <tr>
                                       <td style="text-align: center;">{{$stt+=1}}</td>
                                       <td style="text-align: center;">{{$v->code}}</td>
                                       <td style="text-align: center;">{{$v->name}}</td>
                                       <td style="text-align: center;">{{$v->action}}</td>
                                       <td style="text-align: center;"><span>{{$v->created_at}}</span></td>   
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                <div class="pull-right pagination">
                                   {{$data->links()}}
                                </div>
                        </div>
                       
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
@endsection