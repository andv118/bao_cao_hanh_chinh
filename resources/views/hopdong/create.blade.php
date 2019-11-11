@extends('master')

@section('content')
<script>
    function checkValidate() {
        //Tiến hành lấy dữ liệu trên Form
        var taxcode = document.getElementById("taxcode").value;
        var fullname = document.getElementById("fullname").value;
        var propertycode = document.getElementById("propertycode").value;
        var method = document.getElementById("method").value;
        var customername = document.getElementById("customername").value;
        var customerphone = document.getElementById("customerphone").value;
        var area = document.getElementById("area").value;
        var floor = document.getElementById("floor").value;
        var room = document.getElementById("room").value;
        var from = document.getElementById("from").value;
        var to = document.getElementById("to").value;
        var payment1 = document.getElementById("payment1").value;
        var payment2 = document.getElementById("payment2").checked;
        var purpose = document.getElementById("purpose").value;
        var totalcost = document.getElementById("totalcost").value;
        var currency = document.getElementById("currency").value;
       
        var status = false; //Biến trạng thái
        var re = /([0-9]{10,13})\b/g;
         
         if ( taxcode== "") {
            document.getElementById("taxcode").style.borderColor = "red";
            document.getElementById("taxcode").style.display = "block";
            document.getElementById("lbtaxcode").innerHTML = "Hãy nhập mã số thuế";
            status = true;
        }else if(!taxcode.match(re) || (isNaN(taxcode)==true)){
            document.getElementById("taxcode").style.borderColor = "red";
            document.getElementById("taxcode").style.display = "block";
            document.getElementById("lbtaxcode").innerHTML = "Mã số thuế không đúng định dạng (10 số)";
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

        if ( method== "") {
            document.getElementById("method").style.borderColor = "red";
            document.getElementById("method").style.display = "block";
            document.getElementById("lbmethod").innerHTML = "Hãy chọn hình thức thuê";
            status = true;
        }else{

            document.getElementById("method").style.borderColor = "#D8D8D8";
            document.getElementById("lbmethod").style.display = "none";

        } 

        if ( customername== "") {
            document.getElementById("customername").style.borderColor = "red";
            document.getElementById("customername").style.display = "block";
            document.getElementById("lbcustomername").innerHTML = "Hãy nhập tên khách hàng";
            status = true;
        }else{

            document.getElementById("customername").style.borderColor = "#D8D8D8";
            document.getElementById("lbcustomername").style.display = "none";

        } 

        if ( customerphone== "") {
            document.getElementById("customerphone").style.borderColor = "red";
            document.getElementById("customerphone").style.display = "block";
            document.getElementById("lbcustomerphone").innerHTML = "Hãy nhập số điện thoại khách hàng";
            status = true;
        }else{

            document.getElementById("customerphone").style.borderColor = "#D8D8D8";
            document.getElementById("lbcustomerphone").style.display = "none";

        } 

        if ( area== "") {
            document.getElementById("area").style.borderColor = "red";
            document.getElementById("area").style.display = "block";
            document.getElementById("lbarea").innerHTML = "Hãy nhập diện tích";
            status = true;
        }else{

            document.getElementById("area").style.borderColor = "#D8D8D8";
            document.getElementById("lbarea").style.display = "none";

        }

        if ( floor== "") {
            document.getElementById("floor").style.borderColor = "red";
            document.getElementById("floor").style.display = "block";
            document.getElementById("lbfloor").innerHTML = "Hãy nhập vị trí tầng";
            status = true;
        }else{

            document.getElementById("floor").style.borderColor = "#D8D8D8";
            document.getElementById("lbfloor").style.display = "none";

        }  

        if ( room== "") {
            document.getElementById("room").style.borderColor = "red";
            document.getElementById("room").style.display = "block";
            document.getElementById("lbroom").innerHTML = "Hãy nhập vị trí phòng";
            status = true;
        }else{

            document.getElementById("room").style.borderColor = "#D8D8D8";
            document.getElementById("lbroom").style.display = "none";

        }

        if ( purpose== "") {
            document.getElementById("purpose").style.borderColor = "red";
            document.getElementById("purpose").style.display = "block";
            document.getElementById("lbpurpose").innerHTML = "Hãy nhập mục đích thuê";
            status = true;
        }else{

            document.getElementById("purpose").style.borderColor = "#D8D8D8";
            document.getElementById("lbpurpose").style.display = "none";

        }if ( to== "") {
            document.getElementById("to").style.borderColor = "red";
            document.getElementById("to").style.display = "block";
            document.getElementById("lbto").innerHTML = "Hãy nhập thời hạn hợp đồng";
            status = true;
        }else{

            document.getElementById("to").style.borderColor = "#D8D8D8";
            document.getElementById("lbto").style.display = "none";

        }

        if ( from== "") {
            document.getElementById("from").style.borderColor = "red";
            document.getElementById("from").style.display = "block";
            document.getElementById("lbfrom").innerHTML = "Hãy nhập thời hạn hợp đồng";
            status = true;
        }else{

            document.getElementById("from").style.borderColor = "#D8D8D8";
            document.getElementById("lbfrom").style.display = "none";

        }

        if ( payment1== "" && payment2 == false) {
            document.getElementById("payment1").style.borderColor = "red";
            document.getElementById("payment1").style.display = "block";
            document.getElementById("lbpayment1").innerHTML = "Hãy chọn kỳ thanh toán";
            document.getElementById("lbpayment2").innerHTML = "Hãy chọn kỳ thanh toán";
            status = true;
        }else{

            document.getElementById("payment1").style.borderColor = "#D8D8D8";
            document.getElementById("lbpayment1").style.display = "none";
            document.getElementById("lbpayment2").style.display = "none";

        } 

        

        if ( totalcost== "") {
            document.getElementById("totalcost").style.borderColor = "red";
            document.getElementById("totalcost").style.display = "block";
            document.getElementById("lbtotalcost").innerHTML = "Hãy nhập giá trị hợp đồng";
            status = true;
        }else if (isNaN(totalcost)==true){
            document.getElementById("totalcost").style.borderColor = "red";
            document.getElementById("totalcost").style.display = "block";
            document.getElementById("lbtotalcost").innerHTML = "Hãy nhập đúng định dạng";
            status = true;
        }else{

            document.getElementById("totalcost").style.borderColor = "#D8D8D8";
            document.getElementById("lbtotalcost").style.display = "none";

        } 

        if ( currency== "") {
            document.getElementById("currency").style.borderColor = "red";
            document.getElementById("currency").style.display = "block";
            document.getElementById("lbcurrency").innerHTML = "Hãy chọn đơn vị tiền tệ";
            status = true;
        }else{

            document.getElementById("currency").style.borderColor = "#D8D8D8";
            document.getElementById("lbcurrency").style.display = "none";

        }

        
        if (status == true) {
            return false;
        } else {
            return true;
        }
    }
</script>
<style>
    #result, #result2 {
        display: none;
    }
    #result ul,#result2 ul {
     list-style: none;
     border: 1px solid grey;box-shadow: 2px 2px black; 
     width: 100%;
     height: 150px;
     overflow: auto;
    }
    #result ul li,#result2 ul li {
    padding: 10px 0;
    font-weight: 600;

    }

    #result ul li:hover {
        background-color: #7eaee1;
        color: white;
        cursor: pointer;
    }

    #result2 ul li:hover{
        background-color: #7eaee1;
        color: white;
        cursor: pointer;
    }
