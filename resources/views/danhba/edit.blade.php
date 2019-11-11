 @extends('master')

 @section('content')
   <script>
    function checkValidate() {

        var taxcode = document.getElementById("taxcode").value;
        var fullname = document.getElementById("fullname").value;
        var idnumber = document.getElementById("idnumber").value;
        var phone = document.getElementById("phone").value;
        var email = document.getElementById("email").value;
        var address = document.getElementById("address").value;
        var channel = document.getElementById("channel").value;
        var street = document.getElementById("street").value;

        var status = false; //Biến trạng thái

         if ( taxcode== "") {
            document.getElementById("taxcode").style.borderColor = "red";
            document.getElementById("taxcode").style.display = "block";
            document.getElementById("lbtaxcode").innerHTML = "Hãy nhập mã số thuế";
            status = true;
        }else{
            
                document.getElementById("taxcode").style.borderColor = "#D8D8D8";
                document.getElementById("lbtaxcode").style.display = "none";
            
        }

        if ( fullname== "") {
            document.getElementById("fullname").style.borderColor = "red";
            document.getElementById("fullname").style.display = "block";
            document.getElementById("lbfullname").innerHTML = "Hãy nhập tên chủ nhà";
            status = true;
        }else{

            document.getElementById("fullname").style.borderColor = "#D8D8D8";
            document.getElementById("lbfullname").style.display = "none";
            
        }

        if (idnumber == "") {
            document.getElementById("idnumber").style.borderColor = "red";
            document.getElementById("idnumber").style.display = "block";
            document.getElementById("lbidnumber").innerHTML = "Hãy nhập số chứng minh thư";
            status = true;
        }else{

            document.getElementById("idnumber").style.borderColor = "#D8D8D8";
            document.getElementById("lbidnumber").style.display = "none";

        } 

        if ( phone== "") {
            document.getElementById("phone").style.borderColor = "red";
            document.getElementById("phone").style.display = "block";
            document.getElementById("lbphone").innerHTML = "Hãy số điện thoại";
            status = true;
        }else{

            document.getElementById("phone").style.borderColor = "#D8D8D8";
            document.getElementById("lbphone").style.display = "none";

        } 

        if ( email== "") {
            document.getElementById("email").style.borderColor = "red";
            document.getElementById("email").style.display = "block";
            document.getElementById("lbemail").innerHTML = "Hãy nhập địa chỉ email";
            status = true;
        }else{

            document.getElementById("email").style.borderColor = "#D8D8D8";
            document.getElementById("lbemail").style.display = "none";

        } 

        if ( address== "") {
            document.getElementById("address").style.borderColor = "red";
            document.getElementById("address").style.display = "block";
            document.getElementById("lbaddress").innerHTML = "Hãy nhập địa chỉ nhà";
            status = true;
        }else{

            document.getElementById("address").style.borderColor = "#D8D8D8";
            document.getElementById("lbaddress").style.display = "none";

        }  

        if ( channel== "") {
            document.getElementById("channel").style.borderColor = "red";
            document.getElementById("channel").style.display = "block";
            document.getElementById("lbchannel").innerHTML = "Hãy chọn chọn kênh thu thập thông tin";
            status = true;
        }else{

            document.getElementById("channel").style.borderColor = "#D8D8D8";
            document.getElementById("lbchannel").style.display = "none";

        } 

        if ( street== "") {
            document.getElementById("street").style.borderColor = "red";
            document.getElementById("street").style.display = "block";
            document.getElementById("lbstreet").innerHTML = "Hãy chọn phường";
            status = true;
        }else{

            document.getElementById("street").style.borderColor = "#D8D8D8";
            document.getElementById("lbstreet").style.display = "none";

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
            <div class="panel-heading"><b><i class="fa fa-home"></i>/ Cập nhật danh bạ</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;padding: 20px 20px;"><b>CẬP NHẬT DANH BẠ</b></h3>
                        </div>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            @if(Session::has('thanhcong'))
                            <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
                            @endif
                            <form class="col-sm-8 form-horizontal col-sm-offset-2" method="post" action="{{route('admin.update_phonebook')}}" onsubmit="return checkValidate();">
                                <input type="hidden" name="manager_name" value="{{Session::get('username')}}">
                                <input type="hidden" name="manager_code" value="{{Session::get('usercode')}}">
                                <input type="hidden" name="id" value="{{$data[0]['id_phonebook']}}">
                                @csrf
                                @if(count($errors)>0)
                                <div class="alert alert-danger" style="margin: 20px 0;text-align: center;">
                                    @foreach($errors->all() as $err)
                                    {{$err}} <br>
                                    @endforeach
                                </div>
                                @endif
                                <div class="form-group">
                                  <label for="mst" class="col-sm-2 control-label">1. Mã Số Thuế</label>
                                  <div class="col-sm-8">
                                    <input type="text" value="{{$data[0]['tax_code']}}" class="form-control" id="taxcode" name="taxcode" placeholder="Mã Số Thuế">
                                    <div style="color: red;" id="lbtaxcode"></div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="CMT" class="col-sm-2 control-label">2. CMT/CCCD</label>
                                  <div class="col-sm-8">
                                    <input type="text" value="{{$data[0]['id_number']}}" class="form-control" id="idnumber" name="idnumber" placeholder="CMT/CCCD">
                                        <div style="color: red;" id="lbidnumber"></div>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">3. Họ Và Tên Chủ Nhà</label>
                                     <div class="col-sm-8">
                                        <input type="text" value="{{$data[0]['fullname']}}" class="form-control" id="fullname" name="fullname" placeholder="Họ Và Tên Chủ Nhà">
                                            <div style="color: red;" id="lbfullname"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phoneNumber" class="col-sm-2 control-label">4. Điện Thoại</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{$data[0]['phone']}}" class="form-control" id="phone" name="phone" placeholder="Điện Thoại">
                                            <div style="color: red;" id="lbphone"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">5. Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" value="{{$data[0]['email']}}" class="form-control" id="email" name="email" placeholder="Email">
                                            <div style="color: red;" id="lbemail"></div>
                                    </div>
                                </div>
                                        <div class="form-group">
                                            <label for="addressTd" class="col-sm-2 control-label">6. Địa Chỉ Nhà Thuê</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="{{$data[0]['address']}}" class="form-control" id="address" name="address" placeholder="Địa Chỉ Nhà Thuê">
                                                    <div style="color: red;" id="lbaddress"></div>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="addressTd" class="col-sm-2 control-label">7. Phường</label>
                                            <div class="col-sm-8">
                                                <select  id="street" name="street" class="form-control">
                                                    <option value="{{$id_street}}">{{$street_name}}</option>
                                                    @foreach($data2 as $v)
                                                    <option value="{{$v->id}}">{{$v->street_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div style="color: red;" id="lbstreet"></div>
                                        </div>
                                         
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">8. Hợp Đồng</label>
                                            @if($data[0]['isok']==1)
                                            <div class="col-sm-8">
                                                <div class="radio">
                                                    <label>
                                                      <input type="radio" name="isok" value="1" required checked>
                                                      Có
                                                    </label>
                                                  </div>
                                                  <div class="radio">
                                                    <label>
                                                      <input type="radio" name="isok"  value="0" required>
                                                      không
                                                    </label>
                                                  </div>
                                            </div>
                                            @elseif($data[0]['isok']==0)
                                            <div class="col-sm-8">
                                                <div class="radio">
                                                    <label>
                                                      <input type="radio" name="isok" value="1" required>
                                                      Có
                                                    </label>
                                                  </div>
                                                  <div class="radio">
                                                    <label>
                                                      <input type="radio" name="isok"  value="0" required checked>
                                                      không
                                                    </label>
                                                  </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">9. Kênh Thu Thập Thông Tin</label>
                                            <div class="col-sm-8">
                                                <select id="channel" class="form-control" name="channel">
                                                    @if($data[0]['collect_channel']==1)
                                                    <option value="1">QLý Cá Thể</option>
                                                    <option value="2">QLý Doanh Nghiệp</option>
                                                    <option value="3">Phối Hợp Phường Xã</option>
                                                    @elseif($data[0]['collect_channel']==2)
                                                    <option value="2">QLý Doanh Nghiệp</option>
                                                    <option value="1">QLý Cá Thể</option>
                                                    <option value="3">Phối Hợp Phường Xã</option>
                                                    @elseif($data[0]['collect_channel']==3)
                                                    <option value="3">Phối Hợp Phường Xã</option>
                                                    <option value="1">QLý Cá Thể</option>
                                                    <option value="2">QLý Doanh Nghiệp</option>
                                                    @endif
                                                </select>
                                            </div>
                                                <div style="color: red;" id="lbchannel"></div>
                                        </div>
                                        
                                <div class="form-group">
                                  <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success" style="margin-left: 190px;"><i class="fa fa-edit"></i> Cập nhật danh bạ</button>
                                  </div>
                                </div>
                              </form>        
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <a href="{{route('admin.detail_phonebook')}}" class="btn btn-primary"><i class="fas fa-undo"></i> Quay lại</a>


@endsection
