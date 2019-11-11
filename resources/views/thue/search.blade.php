@extends('master')

@section('content')
<script>
    function checkValidate() {
        //Tiến hành lấy dữ liệu trên Form
        var keyword = document.getElementById("keyword").value;
        var status = false;
       
            if (keyword == "") {
                document.getElementById("keyword").style.borderColor = "red";
                document.getElementById("keyword").style.display = "block";
                document.getElementById("lbkeyword").innerHTML = "Hãy nhập từ khóa tìm kiếm";
                status = true;
            }else{

                document.getElementById("keyword").style.borderColor = "#D8D8D8";
                document.getElementById("lbkeyword").style.display = "none";

            } 

             

            if (status == true) {
                //alert(msg);
                return false;
            } else {
                return true;
            }    
    }

   
</script>
 <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/ Tìm kiếm hợp đồng kê khai thuế</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;margin: 30px 0;"><b><i class="fa fa-search"></i> TÌM KIẾM HỢP ĐỒNG KÊ KHAI THUẾ </b></h3>
                        </div>
                        <form action="{{route('admin.export_search_tax')}}" method="post">
                            @csrf
                            <input type="hidden" name="select" value="{{$select}}">
                            <input type="hidden" name="keyword" value="{{$key}}">
                           <button type="submit" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</button>
                        </form>
                        <form action="{{route('admin.search_tax')}}" onsubmit="return checkValidate();" method="post" class="form-search" style="margin: 10px 0;">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="text" placeholder="Tìm kiếm hợp đồng kê khai thuế" id="keyword" name="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
                            <span><button type="submit" class="btn btn-danger" id="search"><i class="fa fa-search"></i></button></span>
                            <div style="color: red;width: 200px;" id="lbkeyword"></div>
                             @if(Session::has('loi'))
                            <div style="color: red;"><b>{{Session::get('loi')}}</b></div>
                            @endif
                            <div style="margin-left: 20px;margin-bottom: 20px;width: 200px;">
                              <marquee width="300">
                                <b>Chọn từ khóa để tìm kiếm</b>
                               </marquee>
                            </div>
                              <div class="radio">
                                  <label><input type="radio" value="1" name="select" required>Mã số thuế</label>
                              </div>
                              <div class="radio">
                                  <label><input type="radio" value="2" name="select" required>Mã tài sản</label>
                              </div>
                              <div class="radio">
                                  <label><input type="radio" value="3" name="select" required>Mã hợp đồng</label>
                              </div>
                              <div class="radio">
                                  <label><input type="radio" value="4" name="select" required>Tên chủ nhà</label>
                              </div>       
                        </form>
                       
                        <div class="fixed-table-body table-responsive">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <h4><b><i class="fa fa-search-plus"></i> Kết quả tìm kiếm : <span style="color: red;">{{count($data)}}</span></b></h4>
                                <table data-toggle="table" class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action">
                                <thead style="display: block;">
                                    <tr>
                                        <th class="ver1" style="position: sticky;top: 0;z-index: 10;" rowspan="4">STT</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" colspan="4" rowspan="2" style="text-align: center;">Chi tiết hợp đồng kê khai</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" colspan="5" rowspan="2" style="text-align: center;">Quản Lý Kê Khai Thuế</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" colspan="14"></th>
                                        
                                        
                                    </tr>
                                    <tr>
                                       
                                       
                                        <th style="position: sticky;top: 0;z-index: 10;" colspan="2" rowspan="2">Đăng Ký</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" colspan="6" style="text-align: center;">Kỳ kê khai </th>
                                        <th style="position: sticky;top: 0;z-index: 10;" colspan="4" rowspan="2" style="text-align: center;"> Số Đã Nộp</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" colspan="4" rowspan="3" style="text-align: center;"> Nợ thuế</th>
                                        
                                    </tr>
                                    <tr>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Mã Số Thuế</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Tên Chủ Nhà</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Mã tài sản </th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Mã Hợp đồng </th>
                                        
                                        <th style="position: sticky;top: 0;z-index: 10;" colspan="3">Kỳ kê khai</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Ngày nộp TK</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Hạn nộp TK</th>
                                        
                                        
                                        <th style="position: sticky;top: 0;z-index: 10;" colspan="2">Kỳ chưa kê khai</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2"> Tổng doanh thu hợp đồng chưa thuế (theo tháng)</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Tổng Thuế</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Thuế giá trị gia tăng </th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Thuế thu nhập cá nhân</th>
                                    
                                        
                                    </tr>
                                    <tr>
                                         
                                         
                                        <th style="position: sticky;top: 0;z-index: 10;">Quý</th>
                                        <th style="position: sticky;top: 0;z-index: 10;">Năm</th>
                                        <th style="position: sticky;top: 0;z-index: 10;">Từ Ngày Đến Ngày</th>
                                        
                                        <th style="position: sticky;top: 0;z-index: 10;">Quý</th>
                                        <th style="position: sticky;top: 0;z-index: 10;">Năm</th>
                                        <th style="position: sticky;top: 0;z-index: 10;">Quý</th>
                                        <th style="position: sticky;top: 0;z-index: 10;">Năm</th>
                                        
                                        <th style="position: sticky;top: 0;z-index: 10;">Số Tiền</th>
                                        <th style="position: sticky;top: 0;z-index: 10;">Thuế giá trị gia tăng </th>
                                        <th style="position: sticky;top: 0;z-index: 10;">Thuế thu nhập cá nhân</th>
                                        <th style="position: sticky;top: 0;z-index: 10;">Ngày Nộp tiền </th>
                                        
                                    </tr>
                                </thead>
                                <tbody style="display: block;overflow: auto;max-height: 600px;">
                                    <?php $stt=0; ?>
                                    @foreach($data as $v)
                                    <tr>
                                        <td class="ver1"><b><?php $stt+=1; echo $stt; ?></b></td>
                                        <td style="text-align:center;">{{$v->tax_code}}</td>
                                        <td style="text-align:center;">{{$v->fullname}}</td>
                                        <td style="text-align:center;">{{$v->property_code}}</td>
                                        <td style="text-align:center;">{{$v->contract_code}}</td>
                                        <td style="text-align:center;">{{$v->precious}}</td>
                                        <td style="text-align:center;">{{$v->year}}</td>
                                        <td style="text-align:center;">{{$v->from_to}}</td>
                                        <td style="text-align:center;">{{date("d/m/Y",strtotime($v->submit_date))}}</td>
                                        <td style="text-align:center;">{{date("d/m/Y",strtotime($v->deadline))}}</td>
                                        @if($v->register==1)
                                        <td style="text-align:center;"><input type="checkbox" checked></td>
                                        <td style="text-align:center;"></td>
                                        @elseif($v->register==2)
                                        <td style="text-align:center;"></td>
                                        <td style="text-align:center;"><input type="checkbox" checked></td>
                                        @endif
                                        <td style="text-align:center;">{{$v->precious_undeclare}}</td>
                                        <td style="text-align:center;">{{$v->year_undeclare}}</td>
                                        <td style="text-align:center;">{{number_format($v->price_contract)}}</td>
                                        <td style="text-align:center;">{{number_format($v->total_tax)}}</td>
                                        <td style="text-align:center;">{{number_format($v->total_tax/2)}}</td>
                                        <td style="text-align:center;">{{number_format($v->total_tax/2)}}</td>
                                        <td style="text-align:center;">{{number_format($v->payed)}}</td>
                                        <td style="text-align:center;">{{number_format($v->payed/2)}}</td>
                                        <td style="text-align:center;">{{number_format($v->payed/2)}}</td>
                                        <td style="text-align:center;">{{date("d/m/Y",strtotime($v->payed_date))}}</td>
                                        <td style="text-align:center;">{{number_format($v->difference)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>  
                        <div class="pull-right pagination">
                          {{$data->links()}}
                        </div>               
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

        </div>
@endsection
