@extends('master')

@section('content')
<script>
   function confirmDelete(){
            var r = confirm("Bạn có chắc chắn muốn xóa tài khoản này không?");
            if(r) return true;
            else return false;
    }

</script>
<script>
    function checkValidate() {
        //Tiến hành lấy dữ liệu trên Form
        var keyword = document.getElementById("keyword").value;
        var status = false; //Biến trạng thái

            if ( keyword == "") {
                document.getElementById("keyword").style.borderColor = "red";
                document.getElementById("keyword").style.display = "block";
                document.getElementById("lbsearch").innerHTML = "Hãy nhập từ khóa tìm kiếm";
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
<div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Danh sách tài khoản</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;padding: 20px 20px;"><b><i class="fa fa-list-alt"></i> DANH SÁCH TÀI KHOẢN(<span style="color: red;">{{count($data)}}</span>)</b></h3>
                        </div>
                        <a href="{{route('admin.export_users')}}" class="btn btn-warning"><i class="fa fa-download"></i> Xuất file Excel</a>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <form class="form-search" method="post" action="{{route('admin.SearchUser')}}" onsubmit="return checkValidate2();" style="margin: 10px 0;">
                             <input type="hidden" name="_token" value="{{csrf_token()}}">
                             <select type="text" id="filter" name="filter" placeholder="Tìm kiếm tài khoản" class="form-control" style="width: 25%;float: left;">
                               <option value="">Lọc theo tổ chức</option>
                               @foreach($data3 as $v)
                               <option value="{{$v->id}}">{{$v->street_name}}</option>
                               @endforeach
                             </select>&nbsp;
                             <span><button class="btn btn-danger" type="submit" id="search"><i class="fas fa-filter"></i> Lọc</button></span>
                             <div style="color: red;" id="lbfilter"></div> 
                           </form>

                            <form class="form-search" method="post" onsubmit="return checkValidate();" action="{{route('admin.SearchUser')}}" style="margin: 10px 0;">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="text" name="keyword" placeholder="Tìm kiếm tài khoản" id="keyword" class="form-control" style="width: 25%;float: left;">&nbsp;
                                <span><button class="btn btn-danger" type="submit" id="search"><i class="fa fa-search"></i></button></span>
                                <div style="color: red;" id="lbsearch"></div> 
                                <div style="margin-left: 20px;margin-bottom: 20px;">
                                  <marquee width="300">
                                    <b>Chọn từ khóa để tìm kiếm</b>
                                  </marquee>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" value="1" name="select" required>Mã cán bộ</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" value="2" name="select" required>Tên cán bộ</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" value="3" name="select" required>Email</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" value="4" name="select" required>Số điện thoại</label>
                                </div>
                            </form>
                           
                           
                            <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                               <thead>
                                    <tr>
                                        <th colspan="1" style="text-align: center;">Mã cán bộ</th>
                                        <th colspan="1" style="text-align: center;">Tên cán bộ</th>
                                        <th colspan="1" style="text-align: center;">Email</th>
                                        <th colspan="1" style="text-align: center;">Số điện thoại</th>
                                        <th colspan="1" style="text-align: center;">Phường quản lý</th>
                                        <th colspan="1" style="text-align: center;">Quyền hạn</th>
                                        <th colspan="1" style="text-align: center;">Xóa</th>
                                        <th colspan="1" style="text-align: center;">Cập nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($data2 as $v)
                                    <tr>
                                        <td style="text-align: center;">{{$v->code}}</td>
                                        <td style="text-align: center;">{{$v->name}}</td>
                                        <td style="text-align: center;">{{$v->email}}</td>
                                        <td style="text-align: center;">{{$v->phone}}</td>
                                        <td style="text-align: center;">{{$v->street_name}}</td>
                                        <td style="text-align: center;">
                                        	@if($v->role==0)
                                        	  <b>Admin</b>
                                        	@elseif($v->role==1)
                                        	   <b>Cán bộ phường</b>
                                        	@endif
                                        </td>
                                        <td style="text-align: center;">
                                          <form action="{{route('admin.DeleteUser')}}" method="post" onsubmit="return confirmDelete();">
                                               @csrf
                                               <input type="hidden" name="id" value="{{$v->id}}">
                                              <button class="btn btn-danger" type="submit" title="Xóa tài khoản"><i class="fas fa-trash-alt"></i></button>
                                          </form>
                                        </td>
                                        <td style="text-align: center;"><button class="btn btn-primary"  data-toggle="modal" data-target="#account{{$v->id}}"><i class="fa fa-edit"></i> Cập nhật</button></td>
                                        <div id="account{{$v->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h3 class="modal-title" style="color: grey;text-align: center;"><b>CẬP NHẬT TÀI KHOẢN</b></h3>
                                              </div>
                                              <div class="modal-body">
                                               <form action="{{route('admin.update_account')}}" method="post">
                                                  @csrf
                                                  <input type="hidden" name="id" value="{{$v->code}}">
                                                  <label for="fullname">Mã cán bộ : <b style="color: red;">{{$v->code}}</b></label><br>

                                                  <label for="email">Tên cán bộ : <b style="color: red;">{{$v->name}}</b></label><br>


                                                  <label for="email">Phường quản lý :</label>
                                                  <select name="street" class="form-control" id="" required>
                                                      <option value="">Chọn phường quản lý</option>
                                                      @foreach($data3 as $v)
                                                      <option value="{{$v->id}}">{{$v->street_name}}</option>
                                                      @endforeach
                                                  </select>
                                                  <br>
                                                  <label for="email">Quyền hạn :</label>
                                                  <select name="role" id="" class="form-control" required>
                                                      <option value="">Chọn quyền hạn</option>
                                                      <option value="0">Admin</option>
                                                      <option value="1">Cán bộ phường</option>
                                                  </select>
                                                  <br>

                                                  <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-refresh"></span>Cập nhật</button>
                                              </form> 
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          </div>
                                      </div>

                                  </div>
                              </div>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                <div class="pull-right pagination">
                                    {{$data2->links()}}
                                </div>
                        </div>
                       
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
@endsection