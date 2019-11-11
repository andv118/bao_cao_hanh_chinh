@extends('master')

@section('content')
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
                                <form class="col-sm-8 form-horizontal col-sm-offset-2" action="{{route('admin.save_property')}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <h3 style="text-align: center;padding: 10px 10px; "><b>Thu thập tài sản</b></h3>
                                    <div class="form-group">
                                      <label for="name" class="col-sm-2 control-label">1.1. Mã số thuế</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$data3[0]['tax_code']}}" name="taxcode" placeholder="Mã số thuế">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="address" class="col-sm-2 control-label">1.2. Tên chủ nhà</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control"  value="{{$data3[0]['fullname']}}" name="fullname" placeholder="Tên chủ nhà">
                                      </div>
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
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function(){
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

                                             $('#typehouse').change(function(){
                                                var id = $(this).val();
                                                var _token = $('input[name="_token"]').val();
                                                 $.ajax({
                                                    url: "{{route('admin.get_houseprice')}}",
                                                    data:{id:id,_token:_token},
                                                    type: "post",
                                                    success: function(data){
                                                       $('#totalprice').html(data);
                                                       $('#rentprice').html(data);
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                    <input type="hidden" name="location2" id="location2">
                                    <div class="form-group">
                                        <label for="MST" class="col-sm-2 control-label">1.4. Đoạn đường</label>
                                        <div class="col-sm-8">
                                            <div id="loka"></div>
                                            <input type="text" class="form-control" name="road" id="road" placeholder="Đoạn đường">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="MST" class="col-sm-2 control-label">1.5. Vị trí</label>
                                        <div class="col-sm-8">
                                            <select name="location" class="form-control" id="location">
                                                <option>Chọn vị trí</option>
                                            </select>
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
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="MST" class="col-sm-2 control-label">1.7. Quy mô tổng thể</label><br>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.7.1 Số tầng</label>
                                                <div class="col-sm-8">
                                                    <input type="number"  id="totalfloor" name="totalfloor" placeholder="Nhập số tầng tổng thể"  class="form-control">
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.7.2 Giới hạn số tầng</label>
                                                <div class="col-sm-8">
                                                   <select name="totalprice" class="form-control" id="totalprice" required>
                                                       <option value="">Chọn số tầng giới hạn</option>
                                                   </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.7.3 Diện tích</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="totalarea" placeholder="Diện tích tổng thể" class="form-control">
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
                                                      
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.8.2 Giới hạn số tầng</label>
                                                <div class="col-sm-8">
                                                   <select name="rentprice" class="form-control" id="rentprice" required>
                                                       <option value="">Chọn số tầng giới hạn</option>
                                                   </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="MST" class="col-sm-2 control-label">1.8.3 Diện tích</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="rentarea" placeholder="Diện tích cho thuê" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success" style="margin-left: 35%;">Lưu thông tin</button>
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