</style>
 <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Thêm mới hợp đồng</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;padding: 10px 10px; "><b>Thêm mới hợp đồng</b></h3>
                        </div>
                        <div class="fixed-table-body">
                             @if(Session::has('thanhcong'))
                                <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
                                @endif
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                             <form class="col-sm-8 form-horizontal col-sm-offset-2" enctype="multipart/form-data" method="post" action="{{route('admin.save_contract')}}" onsubmit="return checkValidate();">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.1. Mã số thuế</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="taxcode" name="taxcode" placeholder="Mã số thuế">
                                            <div id="result">
                                            </div>
                                            <div style="color: red;" id="lbtaxcode"></div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.2. Tên chủ nhà</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="fullname" name="fullname" id="name" placeholder="Tên chủ nhà">
                                            <span style="color: red;" id="lbfullname"></span>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.3. Mã tài sản</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="propertycode" name="propertycode" id="name" placeholder="Mã tài sản">
                                            <div id="result2">
                                            </div>
                                            <div style="color: red;" id="lbpropertycode"></div>

                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function(){

                                            $('#propertycode').blur(function(){
                                                var taxcode = $('#taxcode').val();
                                                var propertycode = $('#propertycode').val();
                                                var _token = $('input[name="_token"]').val();
                                                $.ajax({
                                                    url: "{{route('admin.check_property')}}",
                                                    data:{taxcode:taxcode,propertycode:propertycode,_token:_token},
                                                    type: "post",
                                                    success: function(data){
                                                     $('#lbpropertycode').html(data);
                                                    }
                                                }); 
                                            });

                                            $('#taxcode').keyup(function(){
                                                var taxcode = $('#taxcode').val();
                                                var key = $(this).val();
                                                var _token = $('input[name="_token"]').val();
                                                 $('#result').slideDown(300);
                                                $.ajax({
                                                    url: "{{route('admin.getProperty')}}",
                                                    data:{key:key,_token:_token},
                                                    type: "post",
                                                    success: function(data){
                                                     $('#result').html(data);
                                                     $('#result ul li').click(function(){
                                                            var result = $(this).html();
                                                            var taxcode = $(this).html();
                                                            $('#taxcode').val(result);
                                                            $('#result').slideUp(300);
                                                             $.ajax({
                                                                url: "{{route('admin.check_taxcode')}}",
                                                                data:{taxcode:taxcode,_token:_token},
                                                                type: "post",
                                                                success: function(data){

                                                                   $('#lbtaxcode').html(data);
                                                               }
                                                             }); 
                                                            $.ajax({
                                                                url: "{{route('admin.getNameByTaxcode')}}",
                                                                data:{result:result,_token:_token},
                                                                type: "post",
                                                                success: function(data){
                                                                   $('#fullname').val(data);
                                                               }
                                                           }); 
                                                            $.ajax({
                                                                url: "{{route('admin.getPropertyById')}}",
                                                                data:{result:result,_token:_token},
                                                                type: "post",
                                                                success: function(data){
                                                                   $('#result2').slideDown(300);
                                                                   $('#result2').html(data);
                                                                   $('#result2 ul li').click(function(){
                                                                    var kq = $(this).html();
                                                                    $('#propertycode').val(kq);
                                                                    $('#result2').slideUp(300);
                                                                 });
                                                               }
                                                           }); 
                                                           
                                                       });
                                                     }
                                                });
                                               
                                            });

                                           
                                        });
                                    </script>
                                           
                                    <div class="form-group">
                                        <label for="phoneNumber" class="col-sm-2 control-label">1.4. Hình thức</label>
                                        <div class="col-sm-8">
                                            <select name="method" id="method" class="form-control" id="">
                                                <option value="">Chọn hình thức</option>
                                                <option value="1">Mượn </option>
                                                <option value="2">Thuê</option>
                                            </select>
                                            <span style="color: red;" id="lbmethod"></span>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="MST" class="col-sm-2 control-label">1.5. Khách hàng thuê</label><br>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.5.1 Tên</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="customername" name="customername" placeholder="Tên khách hàng"  class="form-control">
                                                    <span style="color: red;" id="lbcustomername"></span>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.5.2 Điện thoại</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="customerphone" name="customerphone" placeholder="Điện thoại" class="form-control">
                                                    <span style="color: red;" id="lbcustomerphone"></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="MST" class="col-sm-2 control-label">1.6. Nhà thuê</label><br>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.6.1 Diện tích</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="area" name="area" placeholder="Diện tích"  class="form-control">
                                                    <span style="color: red;" id="lbarea"></span>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.6.2 Tầng số</label>
                                                <div class="col-sm-8">
                                                    <input type="number" id="floor" name="floor" placeholder="Tầng" class="form-control">
                                                    <span style="color: red;" id="lbfloor"></span>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.6.3 Phòng số</label>
                                                <div class="col-sm-8">
                                                    <input type="number" id="room" name="room" placeholder="Phòng" class="form-control">
                                                    <span style="color: red;" id="lbroom"></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.7. Mục đích thuê</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="purpose" name="purpose" class="form-control" id="name" placeholder="Mục đích thuê">
                                            <span style="color: red;" id="lbpurpose"></span>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="MST" class="col-sm-2 control-label">1.8. Thời hạn hợp đồng</label><br>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="MST"  class="col-sm-2 control-label">1.8.1 Từ ngày</label>
                                                <div class="col-sm-8">
                                                    <input type="date" onblur="return formatDate();" id="from"  placeholder="Chọn ngày"  class="form-control">
                                                    <input type="hidden" id="from2" name="from">
                                                    <span style="color: red;" id="lbfrom"></span>

                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.8.2 Đến ngày</label>
                                                <div class="col-sm-8">
                                                    <input type="date"  onblur="return formatDate();" id="to" placeholder="Chọn ngày" class="form-control">
                                                     <input type="hidden" id="to2" name="to">
                                                    <span style="color: red;" id="lbto"></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function formatDate(){
                                           var date = document.getElementById("from").value;
                                           var newdate = moment(date).format('DD-MM-YYYY'); 
                                           var date2 = document.getElementById("to").value;
                                           var newdate2 = moment(date2).format('DD-MM-YYYY');

                                           document.getElementById("from2").value = newdate;
                                           document.getElementById("to2").value = newdate2;
                                       }
                                   </script>
                                     <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.9. Kỳ thanh toán</label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.9.1 Theo tháng</label>
                                                <div class="col-sm-8">
                                                    <input type="number" id="payment1" name="payment" placeholder="Nhập số tháng" class="form-control">
                                                    <span style="color: red;" id="lbpayment1"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.9.2 Theo năm</label>
                                                <div class="col-sm-8">
                                                    <input type="checkbox" value="0" id="payment2" name="payment">
                                                    <span style="color: red;" id="lbpayment2"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.10. Giá toàn bộ hợp đồng/tháng </label>
                                        <div class="col-sm-8">
                                            <input type="text" id="totalcost" name="totalcost" class="form-control" id="name" placeholder="Giá hợp đồng">
                                            <span style="color: red;" id="lbtotalcost"></span>

                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.11. Đơn vị tiền tệ</label>
                                        <div class="col-sm-8">
                                            <select type="text" id="currency" name="currency" class="form-control">
                                                <option value="">Chọn đơn vị tiền tệ</option>
                                                @foreach($data as $v)
                                                <option value="{{$v->price}}">{{$v->name}}</option>
                                                @endforeach
                                            </select>
                                            <span style="color: red;" id="lbcurrency"></span>

                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.12. File đính kèm</label>
                                        <div class="col-sm-8">
                                             <input type="file" name="file" class="form-control">
                                        </div>
                                    </div>
                                    <input type="hidden" id="currency2" name="currency_name">
                                    <script>
                                        $(document).ready(function(){
                                            $('#currency').change(function(){
                                                var val = $("#currency option:selected").text();;
                                                $('#currency2').val(val);
                                            });
                                        });
                                    </script>
                                    <div class="form-group">
                                      <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success" style="margin-left: 15%;"><i class="fa fa-wrench"></i> Thêm mới hợp đồng</button>
                                        <a href="{{route('admin.create_tax')}}" title="Kê khai tài sản" class="btn btn-warning"><i class="fas fa-directions"></i> Kê khai thuế</a>
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