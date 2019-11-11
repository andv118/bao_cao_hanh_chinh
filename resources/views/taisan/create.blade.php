@extends('master')

@section('content')
<style>
    #result {
        display: none;
    }
    #result ul {
     list-style: none;
     border: 1px solid grey;box-shadow: 2px 2px black; 
     width: 100%;
     height: 150px;
     overflow: auto;
 }
 #result ul li {
    padding: 10px 0;
    font-weight: 600;

}

#result ul li:hover {
    background-color: #7eaee1;
    color: white;
    cursor: pointer;
}
</style>
<script>
    $(document).ready(function(){
       $('#taxcode').keyup(function(){
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
                        $('#taxcode').val(result);
                        $('#result').slideUp(300);
                        $.ajax({
                                url: "{{route('admin.getNameByTaxcode')}}",
                                data:{result:result,_token:_token},
                                type: "post",
                                success: function(data){
                                 $('#fullname').val(data);
                             }
                        }); 
                    });
                }
            });
       });
       
       $('#name_street').change(function(){
            var id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('admin.get_street')}}",
                data:{id:id,_token:_token},
                type: "post",
                success: function(data){
                   $('#road').val(data);
                }
            }); 
            $.ajax({
                url: "{{route('admin.get_location')}}",
                data:{id:id,_token:_token},
                type: "post",
                success: function(data){
                   $('#location').html(data);
                }
            });
        });

        $('#location').change(function(){
            var val = $("#location option:selected").text();;
            $('#location2').val(val);
        });

         $('#totalfloor').keyup(function(){
            var floor = $(this).val();
            var typehouse = $('#typehouse').val();
            var _token = $('input[name="_token"]').val();
             $.ajax({
                url: "{{route('admin.get_houseprice')}}",
                data:{floor:floor,_token:_token,typehouse:typehouse},
                type: "post",
                success: function(data){
                   $('#totalprice').val(data);
                   $('#rentprice').val(data);
                }
            });
        });
    });
</script>
<script>
  function checkValidate() {
  //Tiến hành lấy dữ liệu trên Form
  var taxcode = document.getElementById("taxcode").value;
  var fullname = document.getElementById("fullname").value;
  var name_street = document.getElementById("name_street").value;
  var road = document.getElementById("road").value;
  var location = document.getElementById("location").value;
  var typehouse = document.getElementById("typehouse").value;
  var totalfloor = document.getElementById("totalfloor").value;
  var totalarea = document.getElementById("totalarea").value;
  var rentfloor = document.getElementById("rentfloor").value;
  var rentarea = document.getElementById("rentarea").value;
  var status = false; //Biến trạng thái
  var re = /([0-9]{10,13})\b/g;
  

  if (taxcode.length != 0 ){
       if(!taxcode.match(re) || (isNaN(taxcode)==true)){
        document.getElementById("taxcode").style.borderColor = "red";
        document.getElementById("taxcode").style.display = "block";
        document.getElementById("lbtaxcode").innerHTML = "Mã số thuế không đúng định dạng (10 số)";
        status = true;
      }else{

        document.getElementById("taxcode").style.borderColor = "#D8D8D8";
        document.getElementById("lbtaxcode").style.display = "none";

      }

  }

  if( fullname == null){
        document.getElementById("fullname").style.borderColor = "red";
        document.getElementById("fullname").style.display = "block";
        document.getElementById("lbfullname").innerHTML = "Tên chủ nhà không được để trống";
        status = true;
  }else{

        document.getElementById("fullname").style.borderColor = "#D8D8D8";
        document.getElementById("lbfullname").style.display = "none";

  }

  if( name_street == null){
        document.getElementById("name_street").style.borderColor = "red";
        document.getElementById("name_street").style.display = "block";
        document.getElementById("lbname_street").innerHTML = "Tuyến phố không được để trống";
        status = true;
  }else{

        document.getElementById("name_street").style.borderColor = "#D8D8D8";
        document.getElementById("lbname_street").style.display = "none";

  }

  if( road == null){
        document.getElementById("road").style.borderColor = "red";
        document.getElementById("road").style.display = "block";
        document.getElementById("lbroad").innerHTML = "Đoạn đường không được để trống";
        status = true;
  }else{

        document.getElementById("road").style.borderColor = "#D8D8D8";
        document.getElementById("lbroad").style.display = "none";

  } 

  if( location == null){
        document.getElementById("location").style.borderColor = "red";
        document.getElementById("location").style.display = "block";
        document.getElementById("lblocation").innerHTML = "Vị trí không được để trống";
        status = true;
  }else{

        document.getElementById("location").style.borderColor = "#D8D8D8";
        document.getElementById("lblocation").style.display = "none";

  }


  if( typehouse == null){
        document.getElementById("typehouse").style.borderColor = "red";
        document.getElementById("typehouse").style.display = "block";
        document.getElementById("lbtypehouse").innerHTML = "Loại nhà không được để trống";
        status = true;
  }else{

        document.getElementById("typehouse").style.borderColor = "#D8D8D8";
        document.getElementById("lbtypehouse").style.display = "none";

  }

  if( totalfloor == null){
    document.getElementById("totalfloor").style.borderColor = "red";
    document.getElementById("totalfloor").style.display = "block";
    document.getElementById("lbtotalfloor").innerHTML = "Số tầng tổng thể không trống";
    status = true;
  }else{

    document.getElementById("totalfloor").style.borderColor = "#D8D8D8";
    document.getElementById("lbtotalfloor").style.display = "none";

  }


 if( totalarea == null){
        document.getElementById("totalarea").style.borderColor = "red";
        document.getElementById("totalarea").style.display = "block";
        document.getElementById("lbtotalarea").innerHTML = "Diện tích tổng thể không được để trống";
        status = true;
  }else{

        document.getElementById("totalarea").style.borderColor = "#D8D8D8";
        document.getElementById("lbtotalarea").style.display = "none";

  }

  if( rentfloor == null){
        document.getElementById("rentfloor").style.borderColor = "red";
        document.getElementById("rentfloor").style.display = "block";
        document.getElementById("lbrentfloor").innerHTML = "Số tầng cho thuê không được để trống";
        status = true;
  }else{

        document.getElementById("rentfloor").style.borderColor = "#D8D8D8";
        document.getElementById("lbrentfloor").style.display = "none";

  }

  if( rentarea == null){
        document.getElementById("rentarea").style.borderColor = "red";
        document.getElementById("rentarea").style.display = "block";
        document.getElementById("lbrentarea").innerHTML = "Diện tích ch thuê không được để trống";
        status = true;
  }else{

        document.getElementById("rentarea").style.borderColor = "#D8D8D8";
        document.getElementById("lbrentarea").style.display = "none";

  }




  if (status == true) {
      return false;
  } else {
      return true;
  }

  }
