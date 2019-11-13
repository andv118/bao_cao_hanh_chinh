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

<!-- Top navigation -->
    <div class="top_nav">
        <div class="nav_menu" style="background-color: #dde4f0!important;">
            <nav>
                <!-- Toggle -->
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <!-- End Toggle -->

                <!-- Title -->
                <div id="head-title" style="position: absolute;z-index: 999;top: 0px;left: 29%;right: 27%;color: #008400;">
                    <h2 style="text-align: center;"><img id="head-icon" src="public/images/889.gif" style="width: 45px;height: 45px;"><b><i class="fab fa-creative-commons-sampling"></i> HỆ THỐNG QUẢN LÝ BÁO CÁO CẢI CÁCH</b></h2>
                </div>
                <!-- End Title -->

                <!-- User -->
                <ul class="nav navbar-nav navbar-right" id="top-user" >
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="public/admin/source/images//user.png" alt="">
                            @if(Auth::check())
                            <b id="user-name">{{Auth::user()->name}}</b>
                            @endif
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="{{route('admin.profile')}}"><i class="fas fa-user"></i> Quản lý thông tin cá nhân</a></li>
                            <li><a href="{{route('logout')}}" data-confirm="Are you sure to delete this item?"><i class="fas fa-sign-out-alt"></i> Đăng Xuất</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- End User -->

            </nav>
        </div>
    </div>
<!-- End Top navigation -->

<style>

      /* Mobile */
      @media(max-width : 426px){
        h2 {
            font-size: 13px;
        }
        #head-icon {
            width: 30px !important;
            height: auto !important;
        }
        #user-name {
            display: none;
        }
        #head-title {
            left: 10% !important;
            right: 20% !important;
        }
        #head-title h2 {
            font-size: 10px;
        }
    }

    /* Tablet */
    @media(max-width : 768px){
        h2 {
            font-size: 13px;
        }
        #head-icon {
            width: 40px !important;
            height: auto !important;
        }
    }
  
</style>