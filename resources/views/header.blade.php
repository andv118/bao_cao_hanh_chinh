<div class="col-md-3 left_col">
<div class="left_col scroll-view">
  <div class="navbar nav_title" style="border: 0;">
    <a href="{{route('admin.home')}}" class="site_title" style="text-align: center;"><span>Hệ thống quản lý hội</span></a>
   </div>
  

  <div class="clearfix"></div>

  <!-- menu profile quick info -->
  <div class="profile clearfix">
    <div class="profile_pic">
      <img src="public/admin/source/images//user.png" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
      <span>Xin chào,</span>
      @if(Auth::check())
      <h2>{{Auth::user()->name}}</h2>
      @endif
    </div>
  </div>
  <!-- /menu profile quick info -->

  <br />

  <!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3>Tổng quan</h3>
      <ul class="nav side-menu">
        
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i> Trang chủ</a></li>
        @if(Session::get('userrole')==0)
        <li><a ><i class="fa fa-user"></i> Quản lý tài khoản <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('admin.create_users')}}">Thêm mới tài khoản</a></li>
            <li><a href="{{route('admin.users')}}">Danh sách tài khoản </a></li>
          </ul>
        </li>
        @endif
        <li><a><i class="fas fa-tasks"></i> Quản lý thông tin về hội <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if(Session::get('userrole')==0)
            <li><a href="{{route('admin.themHoi')}}">Nhập thông tin về hội</a></li>
            @endif
            <li><a href="{{route('admin.list-info')}}">Danh sách hội</a></li>
            <li><a href="{{route('admin.list-type')}}">Các lĩnh vực của hội</a></li>
            <li><a href="{{route('admin.list-member')}}">Danh sách thành viên</a></li>
          </ul>
        </li>  
        <li><a><i class="fas fa-file-contract"></i>  Báo cáo chung <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('admin.baocaotonghop')}}">Báo cáo tổng hợp</a></li>
            
            <li><a href="{{route('admin.hoiviendanhdu')}}">Thống kê hội viên danh dự</a></li>
            
            <li><a href="{{route('admin.hoiviennuocngoai')}}">Thống kê hội viên nước ngoài</a></li>
            <li><a href="{{route('admin.hoivientochuc')}}">Thống kê hội viên tổ chức</a></li>
            <li><a href="{{route('admin.tochuccotucachphapnhan')}}">Thống kê tổ chức có tư cách pháp nhân</a></li>
            <li><a href="{{route('admin.tochuccoso')}}">Thống kê tổ chức cơ sở</a></li>
            <li><a href="{{route('admin.nguoinghihuu')}}">Thống kê người nghỉ hưu làm công tác hội</a></li>
            <li><a href="{{route('admin.soluongbienche')}}">Báo cáo số lượng biên chế hợp đồng</a></li>
            <li><a href="{{route('admin.nhiemkydaihoi')}}">Báo cáo nhiệm kỳ đại hội</a></li>
            <li><a href="{{route('admin.cachoidacthu')}}">Thống kê các hội đặc thù</a></li>
            <li><a href="{{route('admin.kinhphihoi')}}">Thống kê kinh phí hội</a></li>
            <li><a href="{{route('admin.hopdongcachoi')}}">Thống kê hợp đồng các hội</a></li>
            <li><a href="{{route('admin.chiphi')}}">Thống kê chi phí</a></li>
            <li><a href="{{route('admin.theoloaihoi')}}">Thống kê theo loại hội</a></li>
            <li><a href="{{route('admin.linhvuchoi')}}">Thống kê theo lĩnh vực hội</a></li>
            <li><a href="{{route('admin.hoicotochucdang')}}">Thống kê hội có tổ chức đảng</a></li>
            <li><a href="{{route('admin.phamvihoatdong')}}">Thống kê theo phạm vi hoạt động</a></li>         
          </ul>
        </li> 
        <li><a><i class="fas fa-chart-bar"></i>  Thống kê theo người <br> đứng đầu <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('admin.thongke.kiemnghiem')}}">Thống kê theo lãnh đạo kiêm nhiệm</a></li>
            <li><a href="{{route('admin.thongke.gioitinh')}}">Thống kê lãnh đạo theo giới tính</a></li>
            <li><a href="{{route('admin.thongke.tuoi')}}">Thống kê theo tuổi lãnh đạo</a></li>
          </ul>
        </li> 
        <li><a><i class="fas fa-chart-bar"></i> Thống kê theo tư cách <br> pháp nhân <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('admin.thuocsonganh')}}">Thống kê hội thuộc sở ngành</a></li>
            <li><a href="{{route('admin.thuocquanhuyen')}}">Thống kê hội thuộc quận huyện</a></li> 
          </ul>
        </li> 
       <li><a><i class="fas fa-chart-bar"></i> Thống kê theo trụ sở <br> hoạt động <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('admin.thongke.nhanuoc')}}">Thống kê theo trụ sở do nhà nước cấp</a></li>
            <li><a href="{{route('admin.thongke.tutuc')}}">Thống kê theo trụ sở do hội tự túc</a></li>
          </ul>
        </li> 
         <li><a href="{{route('admin.quanlycauhoi.cauhoidanhgia')}}"><i class="far fa-question-circle"></i> Quản lý các câu hỏi <br> đánh giá hội </a></li>
        <li><a href="{{route('admin.quanlyphieu.phieudanhgia')}}"><i class="fas fa-address-book"></i> Quản lý phiếu <br> đánh giá hội </a></li>
        <li><a><i class="fas fa-coins"></i> Quản lý tài chính hội <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('admin.list-member')}}">Danh mục tài chính</a></li>
            <li><a href="{{route('admin.list-member')}}">Danh mục năm tài chính</a></li>
            <li><a href="{{route('admin.list-member')}}">Quản lý dữ liệu tài chính hội</a></li> 
          </ul>
        </li> 
        <li><a><i class="fab fa-ubuntu"></i> Danh mục hệ thống <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('admin.danhmuccoquan')}}">Danh mục cơ quan</a></li>
            <li><a href="{{route('admin.danhmuclinhvuc')}}">Danh mục lĩnh vực</a></li>
            <li><a href="{{route('admin.danhmucquanhuyen')}}">Danh mục quận huyện</a></li> 
            <li><a href="{{route('admin.danhmucxaphuong')}}">Danh mục xã phường</a></li> 
            <li><a href="{{route('admin.cauhinh')}}">Cấu hình hệ thống</a></li> 
          </ul>
        </li>
        
      </ul>
    </div>
  </div>
  <!-- /sidebar menu -->

  <!-- /menu footer buttons -->
  <div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" href="{{route('admin.profile')}}" title="Cài đặt tài khoản">
      <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
      <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
      <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Đăng xuất" href="{{route('logout')}}">
      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
  </div>
  <!-- /menu footer buttons -->
