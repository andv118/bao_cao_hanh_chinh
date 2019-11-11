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
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Tìm kiếm tài sản</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;"><b><i class="fa fa-search"></i> TÌM KIẾM TÀI SẢN</b> </h3>
                        </div>
                         <form action="{{route('admin.export_search_property')}}" method="post">
                            @csrf
                            <input type="hidden" name="select" value="{{$select}}">
                            <input type="hidden" name="keyword" value="{{$key}}">
                           <button type="submit" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</button>
                         </form>
                         <form action="{{route('admin.search_property')}}" onsubmit="return checkValidate();" method="post" class="form-search" style="margin: 10px 0;">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="text" placeholder="Tìm kiếm tài sản" id="keyword" name="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
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
                                  <label><input type="radio" value="3" name="select" required>Tên chủ nhà</label>
                              </div>   
                        </form>
                        
                        <div class="fixed-table-body table-responsive">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            @if(count($data)>0)
                            <h4><b><i class="fas fa-search-plus"></i> Kết quả tìm kiếm : <span style="color: red;">{{count($data)}}</span></b></h4>
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive able-striped jambo_table bulk_action" >
                                <thead style="display: block;">
                                    <tr>
                                        <th  class="ver1" colspan="1" rowspan="2"  style="text-align: center;position: sticky;top: 0;z-index: 10;">STT</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;position: sticky;top: 0;z-index: 10;">Mã Số Thuế</th>
                                        <th colspan="1"  rowspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Mã Tài Sản</th>
                                        <th  colspan="1"  rowspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Tên Chủ Nhà</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;position: sticky;top: 0;z-index: 10;">Đoạn Đường </th>
                                        <th colspan="1"  rowspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Tuyến Phố </th>
                                        <th  colspan="1" rowspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Vị Trí</th>
                                        <th  colspan="1" rowspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Loại Nhà</th>
                                        <th colspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Quy Mô Tổng Thể</th>
                                        <th colspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Thực Tế Cho Thuê</th>
                                        <th colspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Tổng giá trị tài sản dự kiến</th>
                                        <th colspan="1" rowspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Giá trị thực tế cho thuê/tháng (theo hợp đồng)</th>
                                        <th class="ver1" colspan="3" style="text-align: center;position: sticky;top: 0;z-index: 10;">Hành động</th>

                                      
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;position: sticky;top: 0;z-index: 10;">Số Tầng</th>
                                        <th style="text-align: center;position: sticky;top: 0;z-index: 10;">Diện Tích Sàn</th>
                                        <th style="text-align: center;position: sticky;top: 0;z-index: 10;">Số Tầng</th>
                                        <th style="text-align: center;position: sticky;top: 0;z-index: 10;">Diện Tích Sàn</th>
                                        <th style="text-align: center;position: sticky;top: 0;z-index: 10;">Giá cho thuê tổng thể tham chiếu/tháng</th>
                                        <th style="text-align: center;position: sticky;top: 0;z-index: 10;">Giá cho thuê thực tế tham chiếu/tháng</th>         
                                        <th class="ver1" style="text-align: center;position: sticky;top: 0;z-index: 10;">Sửa</th>
                                        <th class="ver1" style="text-align: center;position: sticky;top: 0;z-index: 10;">Xóa</th>
                                        <th  style="text-align: center;position: sticky;top: 0;z-index: 10;">Kê khai hợp đồng</th>
                                    </tr>
                                </thead>
                                <tbody style="display: block;overflow: auto;max-height: 600px;">
                                    <?php $stt = 0; ?>
                                    @foreach($data as $v)
                                    <tr>
                                        <td class="ver1" style="text-align: center;"><?php $stt += 1; echo $stt; ?></td>
                                        <td style="text-align: center;">{{$v->tax_code}}</td>
                                        <td style="text-align: center;">{{$v->code}}</td>
                                        <td style="text-align: center;">{{$v->fullname}}</td>
                                        <td style="text-align: center;">{{$v->street}}</td>
                                        <td style="text-align: center;">{{$v->road}}</td>
                                        <td style="text-align: center;">{{$v->location}}</td>
                                        <td style="text-align: center;">{{$v->house_type}}</td>
                                        <td style="text-align: center;">{{$v->total_floor}}</td>
                                        <td style="text-align: center;">{{$v->total_area*$v->total_floor}}</td>
                                        <td style="text-align: center;">{{$v->rent_floor}}</td>
                                        <td style="text-align: center;">{{$v->rent_area*$v->rent_floor}}</td>
                                        <td style="text-align: center;">{{number_format($v->total_value)}}</td>
                                        <td style="text-align: center;">{{number_format($v->real_value)}}</td>
                                        <td style="text-align: center;">{{number_format($v->real_price_contract)}}</td>
                                        <td class="ver1"><a class="btn btn-warning" href="{{route('admin.update_property',$v->id)}}"><i class="fas fa-edit"></i></a></td>
                                        <td class="ver1"><a class="btn btn-danger" href="{{route('admin.delete_property',$v->id)}}"><i class="far fa-trash-alt"></i></a></td>
                                        <td style="text-align: center;"><a class="btn btn-success" href="{{route('admin.declare_contract',$v->id)}}"><i class="fa fa-share"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <h4><b><i class="fas fa-search-plus"></i> Kết quả tìm kiếm : <span style="color: red;">{{count($data)}}</span></b></h4>
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive able-striped jambo_table bulk_action" >
                                <thead style="display: block;">
                                    <tr>
                                        <th  class="ver1" colspan="1" rowspan="2"  style="text-align: center;position: sticky;top: 0;z-index: 10;">STT</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;position: sticky;top: 0;z-index: 10;">Mã Số Thuế</th>
                                        <th colspan="1"  rowspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Mã Tài Sản</th>
                                        <th  colspan="1"  rowspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Tên Chủ Nhà</th>
                                        <th  colspan="1" rowspan="2"  style="text-align: center;position: sticky;top: 0;z-index: 10;">Đoạn Đường </th>
                                        <th colspan="1"  rowspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Tuyến Phố </th>
                                        <th  colspan="1" rowspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Vị Trí</th>
                                        <th  colspan="1" rowspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Loại Nhà</th>
                                        <th colspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Quy Mô Tổng Thể</th>
                                        <th colspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Thực Tế Cho Thuê</th>
                                        <th colspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Tổng giá trị tài sản dự kiến</th>
                                        <th colspan="1" rowspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Giá trị thực tế cho thuê/tháng (theo hợp đồng)</th>
                                        <th class="ver1" colspan="3" style="text-align: center;position: sticky;top: 0;z-index: 10;">Hành động</th>
                                      
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;position: sticky;top: 0;z-index: 10;">Số Tầng</th>
                                        <th style="text-align: center;position: sticky;top: 0;z-index: 10;">Diện Tích Sàn</th>
                                        <th style="text-align: center;position: sticky;top: 0;z-index: 10;">Số Tầng</th>
                                        <th style="text-align: center;position: sticky;top: 0;z-index: 10;">Diện Tích Sàn</th>
                                        <th style="text-align: center;position: sticky;top: 0;z-index: 10;">Giá cho thuê tổng thể tham chiếu/tháng</th>
                                        <th style="text-align: center;position: sticky;top: 0;z-index: 10;">Giá cho thuê thực tế tham chiếu/tháng</th>         
                                        <th class="ver1" style="text-align: center;position: sticky;top: 0;z-index: 10;">Sửa</th>
                                        <th class="ver1" style="text-align: center;position: sticky;top: 0;z-index: 10;">Xóa</th>
                                        <th  style="text-align: center;position: sticky;top: 0;z-index: 10;">Kê khai hợp đồng</th>
                                    </tr>
                                </thead>
                                <tbody style="display: block;overflow: auto;max-height: 600px;">
                                       <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <strong>Không tìm thấy kết quả phù hợp</strong>
                                        </div> 
                                </tbody>
                            </table>
                            @endif
                                
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
