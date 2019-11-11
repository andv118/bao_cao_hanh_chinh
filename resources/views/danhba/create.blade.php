 @extends('master')

 @section('content')
 <script>
  function checkValidate() {
  //Tiến hành lấy dữ liệu trên Form
  var taxcode = document.getElementById("taxcode").value;
  var idnumber = document.getElementById("idnumber").value;
  var phoneNumber = document.getElementById("phoneNumber").value;
  var status = false; //Biến trạng thái
  var re = /([0-9]{10,13})\b/g;
  var re1 = /([0-9]{9,12})\b/g;
  var re2 = /(09|01[2|6|8|9])+([0-9]{8})\b/g;

  if (taxcode.length != 0 ){
       if(!taxcode.match(re) || (isNaN(taxcode)==true)){
        document.getElementById("taxcode").style.borderColor = "red";
        document.getElementById("taxcode").style.display = "block";
        document.getElementById("lbtaxcode").innerHTML = "Mã số thuế không hợp lệ";
        status = true;
      }else{

        document.getElementById("taxcode").style.borderColor = "#D8D8D8";
        document.getElementById("lbtaxcode").style.display = "none";

      }

  }

  if (idnumber.length != 0 ){
       if(!idnumber.match(re1) || (isNaN(idnumber)==true)){
        document.getElementById("idnumber").style.borderColor = "red";
        document.getElementById("idnumber").style.display = "block";
        document.getElementById("lbidnumber").innerHTML = "Số CMND không hợp lệ";
        status = true;
      }else{

        document.getElementById("idnumber").style.borderColor = "#D8D8D8";
        document.getElementById("lbidnumber").style.display = "none";

      }

  }


  if (phoneNumber.length != 0 ){
       if(!phoneNumber.match(re2) || (isNaN(phoneNumber)==true) || (phoneNumber.length < 10)){
        document.getElementById("phoneNumber").style.borderColor = "red";
        document.getElementById("phoneNumber").style.display = "block";
        document.getElementById("lbphoneNumber").innerHTML = "Số điện thoại không đúng định dạng";
        status = true;
      }else{

        document.getElementById("phoneNumber").style.borderColor = "#D8D8D8";
        document.getElementById("lbphoneNumber").style.display = "none";

      }

  }

  if (status == true) {
      //alert(msg);
      return false;
  } else {
      return true;
  }

  }
</script>
     <!-------------------Modal ----------------------------->
     <div id="import_file" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="color: red;text-align: center;"><b>NHẬP FILE EXEL</b></h3>
          </div>
          <div class="modal-body">
           <form action="{{route('admin.import_phonebook')}}" enctype="multipart/form-data" method="post">
              @csrf
              <label for="">Chọn file :</label>
              <input type="file"  name="select_file" value="Chọn file" class="form-control" placeholder="Chọn file" required="required"><br>
              <button class="btn btn-success" type="submit"><i class="fas fa-upload"></i> Import</button>
          </form> 
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

    </div>
    </div>

 <!-----------------end modal ---------------------------------------------------->
   <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Thu thập danh bạ</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar">
                    </div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;"><b>KÊNH THU THẬP VỀ DANH BẠ</b></h3>
                        </div>
                        <div style="margin: 20px 0;background-color: grey;padding: 10px;">
                          <button data-toggle="modal" title="Nhập từ excel" data-target="#import_file"  class="btn btn-success"><i class="fas fa-file-import"></i> Nhập từ Exel</button>  
                          <a href="{{route('admin.export_excel_phonebook')}}" title="Tải file mẫu excel" class="btn btn-primary"><i class="fas fa-file-import"></i> Tải file mẫu excel</a>
                          <a href="{{route('admin.create_property')}}" title="Kê khai tài sản" class="btn btn-warning"><i class="fas fa-directions"></i> Kê khai tài sản</a>
                        </div>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                          
                            <form class="col-sm-8 form-horizontal col-sm-offset-2" method="post" action="{{route('admin.save_phonebook')}}" onsubmit="return checkValidate();">
                                <input type="hidden" name="manager_name" value="{{Session::get('username')}}">
                                <input type="hidden" name="manager_code" value="{{Session::get('usercode')}}">
                                @csrf
                                @if(count($errors)>0)
                                <div class="alert alert-danger" style="margin: 20px 0;text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    @foreach($errors->all() as $err)
                                    {{$err}} <br>
                                    @endforeach
                                </div>
                                @endif
                                @if(Session::has('flag'))
                                <div class="alert alert-{{Session::get('flag')}}" style="color:red;margin: 20px 0;text-align: center;">{{Session::get('message')}}</div>
                                @endif
                                @if(Session::has('thanhcong'))
                                <div class="alert alert-success">{{Session::get('thanhcong')}}
                                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                </div>
                                @endif

                                @if(Session::has('loi'))
                                <div class="alert alert-danger">{{Session::get('error')}}
                                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                </div>
                                @endif
                              
                                <div class="form-group">
                                  <label for="mst" class="col-sm-2 control-label">1. Mã Số Thuế</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" onblur="return checkValidate();"  id="taxcode" name="taxcode" placeholder="Mã Số Thuế">
                                     <div style="color: red;" id="lbtaxcode"></div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="CMT" class="col-sm-2 control-label">2. CMT/CCCD</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" onblur="return checkValidate();" id="idnumber" name="idnumber" placeholder="CMT/CCCD">
                                    <div style="color: red;" id="lbidnumber"></div>
                                  </div>
                                </div>
                              
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">3. Họ Và Tên Chủ Nhà</label>
                                     <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" name="fullname" placeholder="Họ Và Tên Chủ Nhà" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phoneNumber" class="col-sm-2 control-label">4. Điện Thoại</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" onblur="return checkValidate();" id="phoneNumber" name="phoneN" placeholder="Điện Thoại">
                                    </div>
                                    <div style="color: red;" id="lbphoneNumber"></div>

                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">5. Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>
                                </div>
                                        <div class="form-group">
                                            <label for="addressTd" class="col-sm-2 control-label">6. Địa Chỉ Nhà Thuê</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="addressTd" name="address" placeholder="Địa Chỉ Nhà Thuê" required>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label for="addressTd" class="col-sm-2 control-label">7. Phường</label>
                                            <div class="col-sm-8">
                                                <select  id="" name="street" class="form-control" required>
                                                    <option value="">Chọn Phường</option>
                                                    @foreach($data as $v)
                                                    <option value="{{$v->id}}">{{$v->street_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                         
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">8. Hợp Đồng</label>
                                            <div class="col-sm-8">
                                                <div class="radio">
                                                    <label>
                                                      <input type="radio" name="isok" id="optionsRadios1" value="1" required>
                                                      Có
                                                    </label>
                                                  </div>
                                                  <div class="radio">
                                                    <label>
                                                      <input type="radio" name="isok"  id="optionsRadios2" value="0" required>
                                                      không
                                                    </label>
                                                  </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">9. Kênh Thu Thập Thông Tin</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="channel" id="" required>
                                                    <option value="1">QLý Cá Thể</option>
                                                    <option value="2">QLý Doanh Nghiệp</option>
                                                    <option value="3">  Phối Hợp Phường Xã</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                <div class="form-group">
                                  <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success" style="margin-left: 204px;">Lưu danh bạ</button>
                                  
                                  </div>
                                </div>
                              </form>             
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

@endsection
