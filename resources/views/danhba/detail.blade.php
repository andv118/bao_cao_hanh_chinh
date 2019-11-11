 @extends('master')

 @section('content')
 <script>
    function checkValidate() {
        //Tiến hành lấy dữ liệu trên Form
        var keyword = document.getElementById("keyword").value;
        var status = false; //Biến trạng thái

            if ( keyword == "") {
                document.getElementById("keyword").style.borderColor = "red";
                document.getElementById("keyword").style.display = "block";
                document.getElementById("lbsearch").innerHTML = "Hãy nhập từ khóa để tìm kiếm";
                status = true;
            }else{
                
                    document.getElementById("keyword").style.borderColor = "#D8D8D8";
                    document.getElementById("lbsearch").style.display = "none";
                
            }

           
            if (status == true) {
                //alert(msg);
                return false;
            } else {
                return true;
            }
   
    }

    function checkValidate2(){

            var filter = document.getElementById("filter").value;
            var status = false; //Biến trạng thái

            if ( filter == "") {
                document.getElementById("filter").style.borderColor = "red";
                document.getElementById("filter").style.display = "block";
                document.getElementById("lbfilter").innerHTML = "Hãy chọn phường tìm kiếm";
                status = true;
            }else{
                
                    document.getElementById("filter").style.borderColor = "#D8D8D8";
                    document.getElementById("lbfilter").style.display = "none";
                
            }

           
            if (status == true) {
                //alert(msg);
                return false;
            } else {
                return true;
            }
    }
</script>

<script>
   function confirmDelete(){
            var r = confirm("Bạn có chắc chắn muốn xóa danh bạ này không?");
            if(r) return true;
            else return false;
    }

</script>
  <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Danh sách danh bạ</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;margin:20px 0;"><b><i class="fa fa-list-alt"></i> DANH SÁCH DANH BẠ (<span style="color: red;">{{count($data)}}</span>)</b></h3>
                        </div>
                         <a href="{{route('admin.export_phonebook')}}" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</a>
                        <form class="form-search" method="post" action="{{route('admin.search_phonebook')}}" onsubmit="return checkValidate2();" style="margin: 10px 0;">
                             <input type="hidden" name="_token" value="{{csrf_token()}}">
                             <select type="text" id="filter" name="filter" class="form-control" style="width: 25%;float: left;">
                               <option value="">Lọc theo phường</option>
                               @foreach($data3 as $v)
                               <option value="{{$v->id}}">{{$v->street_name}}</option>
                               @endforeach
                             </select>&nbsp;
                             <span><button class="btn btn-danger" type="submit" id="search"><i class="fas fa-filter"></i> Lọc</button></span>
                             <div style="color: red;" id="lbfilter"></div> 
                        </form>
                        <form class="form-search" method="post" onsubmit="return checkValidate();" action="{{route('admin.search_phonebook')}}" style="margin: 10px 0;">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="text" name="keyword" placeholder="Tìm kiếm danh bạ" id="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
                                <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
                                <div style="color: red;width: 300px;" id="lbsearch"></div>
                                <div style="margin-left: 20px;margin-bottom: 20px;width: 300px;">
                                    <marquee width="300">
                                        <b>Chọn từ khóa để tìm kiếm</b>
                                    </marquee>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" value="1" name="select" required>Mã số thuế</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" value="2" name="select" required>CMT/CMND</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" value="3" name="select" required>Tên chủ nhà</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" value="4" name="select" required>Số điện thoại</label>
                                </div> 
                                <div class="radio">
                                  <label><input type="radio" value="5" name="select" required>Email</label>
                                </div>  
                            </form>
                            
                        <div class="fixed-table-body table-responsive">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                             @if(Session::has('loi'))
                                <div class="alert alert-danger">{{Session::get('loi')}}
                                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                </div>
                            @endif
                            <table data-toggle="table" class="table table-hover table-bordered table-striped jambo_table bulk_action">
                                <thead style="display: block;">
                                    <tr>
                                        <th class="ver1" rowspan="3" style="text-align: center;position: sticky;top: 0;z-index: 10;">STT</th>
                                        <th colspan="8" style="text-align: center;position: sticky;top: 0;z-index: 10;">Thông tin thu thập được</th>
                                        <th colspan="1" rowspan="3" style="text-align: center;position: sticky;top: 0;z-index: 10;">Kênh thu thập thông tin</th>
                                        <th colspan="1" rowspan="3" style="text-align: center;position: sticky;top: 0;z-index: 10;">Phường</th>
                                        <th colspan="2" style="text-align: center;position: sticky;top: 0;z-index: 10;">Cán bộ thực hiện</th>
                                        <th colspan="2" rowspan="3" style="text-align: center;position: sticky;top: 0;z-index: 10;">Xóa</th>
                                        <th colspan="2" rowspan="3" style="text-align: center;position: sticky;top: 0;z-index: 10;">Sửa</th>
                                        <th colspan="2" rowspan="3" style="text-align: center;position: sticky;top: 0;z-index: 10;">Kê khai tài sản</th>
                                    </tr>
                                    <tr>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Mã Số Thuế</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">CMT/CCCD</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Họ và tên chủ nhà</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Điện Thoại</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Email</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Địa Chỉ 
                                            Nhà Thuê</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" colspan="2">Hợp Đồng </th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Tên</th>
                                        <th style="position: sticky;top: 0;z-index: 10;" rowspan="2">Mã CB</th>
                                        
                                    </tr>
                                    <tr>
                                        <th style="position: sticky;top: 0;z-index: 10;">Có</th>
                                        <th style="position: sticky;top: 0;z-index: 10;">Không</th>
                                    </tr>
                                </thead>
                                <tbody id="content" style="display: block;overflow: auto;max-height: 500px;">
                                    <?php $stt = 0; ?>
                                    @foreach($data2 as $v)
                                    <tr>
                                        <td class="ver1">{{$stt+=1}}</td>
                                        <td>{{$v->tax_code}}</td>
                                        <td>{{$v->id_number}}</td>
                                        <td>{{$v->fullname}}</td>
                                        <td>{{$v->phone}}</td>
                                        <td>{{$v->email}}</td>
                                        <td>{{$v->address}}</td>
                                        @if($v->isok == 1)
                                        <td><input type="checkbox" checked></td>
                                        <td><input type="checkbox"></td>
                                        @elseif($v->isok == 0)
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox" checked></td>
                                        @endif
                                        <td>
                                        @if($v->collect_channel==1)
                                        {{'Quản lý cá thể'}}
                                        @elseif($v->collect_channel==2)
                                        {{'Quản lý doanh nghiệp'}}
                                        @elseif($v->collect_channel==3)
                                        {{'Phối hợp phường xã'}}
                                        @endif
                                        </td>
                                        <td>{{$v->street_name}}</td>
                                        <td>{{$v->manager_name}}</td>
                                        <td>{{$v->manager_code}}</td>
                                        <td style="text-align: center;">
                                           <form action="{{route('admin.delete_phonebook',$v->id_phonebook)}}" method="get" onsubmit="return confirmDelete();">
                                                <button class="btn btn-danger" type="submit"><i class="far fa-trash-alt" style="color: white;"></i></button>
                                           </form>
                                        </td>
                                        <td style="text-align: center;"><a class="btn btn-warning" href="{{route('admin.edit_phonebook',$v->id_phonebook)}}"><i class="fas fa-edit" style="color: white;"></i></a></td>
                                        <td style="text-align: center;"><a class="btn btn-success" href="{{route('admin.declare_property',$v->id_phonebook)}}"><i class="fa fa-share"></i></a></td>
                                        
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