</script>

 <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Thu thập tài sản</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            
                        </div>
                        <div class="fixed-table-body">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>

                                @if(count($errors)>0)
                                  <div class="alert alert-danger" style="color:white;margin: 20px 0;text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    @foreach($errors->all() as $err)
                                      {{$err}} <br>
                                      @endforeach
                                  </div>
                                @endif
                                @if(Session::has('thanhcong'))
                                <div class="alert alert-success">{{Session::get('thanhcong')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                </div>
                                @endif
                                 
                                
                                <form class="col-sm-8 form-horizontal col-sm-offset-2" action="{{route('admin.save_property')}}" method="post" onsubmit="return checkValidate();">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <h3 style="text-align: center;padding: 10px 10px; "><b>THU THẬP TÀI SẢN</b></h3>

                                    <div class="form-group">
                                      <label for="name" class="col-sm-2 control-label">1.1. Mã số thuế</label>
                                      <div class="col-sm-8">
                                        <input type="text" id="taxcode" class="form-control" name="taxcode" placeholder="Mã số thuế">
                                        <div id="result">
                                        </div>
                                        <div style="color: red;" id="lbtaxcode"></div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="address" class="col-sm-2 control-label">1.2. Tên chủ nhà</label>
                                      <div class="col-sm-8">
                                        <input type="text" id="fullname" class="form-control" name="fullname" placeholder="Tên chủ nhà">
                                      </div>
                                      <div style="color: red;" id="lbfullname"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="CMNN" class="col-sm-2 control-label">1.3. Tuyến phố</label>
                                          <div class="col-sm-8">
                                            <select name="street" class="form-control" id="name_street">
                                                <option >Chọn tuyến phố</option>
                                                @foreach($data  as $v)
                                                <option value="{{$v->id}}">{{$v->name_street}}</option>
                                                @endforeach
                                            </select>
                                            <div style="color: red;" id="lbname_street"></div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="location2" id="location2">
                                    <div class="form-group">
                                        <label for="MST" class="col-sm-2 control-label">1.4. Đoạn đường</label>
                                        <div class="col-sm-8">
                                            
                                            <input type="text" class="form-control" name="road" id="road" placeholder="Đoạn đường">
                                            <div style="color: red;" id="lbroad"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="MST" class="col-sm-2 control-label">1.5. Vị trí</label>
                                        <div class="col-sm-8">
                                            <select name="location" class="form-control" id="location">
                                                <option>Chọn vị trí</option>
                                            </select>
                                            <div style="color: red;" id="lblocation"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNumber" class="col-sm-2 control-label">1.6. Loại nhà</label>
                                        <div class="col-sm-8">
                                            <select name="typehouse" class="form-control" id="typehouse">
                                                <option value="">Chọn loại nhà</option>
                                                @foreach($data2 as $v)
                                                    <option value="{{$v->id}}">{{$v->type_house}}</option>
                                                @endforeach
                                            </select>
                                            <div style="color: red;" id="lbtypehouse"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="MST" class="col-sm-2 control-label">1.7. Quy mô tổng thể</label><br>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.7.1 Số tầng</label>
                                                <div class="col-sm-8">
                                                    <input type="number"  id="totalfloor" name="totalfloor" placeholder="Nhập số tầng tổng thể"  class="form-control">
                                                    <div style="color: red;" id="lbtotalfloor"></div>
                                                </div>
                                            </div> 
                                            <input name="totalprice" type="hidden" class="form-control" id="totalprice" required>
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.7.2 Diện tích</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="totalarea" placeholder="Diện tích tổng thể" class="form-control">
                                                    <div style="color: red;" id="lbtotalarea"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="MST" class="col-sm-2 control-label">1.8. Diện tích cho thuê</label><br>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.8.1 Số tầng</label>
                                                <div class="col-sm-8">
                                                    <input type="number" id="rentfloor" name="rentfloor" placeholder="Nhập số tầng cho thuê"  class="form-control">
                                                    <div style="color: red;" id="lbrentfloor"></div>
                                                      
                                                </div>
                                            </div>
                                            <input name="rentprice" type="hidden" class="form-control" id="rentprice" >
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.8.2 Diện tích</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="rentarea" placeholder="Diện tích cho thuê" class="form-control">
                                                    <div style="color: red;" id="lbrentarea"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success" style="margin-left: 15%;">Lưu thông tin</button>
                                         <a href="{{route('admin.create_contract')}}" title="Kê khai hợp đồng" class="btn btn-warning"><i class="fas fa-directions"></i> Kê khai hợp đồng</a>
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