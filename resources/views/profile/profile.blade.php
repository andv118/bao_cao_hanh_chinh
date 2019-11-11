 @extends('master')

 @section('content')
   <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/Cài đặt tài khoản</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                     @if(count($errors)>0)
                      <div class="alert alert-danger" style="margin: 20px 0;text-align: center;">
                        @foreach($errors->all() as $err)
                        {{$err}} <br>
                        @endforeach
                      </div>
                      @endif
                      @if(Session::has('flag'))
                      <div class="alert alert-{{Session::get('flag')}}" style="margin: 20px 0;text-align: center;">{{Session::get('message')}}</div>
                      @endif      
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Thông tin tài khoản</h2>
                            <ul class="nav navbar-right panel_toolbox">
                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                              </li>
                            </ul>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                              <div class="profile_img">
                                <div id="crop-avatar">
                                  <!-- Current avatar -->
                                  <img class="img-responsive avatar-view" src="public/admin/source/images/user.png" alt="Avatar" title="Change the avatar">
                                </div>
                              </div>
                              <h3>{{$data[0]['name']}}</h3>

                              <ul class="list-unstyled user_data">
                                <li><i class="fa fa-map-marker user-profile-icon"></i> Hà Nội
                                </li>

                                <li>
                                  <i class="fa fa-briefcase user-profile-icon"></i> Cán bộ phường <span style="color: red;">{{$data[0]['street_name']}}</span>
                                </li>

                               
                              </ul>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">

                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                  <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Cập nhật thông tin tài khoản</a>
                                  </li>
                                  <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Đổi mật khẩu</a>
                                  </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                                <div class="x_panel">
                                                  
                                          <div class="x_content">
                                             @if (session('success'))
                                            <div class="alert alert-success">
                                              {{ session('success') }}
                                            </div>
                                            @endif
                                            <!-- start form for validation -->
                                            <form id="demo-form" action="{{route('admin.updateProfile')}}" method="post" 
                                             data-parsley-validate="" novalidate="">
                                              @csrf
                                              <input type="hidden" value="{{$data[0]['code']}}" name="id">
                                              <label for="fullname">Tên * :</label>
                                              <input type="text" id="fullname" value="{{$data[0]['name']}}" class="form-control" name="fullname" required=""><br>

                                              <label for="email">Email * :</label>
                                              <input type="email" id="email" class="form-control" value="{{$data[0]['email']}}" name="email" data-parsley-trigger="change" required="">
                                              <br>
                                               <label for="email">Số điện thoại * :</label>
                                              <input type="email" id="text"  class="form-control" value="{{$data[0]['phone']}}" name="phone" data-parsley-trigger="change" required=""><br>
                                              
                                              <button type="submit" class="btn btn-primary">Cập nhật</button>

                                          </p></form>
                                          <!-- end form for validations -->

                                      </div>
                                  </div>   

                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                   <div class="container">
                                    <div class="row justify-content-center">
                                      <div class="col-md-8">
                                        <div class="card">
                                         

                                          <div class="card-body">
                                            @if (session('error'))
                                            <div class="alert alert-danger">
                                              {{ session('error') }}
                                            </div>
                                            @endif
                                            @if (session('success'))
                                            <div class="alert alert-success">
                                              {{ session('success') }}
                                            </div>
                                            @endif
                                            <form class="form-horizontal" method="POST" action="{{ route('admin.changePass') }}">
                                              {{ csrf_field() }}

                                              <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                                <label for="new-password" class="col-md-4 control-label">Mật khẩu cũ</label>

                                                <div class="col-md-6">
                                                  <input id="current-password" type="password" class="form-control" name="current-password" required>

                                                  @if ($errors->has('current-password'))
                                                  <span class="help-block">
                                                    <strong>{{ $errors->first('current-password') }}</strong>
                                                  </span>
                                                  @endif
                                                </div>
                                              </div>

                                              <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                                <label for="new-password" class="col-md-4 control-label">Mật khẩu mới</label>

                                                <div class="col-md-6">
                                                  <input id="new-password" type="password" class="form-control" name="new-password" required>

                                                  @if ($errors->has('new-password'))
                                                  <span class="help-block">
                                                    <strong>{{ $errors->first('new-password') }}</strong>
                                                  </span>
                                                  @endif
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <label for="new-password-confirm" class="col-md-4 control-label">Xác nhận mật khẩu mới</label>

                                                <div class="col-md-6">
                                                  <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                  <button type="submit" class="btn btn-primary">
                                                    Đổi mật khẩu
                                                  </button>
                                                </div>
                                              </div>
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
                        </div>
                      </div>
                    </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

@endsection
