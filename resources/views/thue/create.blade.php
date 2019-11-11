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
            }else if(isNaN(price)==true) {
                document.getElementById("price_contract").style.borderColor = "red";
                document.getElementById("price_contract").style.display = "block";
                document.getElementById("lbpricecontract").innerHTML = "Hãy nhập đúng định dạng";
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

    function confirmDelete(){
            var r = confirm("Bạn có chắc chắn muốn xóa tờ khai này không?");
            if(r) return true;
            else return false;
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
            <div class="panel-heading"><b><i class="fa fa-home"></i>/ Kê khai thuế</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                              <h3 style="text-align: center;"><b>KÊ KHAI THUẾ</b></h3>
                        </div>
                        <button data-toggle="modal" title="Nhập từ excel" data-target="#import_file"  class="btn btn-success"><i class="fas fa-file-import"></i> Nhập từ Exel</button> 
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                                @if(count($errors)>0)
                                <div class="alert alert-danger" style="color:white;margin: 20px 0;text-align: center;">
                                    @foreach($errors->all() as $err)
                                    {{$err}} <br>
                                    @endforeach
                                </div>
                                @endif
                                @if(Session::has('thanhcong'))
                                <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
                                @endif 
                                
                                @if(Session::has('loi'))
                                <div class="alert alert-danger" style="text-align: center;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
                                {{Session::get('loi')}}</div>
                                @endif
                                <form class="col-sm-8 form-horizontal col-sm-offset-2" action="{{route('admin.save_tax')}}" method="post" onsubmit="return checkValidate();">
                                           
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                             <div class="form-group">
                                                <label for="mhd" class="col-sm-2 control-label">1.Mã Hợp đồng </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"  id="contractcode" name="contractcode" placeholder="Mã Hợp đồng ">
                                                </div>
                                                <div style="color: red;" id="lbcontractcode"></div>
                                            </div>
                                            
                                            <div class="form-group">
                                                  <label for="mst" class="col-sm-2 control-label">2.Mã Số Thuế</label>
                                                  <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="taxcode" name="taxcode" placeholder="Mã Số Thuế">
                                                </div>
                                                <div style="color: red;" id="lbtaxcode"></div>

                                            </div>
                                            <div class="form-group">
                                              <label for="name" class="col-sm-2 control-label">3.Tên Chủ Nhà</label>
                                              <div class="col-sm-8">
                                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Tên Chủ Nhà">
                                              </div>
                                                <div style="color: red;" id="lbfullname"></div>

                                            </div>
                                            <div class="form-group">
                                                <label for="mst" class="col-sm-2 control-label">4.Mã tài sản</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="propertycode" name="propertycode" placeholder="Mã tài sản">
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
                                                    <input type="text" id="price_contract" name="price_contract" class="form-control" placeholder="Giá hợp đồng theo tháng">
                                                </div>
                                                <div style="color: red;" id="lbpricecontract"></div>

                                            </div> 
                                            
                                            <div class="form-group"  id="date1">
                                                <label class="col-sm-2 control-label">7. Ngày nộp TK</label>
                                                <div class="col-sm-8">
                                                    <input type="date" id="submit_date" onblur="return formatDate();" class="form-control" placeholder="Ngày nộp TK">
                                                    <input type="hidden" id="submit_date2" name="submit_date">
                                                </div>
                                                <div style="color: red;" id="lbsubmitdate"></div>

                                            </div>
                                            <script>
                                                function formatDate(){
                                                 var date = document.getElementById("submit_date").value;
                                                 var newdate = moment(date).format('DD-MM-YYYY'); 
                                                 
                                                 document.getElementById("submit_date2").value = newdate;
                                                 }
                                           </script>
                                            
                                   
                                    <div class="form-group">
                                      <div class="col-sm-offset-2 col-sm-10" >
                                        <button type="submit" class="btn btn-success" style="margin-left: 15%;"><i class="fas fa-save"></i>  Lưu tờ khai</button>
                                         <a href="{{route('admin.get_money')}}" title="Nộp thuế" class="btn btn-warning"><i class="fas fa-directions"></i> Nộp thuế</a>
                                      </div>               
                                   </div>
                            </form>
                        </div>  
                        
                    </div>
                </div>
                <div class="clearfix"></div>
                <div style="border-top: 2px solid grey;margin-top: 20px;"></div>
                <h3 style="text-align: center;margin-top: 50px;margin-bottom: 20px;bor"><b>DANH SÁCH TỜ KHAI</b></h3>
                        <table data-toggle="table" class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action">
                            <thead>
                                <tr>
                                    <th style="text-align: center;" style="text-align: center;" rowspan="2">STT</th>
                                    <th style="text-align: center;" style="text-align: center;" rowspan="2">Mã hợp đồng</th>
                                    <th style="text-align: center;" style="text-align: center;" rowspan="2">Mã số thuế</th>
                                    <th style="text-align: center;" style="text-align: center;" rowspan="2">Mã tài sản</th>
                                    <th style="text-align: center;" style="text-align: center;" rowspan="2">Tên chủ nhà</th>
                                    <th style="text-align: center;" style="text-align: center;" colspan="2">Đăng ký kê khai</th>
                                    <th style="text-align: center;" style="text-align: center;" rowspan="2">Giá trên hợp đồng (theo tháng)</th>
                                    <th style="text-align: center;" style="text-align: center;" colspan="2">Các kỳ phải kê khai</th>
                                    <th style="text-align: center;" style="text-align: center;" rowspan="2">Ngày nộp tờ khai</th>
                                    <th style="text-align: center;" style="text-align: center;" colspan="2">Hành động</th>
                                </tr>
                                <tr>
                                 <th style="text-align: center;">Quý</th>
                                 <th style="text-align: center;">Năm</th>
                                 <th style="text-align: center;">Quý</th>
                                 <th style="text-align: center;">Năm</th>
                                 <th style="text-align: center;">Cập nhật</th>
                                 <th style="text-align: center;">Xóa</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $stt = 0; ?>
                             @foreach($data as $v)
                               <tr>
                                   <td style="text-align: center;"><?php $stt+=1; echo $stt; ?></td>
                                   <td style="text-align: center;">{{$v->contract_code}}</td>
                                   <td style="text-align: center;">{{$v->tax_code}}</td>
                                   <td style="text-align: center;">{{$v->property_code}}</td>
                                   <td style="text-align: center;">{{$v->fullname}}</td>
                                   @if($v->register==1)
                                   <td style="text-align: center;"><input type="checkbox" checked></td>
                                   <td style="text-align: center;"></td>
                                   @elseif($v->register==2)
                                   <td style="text-align: center;"></td>
                                   <td style="text-align: center;"><input type="checkbox" checked></td>
                                   @endif
                                    <td style="text-align: center;">{{number_format($v->price_contract)}}</td>
                                    <td style="text-align: center;">{{$v->precious_declare}}</td>
                                    <td style="text-align: center;">{{$v->year_declare}}</td>
                                    <td style="text-align: center;">{{date("d/m/Y",strtotime($v->submit_date))}}</td>
                                    <td style="text-align: center;"><a href="{{route('admin.update_tax',$v->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Cập nhật</button></td>
                                    <td style="text-align: center;">
                                        <form action="{{route('admin.delete_tax_declare')}}" method="post" onsubmit="return confirmDelete();">
                                            @csrf
                                            <input type="hidden" name="contract_code" value="{{$v->contract_code}}">
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Xóa</button>
                                        </form>
                                    </td>
                               </tr>
                               
                             @endforeach
                         </tbody>
                     </table>

                     {{$data->links()}}
            </div>
        </div>
@endsection