</div>
</div>
<style>
  .glyphicon-cog {
    animation: App-logo-spin infinite 5s linear;
    pointer-events: none;
  }
  @keyframes App-logo-spin {
    from {
      transform: rotate(0deg);
    }
    to {
      transform: rotate(360deg);
    }
  }

</style>

<!-- top navigation -->
<div class="top_nav">
<div class="nav_menu" style="background-color: #dde4f0!important;">
  <nav>
    <div class="nav toggle">
      <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>
    <div style="position: absolute;z-index: 999;top: 0px;left: 29%;right: 27%;color: #008400;"><h2 style="text-align: center;"><img src="public/images/889.gif" style="width: 45px;height: 45px;"><b><i class="fab fa-creative-commons-sampling"></i> HỆ THỐNG QUẢN LÝ HỘI</b></h2></div>
    <ul class="nav navbar-nav navbar-right">      
      <li class="">
        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <img src="public/admin/source/images//user.png" alt="">
          @if(Auth::check())
          <b>{{Auth::user()->name}}</b>
          @endif
          <span class=" fa fa-angle-down"></span>
        </a>
        <ul class="dropdown-menu dropdown-usermenu pull-right">
          <li><a href="{{route('admin.profile')}}"><i class="fas fa-user"></i> Quản lý thông tin cá nhân</a></li>
          <li><a href="{{route('logout')}}"  data-confirm="Are you sure to delete this item?"><i class="fas fa-sign-out-alt"></i>  Đăng Xuất</a></li>
        </ul>
      </li>
    </ul>
  </nav>
</div>
</div>

<!-- /top navigation -->