@extends('master')

@section('content')
<script>
    function checkValidate() {
        //Tiến hành lấy dữ liệu trên Form
        var taxcode = document.getElementById("taxcode").value;
        var fullname = document.getElementById("fullname").value;
        var propertycode = document.getElementById("propertycode").value;
        var contractcode = document.getElementById("contractcode").value;
        var register = document.getElementById("register").value;
        var price = document.getElementById("price_contract").value;
        var submit_date = document.getElementById("submit_date").value;  
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

            if (propertycode == "") {
                document.getElementById("propertycode").style.borderColor = "red";
                document.getElementById("propertycode").style.display = "block";
                document.getElementById("lbpropertycode").innerHTML = "Hãy nhập mã tài sản";
                status = true;
            }else{

                document.getElementById("propertycode").style.borderColor = "#D8D8D8";
                document.getElementById("lbpropertycode").style.display = "none";

            }  

            if (contractcode == "") {
                document.getElementById("contractcode").style.borderColor = "red";
                document.getElementById("contractcode").style.display = "block";
                document.getElementById("lbcontractcode").innerHTML = "Hãy nhập mã hợp đồng";
                status = true;
            }else{

                document.getElementById("propertycode").style.borderColor = "#D8D8D8";
                document.getElementById("lbcontractcode").style.display = "none";

            }  

            if (register == "") {
                document.getElementById("register").style.borderColor = "red";
                document.getElementById("register").style.display = "block";
                document.getElementById("lbregister").innerHTML = "Hãy chọn kỳ đăng ký";
                status = true;
            }else{

                document.getElementById("register").style.borderColor = "#D8D8D8";
                document.getElementById("lbregister").style.display = "none";

            }  

             if (price == "") {
                document.getElementById("price_contract").style.borderColor = "red";
                document.getElementById("price_contract").style.display = "block";
                document.getElementById("lbpricecontract").innerHTML = "Hãy nhập giá hợp đồng";
                status = true;
            }else{

                document.getElementById("price_contract").style.borderColor = "#D8D8D8";
                document.getElementById("lbpricecontract").style.display = "none";

            }  

            if (submit_date == "") {
                document.getElementById("submit_date").style.borderColor = "red";
                document.getElementById("submit_date").style.display = "block";
                document.getElementById("lbsubmitdate").innerHTML = "Hãy nhập ngày nộp tờ khai";
                status = true;
            }else{

                document.getElementById("submit_date").style.borderColor = "#D8D8D8";
                document.getElementById("lbsubmitdate").style.display = "none";

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
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Cập nhật tờ khai thuế</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                              <h3 style="text-align: center;padding: 20px 0;"><b>CẬP NHẬT TỜ KHAI</b></h3>
                        </div>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                                @if(count($errors)>0)
                                <div class="alert alert-danger" style="color:white;margin: 20px 0;text-align: center;">
                                    @foreach($errors->all() as $err)
                                    {{$err}} <br>
                                    @endforeach
                                </div>
                                @endif
                               
                                @if(Session::has('loi'))
                                <div class="alert alert-danger" style="text-align: center;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
                                {{Session::get('loi')}}</div>
                                @endif
                                <form class="col-sm-8 form-horizontal col-sm-offset-2" action="{{route('admin.change_tax')}}" method="post" onsubmit="return checkValidate();">
                                           
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                             <div class="form-group">
                                                <label for="mhd" class="col-sm-2 control-label">1.Mã Hợp đồng </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" value="{{$data[0]['contract_code']}}"  id="contractcode" name="contractcode" placeholder="Mã Hợp đồng ">
                                                </div>
                                                <div style="color: red;" id="lbcontractcode"></div>
                                            </div>
                                            
                                            <div class="form-group">
                                                  <label for="mst" class="col-sm-2 control-label">2.Mã Số Thuế</label>
                                                  <div class="col-sm-8">
                                                    <input type="text" value="{{$data[0]['tax_code']}}" class="form-control" id="taxcode" name="taxcode" placeholder="Mã Số Thuế">
                                                </div>
                                                <div style="color: red;" id="lbtaxcode"></div>

                                            </div>
                                            <div class="form-group">
                                              <label for="name" class="col-sm-2 control-label">3.Tên Chủ Nhà</label>
                                              <div class="col-sm-8">
                                                <input type="text" class="form-control" value="{{$data[0]['fullname']}}" id="fullname" name="fullname" placeholder="Tên Chủ Nhà">
                                              </div>
                                                <div style="color: red;" id="lbfullname"></div>

                                            </div>
                                            <div class="form-group">
                                                <label for="mst" class="col-sm-2 control-label">4.Mã tài sản</label>
                                                <div class="col-sm-8">
                                                    <input type="text" value="{{$data[0]['property_code']}}" class="form-control" id="propertycode" name="propertycode" placeholder="Mã tài sản">
                                                </div>
                                                <div style="color: red;" id="lbpropertycode"></div>

                                            </div>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <script>
                                                $(document).ready(function(){
                                                    $('#contractcode').autocomplete({
                                                        source : "{{route('admin.get_contractcode')}}",
                                                        minLength : 1
                                                    });
                                                
                                                    $('#contractcode').keyup(function(){
                                                        var val = $('#contractcode').val();
                                                        var _token = $('input[name="_token"]').val();
                                                        $.ajax({
                                                            url: "{{route('admin.check_contractcode')}}",
                                                            data:{val:val,_token:_token},
                                                            type: "post",
                                                            success: function(data){
                                                             $('#lbcontractcode').html(data);
                                                            }
                                                        }); 
                                                        $.ajax({
                                                            url: "{{route('admin.get_taxcode_contract')}}",
                                                            data:{val:val,_token:_token},
                                                            type: "post",
                                                            success: function(data){
                                                             $('#taxcode').val(data);
                                                            }
                                                        }); 
                                                        $.ajax({
                                                            url: "{{route('admin.get_fullname_contract')}}",
                                                            data:{val:val,_token:_token},
                                                            type: "post",
                                                            success: function(data){
                                                             $('#fullname').val(data);
                                                            }
                                                        });
                                                        $.ajax({
                                                            url: "{{route('admin.get_propertycode_contract')}}",
                                                            data:{val:val,_token:_token},
                                                            type: "post",
                                                            success: function(data){
                                                             $('#propertycode').val(data);
                                                            }
                                                        }); 
                                                        
                                                    }); 
                                                    
                                                });
                                            </script>
                                           
                                            <div class="form-group" id="register1">
                                                <label for="quy" class="col-sm-2 control-label" >5. Đăng ký kê khai</label>
                                                <div class="col-sm-8">
                                                    <select name="register" id="register" class="form-control">
                                                        <option value="">Chọn đăng ký</option>
                                                        <option value="1">Quý</option>
                                                        <option value="2">Năm</option>
                                                    </select>
                                                </div>
                                                <div style="color: red;" id="lbregister"></div>

                                            </div>

                                            <div class="form-group" >
                                                <label class="col-sm-2 control-label">6. Giá trên hợp đồng/tháng</label>
                                                <div class="col-sm-8">
                                                    <input type="text" value="{{$data[0]['price_contract']}}" id="price_contract" name="price_contract" class="form-control" placeholder="Giá hợp đồng theo tháng">
                                                </div>
                                                <div style="color: red;" id="lbpricecontract"></div>

                                            </div> 
                                            
                                            <div class="form-group"  id="date1">
                                                <label class="col-sm-2 control-label">7. Ngày nộp TK (ngày-tháng-năm)</label>
                                                <div class="col-sm-8">
                                                    <input type="text" value="{{date('d-m-Y',strtotime($data[0]['submit_date']))}}" id="submit_date" name="submit_date" class="form-control" placeholder="Ngày nộp TK">
                                                </div>
                                                <div style="color: red;" id="lbsubmitdate"></div>

                                            </div> 
                                            
                                   
                                    <div class="form-group">
                                      <div class="col-sm-offset-2 col-sm-10" >
                                        <button type="submit" class="btn btn-success" style="margin-left: 200px;"><i class="fa fa-sync-alt"></i>  Cập nhật tờ khai</button>
                                      </div>               
                                   </div>
                            </form>
                        </div>  
                       
                    </div>

                </div>

            </div>
              <a style="margin:0 0 20px 20px;" href="{{route('admin.create_tax')}}" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Quay lại</a>
        </div>
@endsection