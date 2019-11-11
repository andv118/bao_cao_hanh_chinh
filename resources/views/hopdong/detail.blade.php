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
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Danh sách hợp đồng</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;"><b><i class="fa fa-list-alt"></i> DANH SÁCH HỢP ĐỒNG</b>(<span style="color: red;"><b>{{$dem}}</b></span>)</h3>
                        </div>

                         <a href="{{route('admin.export_contract')}}" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</a>

                         <form action="{{route('admin.search_contract')}}" onsubmit="return checkValidate();" method="post" class="form-search" style="margin: 10px 0;">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="text" placeholder="Tìm kiếm hợp đồng" id="keyword" name="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
                            <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
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
                            <table class="table table-hover table-bordered table-striped jambo_table bulk_action table-style" style="position: relative;">
                                <thead style="display: block;">
                                    <tr style="text-align: center;">
                                        <th  class="ver1"   colspan="1" rowspan="2" style="position: sticky;top: 0;z-index: 10;">STT</th>
                                        <th    colspan="1" rowspan="2" style="position: sticky;top: 0;z-index: 10;">Mã Số Thuế</th>
                                        <th    colspan="1" rowspan="2" style="position: sticky;top: 0;z-index: 10;">Tên Chủ Nhà</th>
                                        <th    colspan="1" rowspan="2" style="position: sticky;top: 0;z-index: 10;">Mã Tài Sản</th>
                                        <th    colspan="1" rowspan="2" style="position: sticky;top: 0;z-index: 10;">Mã Hợp Đồng</th>
                                        <th    colspan="1" rowspan="2" style="position: sticky;top: 0;z-index: 10;">Hình Thức</th>
                                        <th    colspan="2" style="position: sticky;top: 0;z-index: 10;">Khách Hàng Thuê</th>
                                        <th    colspan="3" style="position: sticky;top: 0;z-index: 10;">Nhà Thuê</th>
                                        <th    colspan="1" style="position: sticky;top: 0;z-index: 10;">Mục Đích Thuê</th>
                                        <th    colspan="2" style="position: sticky;top: 0;z-index: 10;">Thời Hạn Hợp Đồng</th>
                                        <th    colspan="2" style="position: sticky;top: 0;z-index: 10;">Kỳ Thanh Toán</th>
                                        <th    colspan="3" style="position: sticky;top: 0;z-index: 10;">Giá Thanh Toán</th>
                                        <th    colspan="2" style="position: sticky;top: 0;z-index: 10;">Giá đã có thuế ?</th>
                                        <th    colspan="1" rowspan="2" style="position: sticky;top: 0;z-index: 10;">Giá Trên Hợp Đồng</th>
                                        <th    colspan="1" rowspan="2" style="position: sticky;top: 0;z-index: 10;">Đơn Vị Tiền Tệ</th>
                                        <th    colspan="1" rowspan="2" style="position: sticky;top: 0;z-index: 10;">Giá Quy Đổi Theo Tháng Đã Có Thuế</th>
                                       
                                        <th    colspan="1" rowspan="2" style="position: sticky;top: 0;z-index: 10;">Đã thay đổi hợp đồng ?</th>
                                        <th    colspan="1" rowspan="2" style="position: sticky;top: 0;z-index: 10;">File đính kèm</th>
                                        <th    colspan="1" rowspan="2" style="position: sticky;top: 0;z-index: 10;">Cập Nhật</th>

                                    </tr>
                                    <tr style="text-align: center;">
                                       
                                        <th   style="position: sticky;top: 0;z-index: 10;">Tên</th>
                                        <th   style="position: sticky;top: 0;z-index: 10;">Điện Thoại</th>
                                        <th   style="position: sticky;top: 0;z-index: 10;">Diện Tích</th>
                                        <th   style="position: sticky;top: 0;z-index: 10;">Tầng</th>
                                        <th   style="position: sticky;top: 0;z-index: 10;">Phòng<th>
                                        <th  style="position: sticky;top: 0;z-index: 10;">Từ Ngày</th>
                                        <th   style="position: sticky;top: 0;z-index: 10;">Đến Ngày</th>
                                        <th   style="position: sticky;top: 0;z-index: 10;">Tháng</th>
                                        <th   style="position: sticky;top: 0;z-index: 10;">Năm</th>
                                        <th   style="position: sticky;top: 0;z-index: 10;">Tháng</th>
                                        <th   style="position: sticky;top: 0;z-index: 10;">Năm</th>
                                        <th   style="position: sticky;top: 0;z-index: 10;">Quý</th>
                                        <th   style="position: sticky;top: 0;z-index: 10;">Giá đã có thuế</th>
                                        <th   style="position: sticky;top: 0;z-index: 10;">Giá chưa có thuế</th>
                                        
                                    </tr>
                                </thead>
                                <tbody style="height: 500px;overflow: auto;width: 100%;display: block;">
                                    <?php $stt= 0; ?>
                                    @foreach($data2 as $v)
                                      <tr>
                                         <td class="ver1" style="text-align:center;font-size:14px;;"><?php $stt+=1; echo $stt; ?></td>
                                         <td style="text-align:center;font-size:14px;;">{{$v->tax_code}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{$v->fullname}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{$v->property_code}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{$v->contract_code}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{$v->method}}</td> 
                                         <td style="text-align:center;font-size:14px;;">{{$v->customer_name}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{$v->customer_phone}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{$v->area}}  m&sup2;</td>
                                         <td style="text-align:center;font-size:14px;;">{{$v->floor}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{$v->room}}</td>
                                         <td style="text-align: center;font-size: 14px;;">{{$v->purpose}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{$v->from}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{$v->to}}</td>
                                         @if($v->payment==0)
                                         <td style="text-align:center;font-size:14px;;"></td>
                                         <td style="text-align:center;font-size:14px;;"><input type="checkbox" checked></td>
                                         @elseif($v->payment!=0)
                                         <td style="text-align:center;font-size:14px;;">{{$v->payment}}/tháng lần</td>
                                         <td style="text-align:center;font-size:14px;;"></td>
                                         @endif
                                         <td style="text-align:center;font-size:14px;;">{{number_format($v->payment_month)}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{number_format($v->payment_year)}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{number_format($v->payment_precious)}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{number_format($v->tax_cost)}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{number_format($v->notax_cost)}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{number_format($v->total_cost)}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{$v->currency}}</td>
                                         <td style="text-align:center;font-size:14px;;">{{number_format($v->cost_month)}}</td>
                                         
                                         <td style="text-align:center;font-size:14px;;">
                                          @if($v->change!='0')
                                             {{$v->change}}
                                          @else
                                             {{'Chưa'}}
                                          @endif
                                         </td>
                                         <td style="text-align: center;">
                                            <a target="_blank" href="{{url('/public').'/contract/'.$v->file}}"><b>Click vào để download</b></a>
                                         </td>
                                         <td style="text-align:center;font-size:14px;"><a href="{{route('admin.update_contract',$v->id)}}" class="btn btn-warning" title="Cập Nhật Hợp Đồng"><i class="fa fa-edit"></i></a></td>
                                     </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                           
                        </div>  
                        <div class="pull-right pagination">
                          {{$data2->links()}}
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
  </div>
@endsection
