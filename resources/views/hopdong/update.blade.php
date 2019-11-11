@extends('master')

@section('content')
<script>
    function checkValidate() {
       
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
        var reg = /^([0-9]{2})\-([0-9]{2})\-([0-9]{4})$/;
       
        var status = false; //Biến trạng thái


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
        }else if ( !to.match(reg)) {
            document.getElementById("to").style.borderColor = "red";
            document.getElementById("to").style.display = "block";
            document.getElementById("lbto").innerHTML = "Ngày không đúng định dạng dd-mm-yy";
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
        }else if ( !from.match(reg)) {
            document.getElementById("from").style.borderColor = "red";
            document.getElementById("from").style.display = "block";
            document.getElementById("lbfrom").innerHTML = "Ngày không đúng định dạng dd-mm-yy";
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
        }else{

            document.getElementById("totalcost").style.borderColor = "#D8D8D8";
            document.getElementById("lbtotalcost").style.display = "none";

        } 

        if ( currency== "") {
            document.getElementById("currency").style.borderColor = "red";
            document.getElementById("currency").style.display = "block";
            document.getElementById("lbcurrency").innerHTML = "Hãy nhập đơn vị tiền tệ";
            status = true;
        }else{

            document.getElementById("currency").style.borderColor = "#D8D8D8";
            document.getElementById("lbcurrency").style.display = "none";

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
            <div class="panel-heading"><b><i class="fa fa-home"></i>/ Cập nhật hợp đồng</b></div>
            <div class="panel-body"> 
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;padding: 10px 10px; "><b>CẬP NHẬT THÔNG TIN HỢP ĐỒNG</b><br><br>(<span style="color: red;"><b>{{$data[0]['contract_code']}}</b></span>)</h3>
                        </div>
                        <div class="fixed-table-body">
                             @if(Session::has('thanhcong'))
                                <div class="alert alert-danger">
                                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                   {{Session::get('thanhcong')}}
                               </div>
                             @endif
                            
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                             <form class="col-sm-8 form-horizontal col-sm-offset-2"  enctype="multipart/form-data" action="{{route('admin.change_contract')}}" method="post" onsubmit="return checkValidate();"  method="get" >
                                    @csrf
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="id_contract" value="{{$data[0]['id']}}">
                                    <div class="form-group">
                                        <label for="phoneNumber" class="col-sm-2 control-label">(*) Thay đổi (Nếu có)</label>
                                        <div class="col-sm-8">
                                            <select name="change" class="form-control" id="change">
                                                <option value="">Chọn thay đổi</option>
                                                <option value="Gia hạn/thanh lý">Gia hạn/thanh lý </option>
                                                <option value="Thay đổi HĐ từ hộ">Thay đổi HĐ từ hộ</option>
                                                <option value="Thay đổi HĐ do cơ quan thuế yêu cầu">Thay đổi HĐ do cơ quan thuế yêu cầu</option>
                                            </select>
                                            <div style="color: red;" id="lbchange"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.1. Mã số thuế</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{$data[0]['tax_code']}}" class="form-control" id="taxcode" name="taxcode" placeholder="Mã số thuế" disabled>
                                            <div id="result">
                                            </div>
                                            <div style="color: red;" id="lbtaxcode"></div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.2. Tên chủ nhà</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{$data[0]['fullname']}}" class="form-control" id="fullname" name="fullname" id="name" placeholder="Tên chủ nhà" disabled>
                                            <span style="color: red;" id="lbfullname"></span>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.3. Mã tài sản</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{$data[0]['property_code']}}" class="form-control" id="propertycode" name="propertycode" id="name" placeholder="Mã tài sản" disabled>
                                            <div id="result2">
                                            </div>
                                            <div style="color: red;" id="lbpropertycode"></div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNumber" class="col-sm-2 control-label">1.4. Hình thức</label>
                                        <div class="col-sm-8">
                                            <select name="method" id="method" class="form-control" id="">
                                                @if($data[0]['method']=='Mượn')
                                                <option value="1">Mượn </option>
                                                <option value="2">Thuê</option>
                                                @elseif($data[0]['method']=='Thuê')
                                                <option value="2">Thuê</option>
                                                <option value="1">Mượn </option>
                                                @endif
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
                                                    <input type="text" id="customername" name="customername" placeholder="Tên khách hàng" value="{{$data[0]['customer_name']}}"  class="form-control">
                                                </div>
                                                <div style="color: red;" id="lbcustomername"></div>

                                            </div>
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.5.2 Điện thoại</label>
                                                <div class="col-sm-8">
                                                    <input type="number" id="customerphone" name="customerphone" placeholder="Điện thoại" value="{{$data[0]['customer_phone']}}" class="form-control">
                                                </div>
                                                <div style="color: red;" id="lbcustomerphone"></div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="MST" class="col-sm-2 control-label">1.6. Nhà thuê</label><br>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.6.1 Diện tích</label>
                                                <div class="col-sm-8">
                                                    <input type="number" id="area" name="area" placeholder="Diện tích" value="{{$data[0]['area']}}" class="form-control">
                                                </div>
                                               <div style="color: red;" id="lbarea"></div>

                                            </div>
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.6.2 Tầng số</label>
                                                <div class="col-sm-8">
                                                    <input type="number" id="floor" name="floor" placeholder="Tầng" value="{{$data[0]['floor']}}" class="form-control">
                                                </div>
                                                <div style="color: red;" id="lbfloor"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.6.3 Phòng số</label>
                                                <div class="col-sm-8">
                                                    <input type="number" id="room" name="room" placeholder="Phòng" value="{{$data[0]['room']}}" class="form-control">
                                                </div>
                                                <div style="color: red;" id="lbroom"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.7. Mục đích thuê</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="purpose" class="form-control" name="purpose" value="{{$data[0]['purpose']}}" placeholder="Mục đích thuê">
                                        </div>
                                        <div style="color: red;" id="lbpurpose"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="MST" class="col-sm-2 control-label">1.8. Thời hạn hợp đồng</label><br>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.8.1 Từ ngày (Ngày-Tháng-Năm)</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="from" name="from" placeholder="Nhập ngày (ngày-tháng-năm)" value="{{$data[0]['from']}}" class="form-control">
                                                    <div style="color: red;" id="lbfrom"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.8.2 Đến ngày (Ngày-Tháng-Năm)</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="to" name="to" placeholder="Nhập ngày (ngày-tháng-năm)" value="{{$data[0]['to']}}" class="form-control">
                                                    <div style="color: red;" id="lbto"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.9. Kỳ thanh toán</label>
                                        @if($data[0]['payment']==0)
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
                                                    <input type="checkbox" value="0" id="payment2" name="payment" checked>
                                                    <span style="color: red;" id="lbpayment2"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                         <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.9.1 Theo tháng</label>
                                                <div class="col-sm-8">
                                                    <input type="number" id="payment1" name="payment" placeholder="Nhập số tháng" value="{{$data[0]['payment']}}" class="form-control">
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
                                        @endif
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.10. Giá toàn bộ hợp đồng</label>
                                        <div class="col-sm-8">
                                            <input type="number" id="totalcost" name="totalcost" class="form-control" value="{{$contract_price}}" id="name" placeholder="Giá">
                                        </div>
                                        <div style="color: red;" id="lbtotalcost"></div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">1.11. Đơn vị tiền tệ</label>
                                        <div class="col-sm-8">
                                           <select type="text" id="currency" name="currency" class="form-control">
                                                <option value="{{$price}}">{{$currency}}</option>
                                                @foreach($data2 as $v)
                                                <option value="{{$v->price}}">{{$v->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="color: red;" id="lbcurrency"></div>
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
                                        <label for="name" class="col-sm-2 control-label">1.12. File đính kèm</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="file"  class="form-control">
                                            <div style="background-color: #eee;padding: 10px;text-align: center;">
                                                <a title="Xem chi tiết" href="{{url('/public').'/contract/'.$data[0]['file']}}"><b class="show-file">{{$data[0]['file']}}</b></a>
                                                @if($data[0]['file']!=null)
                                                <span class="delete-file" style="cursor: pointer;background: black;padding: 1px 5px 1px 5px;border-radius: 50%;" title="Xóa file"><i style="color: red;"  class="fa fa-close"></i></span>
                                                @endif

                                                <input type="hidden" value="{{$data[0]['file']}}" class="file2" name="file2">
                                            </div>
                                        </div>
                                        <div style="color: red;" id="lbcurrency"></div>
                                    </div>
                                    
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            var _token = $('input[name="_token"]').val();
                                            var filename = $('.file2').val();
                                            $('input[type="file"]').change(function(e){
                                                var fileName = e.target.files[0].name;
                                                $('.show-file').text(fileName);
                                                $('.delete-file').hide();
                                            });

                                            $('.delete-file').click(function(){
                                                 $.ajax({
                                                    url: "{{route('admin.delete_file')}}",
                                                    data:{filename:filename,_token:_token},
                                                    type: "post",
                                                    success: function(){
                                                     $('.delete-file').hide();
                                                     $('.show-file').empty();
                                                    }
                                                }); 

                                            });


                                        });
                                    </script>
                                    <div class="form-group">
                                      <div class="col-sm-offset-2 col-sm-10">
                                         <a href="{{route('admin.detail_contract')}}" class="btn btn-primary" style="margin-left: 25%;"><i class="fa fa-ban"></i> Huỷ</a>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-wrench"></i> Cập nhật</button>
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