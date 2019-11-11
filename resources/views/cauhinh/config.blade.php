 @extends('master')

 @section('content')
<div class="panel panel-default">
  <div class="panel-heading"><b><i class="fa fa-home"></i>/Cấu hình thông số</b></div>
  <div class="panel-body">
      <div class="bootstrap-table">
          <div class="fixed-table-toolbar">
            @if(Session::has('message'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>{{Session::get('message')}}</strong>
                </div>
            @endif
          </div>

          <div class="fixed-table-container">
            <div class="fixed-table-header">
                <h3 style="text-align: center;"><b><i class="fa fa-users-cog"></i> CẤU HÌNH THÔNG SỐ</b></h3>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b>Lãi suất </b></a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Tỷ giá tiền tệ </b></a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false"><b>Giá nhà </b></a>
                        </li> 
                        <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false"><b>Giá đất </b></a>
                        </li> 
                        <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false"><b>Chữ ký người đại diện </b></a>
                        </li>
                      </ul>

                      <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h3 class="modal-title" style="color: green;text-align: center;"><b>THÊM TUYẾN PHỐ</b></h3>
                            </div>
                            <div class="modal-body">
                                 <form action="{{route('admin.insert_landcost')}}" method="post">
                                  @csrf
                                  <label for="fullname">Tên tuyến phố :</label>
                                  <input type="text"  name="name" class="form-control"  required="required"><br>

                                  <label for="email">Đoạn đường bắt đầu :</label>
                                  <input type="text"  class="form-control"  name="from"  required="required">
                                  <br> 
                                  <label for="email">Đoạn đường kết thúc :</label>
                                  <input type="text"  class="form-control"  name="to"  required="required">
                                  <br>
                                  <label for="email">Chọn phường :</label>
                                  <select name="street" class="form-control" required>
                                     <option value="">Chọn phường</option>
                                     @foreach($data2 as $v)
                                     <option value="{{$v->id}}">{{$v->street_name}}</option>
                                     @endforeach
                                  </select>
                                  <br>
                                   <label for="email">VT1 :</label>
                                  <input type="number"  class="form-control"  name="vt1"  required="required">
                                  <br>
                                   <label for="email">VT2 :</label>
                                  <input type="number"  class="form-control"  name="vt2"  required="required">
                                  <br>
                                   <label for="email">VT3 :</label>
                                  <input type="number"  class="form-control"  name="vt3"  required="required">
                                  <br>
                                   <label for="email">VT4 :</label>
                                  <input type="number"  class="form-control"  name="vt4"  required="required">
                                  <br>
                                  <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-refresh"></span>Thêm mới</button>
                                </form> 
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>

                      <div id="addhouse" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h3 class="modal-title" style="color: green;text-align: center;"><b>THÊM GIÁ NHÀ</b></h3>
                            </div>
                            <div class="modal-body">
                                 <form action="{{route('admin.insert_houseprice')}}" method="post">
                                  @csrf
                                  <label for="fullname">Số tầng nhỏ nhất :</label>
                                  <input type="number"  name="floor_from" class="form-control"  required="required"><br>

                                  <label for="email">Số tầng lớn nhất :</label>
                                  <input type="number"  class="form-control"  name="floor_to"  required="required">
                                  <br> 
                                  <label for="email">Giá nhà (VNĐ) :</label>
                                  <input type="number"  class="form-control"  name="price"  required="required">
                                  <br>
                                  <label for="email">Loại nhà :</label>
                                  <select name="house" class="form-control" required>
                                     <option value="">Chọn loại nhà</option>
                                     @foreach($data6 as $v)
                                     <option value="{{$v->id}}">{{$v->type_house}}</option>
                                     @endforeach
                                  </select>
                                  <br>
                                  <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-refresh"></span> Thêm mới</button>
                                </form> 
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>

                       <div id="addcurrency" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h3 class="modal-title" style="color: green;text-align: center;"><b>THÊM TỶ GIÁ TIỀN TỆ</b></h3>
                            </div>
                            <div class="modal-body">
                                 <form action="{{route('admin.insert_currency')}}" method="post">
                                  @csrf
                                  <label for="">Đơn vị tiền :</label>
                                  <input type="text"  name="unit" class="form-control" placeholder="Nhập tên đơn vị tiền" required="required"><br>

                                  <label for="">Tỷ giá so với VNĐ :</label>
                                  <input type="text"  class="form-control" placeholder="Nhập tỷ giá"  name="price"  required="required">
                                  <br> 
                                  
                                  <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-refresh"></span>Thêm mới</button>
                                </form> 
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>

                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                             <form action="{{route('admin.update_interest')}}" method="post">
                                 @csrf
                                 <input type="hidden" name="id" value="{{$data3[0]['id']}}">
                                <label for="fullname">Lãi suất hiện tại (%) :</label>
                                <input type="text"  value="{{$data3[0]['rate']*100}} %" class="form-control" ><br>

                                <label for="email">Lãi suất mới * :</label>
                                <input type="text" id="email" class="form-control" name="rate"  required>
                                <br>
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span>  Cập nhật</button>
                             </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <button class="btn btn-primary"  data-toggle="modal" data-target="#addcurrency"><i class="fas fa-plus-square"></i> Thêm đơn vị tiền </button>
                          <table class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action">
                              <thead>
                                <tr>
                                  <th style="text-align: center;">STT</th>
                                  <th style="text-align: center;">Đơn vị tiền </th>
                                  <th style="text-align: center;">Tỷ giá so với VNĐ</th>
                                  <th style="text-align: center;">Cập nhật</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $stt = 0; ?>
                                @foreach($data4 as $v)
                                <tr>
                                  <td style="text-align: center;"><?php $stt+=1; echo $stt; ?></td>
                                  <td style="text-align: center;">{{$v->name}}</td>
                                  <td style="text-align: center;">{{$v->price}}</td>
                                  <td style="text-align: center;"><button data-toggle="modal" data-target="#currency{{$v->id}}" class="btn btn-danger"><i class="fa fa-edit"></i> Cập nhật</button></td>
                                  <div id="currency{{$v->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h3 class="modal-title" style="color: grey;text-align: center;"><b>CẬP NHẬT TIỀN TỆ</b></h3>
                                        </div>
                                        <div class="modal-body">
                                         <form action="{{route('admin.update_currency')}}" method="post">
                                          @csrf
                                          <input type="hidden" name="id" value="{{$v->id}}">
                                          <label for="fullname">Loại tiền : <b style="color: red;">{{$v->name}}</b></label><br>

                                          <label for="email">Tỷ giá so với vnđ :</label>
                                          <input type="number"  value="{{$v->price}}"  class="form-control"  name="price"  required="required">
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
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                               <button class="btn btn-primary"  data-toggle="modal" data-target="#addhouse"><i class="fas fa-plus-square"></i> Thêm giá nhà </button>
                              <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                                 <thead>
                                  <tr>
                                    <th colspan="1" style="text-align: center;">STT</th>
                                    <th colspan="1" style="text-align: center;">Loại nhà</th>
                                    <th colspan="1" style="text-align: center;">Số tầng</th>
                                    <th colspan="1" style="text-align: center;">Giá (vnđ)</th>
                                    <th colspan="1" style="text-align: center;">Cập nhật</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $stt = 0; ?>
                                  @foreach($data5 as $v)
                                  <tr>
                                    <td style="text-align: center;"><?php $stt+=1; echo $stt; ?></td>
                                    <td style="text-align: center;">{{$v->type_house}}</td>
                                    <td style="text-align: center;">Từ {{$v->floor_from}} Đến {{$v->floor_to}} tầng</td>
                                    <td style="text-align: center;">{{number_format($v->price)}}</td>
                                  </td>
                                  <td style="text-align: center;"><button class="btn btn-danger"  data-toggle="modal" data-target="#pricehouse{{$v->id}}" style="color: orange;"><i class="fa fa-edit"></i> Cập nhật</button></td>
                                  <div id="pricehouse{{$v->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h3 class="modal-title" style="color: grey;text-align: center;"><b>CẬP NHẬT GIÁ NHÀ</b></h3>
                                        </div>
                                        <div class="modal-body">
                                         <form action="{{route('admin.update_pricehouse')}}" method="post">
                                          @csrf
                                          <input type="hidden" name="id" value="{{$v->id}}">
                                          <label for="fullname">Loại nhà : <b style="color: red;">{{$v->type_house}}</b></label><br>

                                          <label for="email">Số tầng : Từ {{$v->floor_from}} Đến {{$v->floor_to}} tầng</label><br>
                                           
                                         
                                          <label for="email">Giá :</label>
                                          <input type="number"  value="{{$v->price}}"  class="form-control"  name="price"  required="required">
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

                              {{$data5->links()}}
                        </div>
                         <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                              <button class="btn btn-primary"  data-toggle="modal" data-target="#myModal"><i class="fas fa-plus-square"></i> Thêm tuyến phố</button>
                              <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action" id="content">
                                 <thead>
                                  <tr>
                                    <th colspan="1" style="text-align: center;">STT</th>
                                    <th colspan="1" style="text-align: center;">Tên tuyến phố</th>
                                    <th colspan="1" style="text-align: center;">Đoạn đường bắt đầu</th>
                                    <th colspan="1" style="text-align: center;">Đoạn đường kết thúc</th>
                                    <th colspan="1" style="text-align: center;">Phường</th>
                                    <th colspan="1" style="text-align: center;">VT1 (Đơn vị : VNĐ)</th>
                                    <th colspan="1" style="text-align: center;">VT2 (Đơn vị : VNĐ)</th>
                                    <th colspan="1" style="text-align: center;">VT3 (Đơn vị : VNĐ)</th>
                                    <th colspan="1" style="text-align: center;">VT4 (Đơn vị : VNĐ)</th>
                                    <th colspan="1" style="text-align: center;">Cập nhật</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $stt = 0; ?>
                                  @foreach($data as $v)
                                  <tr>
                                    <td style="text-align: center;"><?php $stt+=1; echo $stt; ?></td>
                                    <td style="text-align: center;">{{$v->name_street}}</td>
                                    <td style="text-align: center;">{{$v->from}}</td>
                                    <td style="text-align: center;">{{$v->to}}</td>
                                    <td style="text-align: center;">{{$v->street_name}}</td>
                                    <td style="text-align: center;">{{number_format($v->VT1)}}</td>
                                    <td style="text-align: center;">{{number_format($v->VT2)}}</td>
                                    <td style="text-align: center;">{{number_format($v->VT3)}}</td>
                                    <td style="text-align: center;">{{number_format($v->VT4)}}</td>
                                  </td>
                                  <td><button  data-toggle="modal" data-target="#myModal{{$v->id}}" style="color: orange;"><i class="fa fa-edit"></i> Cập nhật</button></td>
                                </tr>
                                  <div id="myModal{{$v->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h3 class="modal-title" style="color: red;text-align: center;"><b>Cập nhật giá đất</b></h3>
                                        </div>
                                        <div class="modal-body">
                                         <form action="{{route('admin.update_landcost')}}" method="post">
                                          @csrf
                                          <input type="hidden" name="id" value="{{$v->id}}">
                                          <label for="fullname">Tên tuyến phố :</label>
                                          <input type="text" value="{{$v->name_street}}"  name="name" class="form-control"  required="required"><br>

                                          <label for="email">Đoạn đường bắt đầu :</label>
                                          <input type="text" value="{{$v->from}}" class="form-control"  name="from"  required="required">
                                          <br> 
                                          <label for="email">Đoạn đường kết thúc :</label>
                                          <input type="text" value="{{$v->to}}"  class="form-control"  name="to"  required="required">
                                          <br>
                                          
                                         <label for="email">VT1 :</label>
                                         <input type="number" value="{{$v->VT1}}"  class="form-control"  name="vt1"  required="required">
                                         <br>
                                         <label for="email">VT2 :</label>
                                         <input type="number"  value="{{$v->VT2}}"  class="form-control"  name="vt2"  required="required">
                                         <br>
                                         <label for="email">VT3 :</label>
                                         <input type="number"  value="{{$v->VT3}}"  class="form-control"  name="vt3"  required="required">
                                         <br>
                                         <label for="email">VT4 :</label>
                                         <input type="number"  value="{{$v->VT4}}"  class="form-control"  name="vt4"  required="required">
                                         <br>
                                         <label for="email">Chọn phường :</label>
                                          <select name="street" class="form-control" required>
                                           <option value="">Chọn phường</option>
                                          @foreach($data2 as $v)
                                           <option value="{{$v->id}}">{{$v->street_name}}</option>
                                           @endforeach
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

                                @endforeach
                    
                            </tbody>
                          </table>

                          {{$data->links()}}
                        </div>

                         <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                           <form action="{{Route('admin.update_signature')}}" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{$data7[0]['id']}}">
                              <label for=""><b>Tên người đại diện :</b></label>
                              <input type="text" class="form-control" value="{{$data7[0]['name']}}">    
                              <label for=""><b>Tên người đại diện mới :</b></label>
                              <input type="text" class="form-control" name="name" placeholder="Nhập tên..."><br>
                             <button type="submit" class="btn btn-primary"><i class="fas fa-sync"></i> Cập nhật tên </button>
                           </form>
                        </div>


                      </div>
                    </div>
                  </div>
                </div>
              </div>

          </div>
      </div>
  </div>
</div>

@endsection
