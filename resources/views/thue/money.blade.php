@extends('master')

@section('content')
<script>
    function checkValidate() {
        //Tiến hành lấy dữ liệu trên Form
        var contractcode = document.getElementById("contractcode").value;
        var declare = document.getElementById("declare").value;
        var payed = document.getElementById("payed").value;
        var payeddate = document.getElementById("payeddate").value;
        var status = false; //Biến trạng thái

            if ( contractcode== "") {
                document.getElementById("contractcode").style.borderColor = "red";
                document.getElementById("contractcode").style.display = "block";
                document.getElementById("lbcontractcode").innerHTML = "Hãy nhập mã hợp đồng kê khai";
                status = true;
            }else{
                
                    document.getElementById("contractcode").style.borderColor = "#D8D8D8";
                    document.getElementById("lbcontractcode").style.display = "none";
                
            }

            if ( declare== "") {
                document.getElementById("declare").style.borderColor = "red";
                document.getElementById("declare").style.display = "block";
                document.getElementById("lbdeclare").innerHTML = "Hãy chọn kỳ kê khai";
                status = true;
            }else{

                document.getElementById("declare").style.borderColor = "#D8D8D8";
                document.getElementById("lbdeclare").style.display = "none";
                
            }

            if (payed == "") {
                document.getElementById("payed").style.borderColor = "red";
                document.getElementById("payed").style.display = "block";
                document.getElementById("lbpayed").innerHTML = "Hãy nhập số tiền nộp";
                status = true;
            }else{

                document.getElementById("payed").style.borderColor = "#D8D8D8";
                document.getElementById("lbpayed").style.display = "none";

            }  

            if (payeddate == "") {
                document.getElementById("payeddate").style.borderColor = "red";
                document.getElementById("payeddate").style.display = "block";
                document.getElementById("lbpayeddate").innerHTML = "Hãy nhập ngày nộp tiền";
                status = true;
            }else{

                document.getElementById("payeddate").style.borderColor = "#D8D8D8";
                document.getElementById("lbpayeddate").style.display = "none";

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
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Nộp thuế</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                              <h3 style="text-align: center;"><b>NỘP THUẾ</b></h3>
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
                                @if(Session::has('thanhcong'))
                                <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
                                @endif
                                <form class="col-sm-8 form-horizontal col-sm-offset-2" action="{{route('admin.save_tax_declare')}}" method="post" onsubmit="return checkValidate();">
                                           
                                 <div class="form-group"  id="date1">
                                    <label class="col-sm-2 control-label">1. Hợp đồng</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="contractcode" name="contractcode" class="form-control" placeholder="Nhập hợp đồng kê khai thuế">
                                    </div>
                                    <div style="color: red;" id="lbcontractcode"></div>

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
                                                        url: "{{route('admin.get_declare')}}",
                                                        data:{val:val,_token:_token},
                                                        type: "post",
                                                        success: function(data){
                                                          $('#declare').html(data);
                                                        }
                                                    }); 
                                               });
                                    });
                                </script>
                                 <div class="form-group"  id="date1">
                                    <label class="col-sm-2 control-label">2. Chọn kỳ kê khai</label>
                                    <div class="col-sm-8">
                                        <select name="declare" class="form-control" id="declare">
                                            <option value="">Chọn kỳ kê khai</option>
                                        </select>
                                    </div>
                                    <div style="color: red;" id="lbdeclare"></div>

                                </div> 
                                 <div class="form-group"  id="date1">
                                    <label class="col-sm-2 control-label">3. Số tiền nộp</label>
                                    <div class="col-sm-8">
                                        <input type="text"  id="payed" name="payed" class="form-control number-separator" placeholder="Nhập số tiền">
                                    </div>
                                    <div style="color: red;" id="lbpayed"></div>

                                </div> 
                                <script>
                                    $(document).ready(function () {

                                            // Currency Separator
                                            var commaCounter = 10;

                                            function numberSeparator(Number) {
                                                Number += '';

                                                for (var i = 0; i < commaCounter; i++) {
                                                    Number = Number.replace(',', '');
                                                }

                                                x = Number.split('.');
                                                y = x[0];
                                                z = x.length > 1 ? '.' + x[1] : '';
                                                var rgx = /(\d+)(\d{3})/;

                                                while (rgx.test(y)) {
                                                    y = y.replace(rgx, '$1' + ',' + '$2');
                                                }
                                                commaCounter++;
                                                return y + z;
                                            }

                                            $(document).on('keypress , paste', '.number-separators', function (e) {
                                                if (/^-?\d*[,.]?(\d{0,3},)*(\d{3},)?\d{0,3}$/.test(e.key)) {
                                                    $('.number-separator').on('input', function () {
                                                        e.target.value = numberSeparator(e.target.value);
                                                    });
                                                } else {
                                                    e.preventDefault();
                                                    return false;
                                                }
                                            });

                                            $('.number-separators').blur(function(){
                                                var kq = $(this).val();
                                                alert(kq-1);
                                            });


                                        });
                                </script>

                                <div class="form-group"  id="date1">
                                    <label class="col-sm-2 control-label">4. Ngày nộp tiền</label>
                                    <div class="col-sm-8">
                                        <input type="date" id="payeddate" onblur="return formatDate();" class="form-control" placeholder="Ngày nộp tiền">
                                        <input type="hidden" id="payeddate2" name="payeddate">
                                    </div>
                                    <div style="color: red;" id="lbpayeddate"></div>

                                </div>
                                <script>
                                    function formatDate(){
                                       var date = document.getElementById("payeddate").value;
                                       var newdate = moment(date).format('DD-MM-YYYY'); 
                                       document.getElementById("payeddate2").value = newdate;
                                   }
                               </script>
                                            
                                   
                                    <div class="form-group">
                                      <div class="col-sm-offset-2 col-sm-10" >
                                        <button type="submit" class="btn btn-success" style="margin-left: 200px;"><i class="fas fa-save"></i> <b>Lưu</b></button>
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