<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <!-- Sidebar Title -->
        <!-- <div class="navbar nav_title" style="border: 0;">
                <a href="{{route('admin.home')}}" class="site_title" style="text-align: center;"><span>Hệ thống quản lý hội</span></a>
            </div> -->
        <!-- End Sidebar Title -->

        <!-- Sidebar Profile -->
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
        <!-- End Sidebar Profile -->

        <br />

        <!-- Sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Chức năng</h3>
                <ul class="nav side-menu">
                    <!-- Trang chủ -->
                    <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <!-- End Trang chủ -->

                    <!-- Quản lý danh mục hệ thống -->
                    <li><a><i class="fab fa-centos"></i> Danh mục hệ thống <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Đơn vị tính</a></li>
                            <li><a href="#">Danh mục hành chính </a></li>
                        </ul>
                    </li>
                    <!-- End Quản lý danh mục hệ thống -->

                    <!-- Quản lý người dùng -->
                    @if(Session::get('userrole')==0)
                    <li><a><i class="fas fa-user"></i> Quản lý người dùng <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Quản lý nhóm người dùng</a></li>
                            <li><a href="{{Route('admin.account.manageAccount')}}">Quản lý người dùng</a></li>
                        </ul>
                    </li>
                    @endif
                    <!-- End Quản lý người dùng -->

                    <!-- Quản lý mẫu báo cáo -->
                    <li><a><i class="fas fa-tasks"></i> Quản lý mẫu báo cáo</a></li>
                    <!-- End Quản lý mẫu báo cáo -->

                    <!-- Quản lý báo cáo -->
                    <li><a><i class="fas fa-file"></i> Quản lý báo cáo</a></li>
                    <!-- End Quản lý báo cáo -->

                    <!-- Báo cáo thống kê -->
                    <li><a><i class="fas fa-file-contract"></i> Báo cáo thống kê <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Báo cáo chung</a></li>
                        </ul>
                    </li>
                    <!-- End Báo cáo thống kê -->

                    <!-- Thống kê đơn vị hành chính -->
                    <li><a><i class="fas fa-chart-bar"></i> Thống kê đơn vị hành chính</a></li>
                    <!-- End Thống kê đơn vị hành chính -->

                    <!-- Bảng thống kê tổng hợp -->
                    <li><a><i class="fas fa-chart-pie"></i> Bảng thống kê tổng hợp <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Tổng hợp số liệu, hiển thị, cảnh báo</a></li>
                        </ul>
                    </li>
                    <!-- End Bảng thống kê tổng hợp -->
                </ul>
            </div>
        </div>
        <!-- End Sidebar menu -->

    </div>
</div>