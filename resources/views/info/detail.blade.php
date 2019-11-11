@extends('master')

@section('content')
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
    .form_input_default input{
        border: 0;
        border-bottom: 1px dotted;
        position: relative;
        top: -3px;
        background: transparent;
        line-height: 1;
    }
    .form_input_default textarea{
        width:100%;
    }
    .form_input_default .block_input{
        margin-bottom: 20px;
    }
    .form_table_default input{
        padding-left: 20px;
        border: 0;
    }
    .fixed-table-body span strong,.fixed-table-body p strong{
        color:#000;
        padding-left: 15px;
    }
    .table-responsive .table tr td{
        text-align: center;
        color: #000;
    }
</style>
 <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/PHIẾU CUNG CẤP THÔNG TIN VỀ HỘI</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                            <h3 style="text-align: center;padding: 10px 10px; "><b>PHIẾU CUNG CẤP THÔNG TIN VỀ HỘI</b></h3>
                        </div>
                        <div class="fixed-table-body">
                             @foreach($detail_info as $detail_info)
                            <form class="col-sm-8 form-horizontal col-sm-offset-2 form_input_default" enctype="multipart/form-data" method="post" action="{{route('admin.save_contract')}}" onsubmit="return checkValidate();">
                                <h3>I. TÊN HỘI:</h3>
                                <div class="block_input">
                                    <label>Tên đầy đủ bằng tiếng Việt:</label>
                                    <span><strong>{{$detail_info->TenTiengViet}}</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Tên bằng tiếng Anh (nếu có):</label>
                                    <span><strong>{{$detail_info->english_name}}</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Tên giao dịch bằng tiếng Anh (nếu có):</label>
                                    <span><strong>{{$detail_info->english_name}}</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Quyết định cho phép thành lập hội (số, ngày, tháng, cơ quan ban hành):</label>
                                    <p><strong>{{$detail_info->establish}}</strong></p>
                                </div>
                                <div class="block_input">
                                    <label>Quyết định phê duyệt Điều lệ (số, ngày, tháng, cơ quan ban hành):</label>
                                    <p><strong>{{$detail_info->pending}}</strong></p>
                                </div>
                                <div class="block_input">
                                    <label>Tên cơ quan quản lý nhà nước về ngành, lĩnh vực mà hội hoạt động (Ví dụ: Sở Công thương, Sở Lao động, Thương binh &amp; Xã hội):</label>
                                    <p><strong>{{$detail_info->organ_manage}}</strong></p>
                                </div>
                                <h3>II. LOẠI HỘI :</h3>
                                
                                    <p><strong>
                                        {{$detail_info->id_type}}
                                    </strong></p>
                                

                                <h3>III. TRỤ SỞ HỘI</h3>
                                <div class="block_input">
                                    <label>Địa chỉ trụ sở của hội hiện nay <i>(số nhà, đường phố (thôn xóm), phường (xã),quận ( huyện )</i></label>
                                    <p><strong>{{$detail_info->address}}</strong></p>
                                </div>
                                <div class="block_input">
                                    <label>Số điện thoại:</label>
                                    <span><strong>{{$detail_info->number_phone}}</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Fax:</label>
                                    <span><strong>{{$detail_info->fax}}</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Website:</label>
                                    <span><strong>{{$detail_info->website}}</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Email:</label>
                                    <span><strong>{{$detail_info->email}}</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Diện tích trụ sở:</label>
                                    <span><strong>
                                        @if($detail_info->area != '') {{$detail_info->area}} hecta @endif
                                    </strong></span>
                                </div>
                                <div class="block_input">
                                    <h4>Do Hội thuê (bằng nguồn kinh phí của hội hoặc nhà nước hỗ trợ kinh phí)</h4>
                                    <div class="block_input">
                                        <label>Tự có:</label>
                                        <span><strong>
                                            @if($detail_info->funding != ''){{$detail_info->funding}} VNĐ @endif
                                        </strong></span>
                                    </div>
                                    <div class="block_input">
                                        <label>Nhà nước cấp (Ghi rõ Số Quyết định hoặc Hợp đồng) :
                                        </label>
                                        <span><strong>
                                            @if($detail_info->funding != ''){{$detail_info->funding}} VNĐ @endif
                                        </strong></span>
                                    </div>
                                </div>
                                <h3>IV. PHẠM VI HOẠT ĐỘNG</h3>
                                <div class="block_input">
                                    <label>Hội có phạm vi hoạt động:</label>
                                    <span><strong>{{$detail_info->arena}}</strong></span>
                                </div>
                                <h3>V. LĨNH VỰC HOẠT ĐỘNG</h3>
                                <div class="block_input">
                                    <label>Lĩnh vực chính hội đang hoạt động:</label>
                                    <span><strong>{{$detail_info->field_active}}</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Lĩnh vực khác hội tham gia hoạt động :</label>
                                    <span><strong>{{$detail_info->field_other}}</strong></span>
                                </div>
                                <h3>VI. CÁC KỲ ĐẠI HỘI</h3>
                                <div class="block_input">
                                    <label>Nhiệm kỳ của hội:</label>
                                    <span><strong>
                                        @if($detail_info->term == 2)
                                        2 năm
                                        @elseif($detail_info->term == 3)
                                        3 năm
                                        @elseif($detail_info->term == 4)
                                        5 năm
                                        @endif
                                    </strong></span>
                                </div>
                                <div class="block_input">
                                <label>Từ khi thành lập đến nay đã qua bao nhiêu kỳ đại hội:</label>
                                <p><strong>{{$detail_info->term_current}} kỳ đại hội</strong></p>
                                </div>
                                <h3>VII. TỔ CHỨC ĐẢNG TRONG HỘI</h3>
                                <div class="block_input">
                                    <label>Hội có tổ chức đảng:</label>
                                    <span><strong>
                                        @if($detail_info->is_systematical == 1) Có @else Không @endif
                                    </strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Nếu có ghi rõ:</label>
                                    <span><strong>{{$detail_info->note}}</strong></span>
                                </div>
                                
                            </form>
                            @endforeach
                            <form class="form_table_default form-horizontal col-xs-12">
                                <h3>VIII. ĐỔI TÊN, SÁP NHẬP, GIẢI THỂ</h3>
                                <p>Từ khi thành lập đến nay, Hội đã đổi tên, sáp nhập, giải thể mấy lần? .Nếu có ghi rõ:</p>
                                <label>1. Đổi tên</label>
                                
                                <div class="table-responsive">
                                  <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Lần thứ</th>
                                            <th>Tên hội</th>
                                            <th>Số Quyết định</th>
                                            <th>Ngày tháng ra quyết định</th>
                                            <th>Cơ quan ra quyết định</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $stt = 0; ?>
                                    @if($detail_rename != '')
                                    
                                    @foreach($detail_rename as $item)
                                        <tr>
                                            <td>
                                                {{$stt+=1}}
                                            </td>
                                            <td>
                                                {{$item->name}}
                                            </td>
                                            <td>
                                                {{$item->number_decision}}
                                            </td>
                                            <td>
                                                {{$item->date_decision}}
                                            </td>
                                            <td>
                                                {{$item->organ_decision}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                        <tr>
                                            <td>
                                                {{$stt+=1}}
                                            </td>
                                            <td>
                                                Không
                                            </td>
                                            <td>
                                                Không
                                            </td>
                                            <td>
                                                Không
                                            </td>
                                            <td>
                                                Không
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                  </table>
                                </div>
                                <label>2. Sáp nhập</label>
                                <div class="table-responsive">
                                  <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Lần thứ</th>
                                            <th>Tên hội</th>
                                            <th>Số Quyết định</th>
                                            <th>Ngày tháng ra quyết định</th>
                                            <th>Cơ quan ra quyết định</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Công ty CP HTN SOFT
                                            </td>
                                            <td>
                                                19686869
                                            </td>
                                            <td>
                                                02/07/2008
                                            </td>
                                            <td>
                                                Bộ công thương
                                            </td>
                                        </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <label>3. Giải thể</label>
                                <div class="table-responsive">
                                  <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Lần thứ</th>
                                            <th>Tên hội</th>
                                            <th>Số Quyết định</th>
                                            <th>Ngày tháng ra quyết định</th>
                                            <th>Cơ quan ra quyết định</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Công ty CP HTN
                                            </td>
                                            <td>
                                                19686870
                                            </td>
                                            <td>
                                                03/07/2008
                                            </td>
                                            <td>
                                                Bộ công thương
                                            </td>
                                        </tr>
                                    </tbody>
                                  </table>
                                </div>
                                
                            </form>

                            <form class="form_table_default form-horizontal col-xs-12">
                                <h3>IX. KINH PHÍ HOẠT ĐỘNG CỦA HỘI</h3>
                                <label>1. Tổng kinh phí hoạt động trong 1 năm của hội</label>
                                
                                <p><i>ĐVT: Triệu đồng</i></p>
                                <div class="table-responsive">
                                  <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="300px">Nguồn thu</th>
                                            <th>Năm 2014</th>
                                            <th>Năm 2015</th>
                                            <th>Năm 2016</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Kinh phí hỗ trợ của Nhà nước
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Kinh phí do hội viên đóng góp
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Kinh phí của các tổ chức trực thuộc hội đóng góp
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Kinh phí từ các dịch vụ của hội
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Kinh phí từ nguồn tài trợ cả các tổ chức trong nước, nước ngoài (nếu tài trợ bằng hiện vật ghi rõ hiện tên hiện vật và có thể quy đổi bằng tiền)
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Các nguồn thu khác (nếu có)
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                        </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <label>2. Tổng chi:</label>
                                
                                <p><i>ĐVT: Triệu đồng</i></p>
                                <div class="table-responsive">
                                  <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="300px">Nội dung chi</th>
                                            <th>Năm 2014</th>
                                            <th>Năm 2015</th>
                                            <th>Năm 2016</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Chi hành chính hội (lương, phụ cấp)
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Chi mua sắm, sửa chữa trang thiết bị, cơ sở vật chất
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Thuế (nếu có)
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tích lũy (nếu có)
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Khen thưởng
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Các khoản chi khác
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                               1,000,000
                                            </td>
                                        </tr>
                                    </tbody>
                                  </table>
                                </div>
                                
                            </form>
                            <form class="form_table_default form-horizontal col-xs-12">
                                <h3>X. CƠ SỞ VẬT CHẤT, TRANG THIẾT BỊ (NGOÀI TRỤ SỞ)</h3>
                                <div class="table-responsive">
                                  <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Tên tài sản</th>
                                            <th rowspan="2">Số lượng</th>
                                            <th rowspan="2">Tổng số tiền đầu tư</th>
                                            <th rowspan="2">Tình trạng hoạt động</th>
                                            <th colspan="2">Nguồn</th>
                                            <th rowspan="2">Giá trị hiện tại</th>
                                        </tr>
                                        <tr>
                                            <th>Nhà nước cấp</th>
                                            <th>Hội tự trang bị</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Phần mềm quản lí học bạ
                                            </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                Hoạt động
                                            </td>
                                            <td>
                                                0
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                            <td>
                                                1,000,000
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                            </form>
                            <!-- XI. LÃNH ĐẠO CHỦ CHỐT CỦA HỘI -->
                            <form class="form_table_default form-horizontal col-xs-12">
                                <h3>XI. LÃNH ĐẠO CHỦ CHỐT CỦA HỘI</h3>
                                <h4>1. Lãnh đạo chủ chốt của hội</h4>
                                 
                                <div class="table-responsive">
                                  <table class="table table-bordered jambo_table">
                                    <thead>
                                        <tr>
                                            <th rowspan="4"><strong>Họ và tên lãnh đạo</strong></th>
                                            <th rowspan="4">Chức vụ ( Chủ tịch, Phó chủ tịch, Tổng thư ký )</th>
                                            <th rowspan="4">Giới tính</th>
                                            <th rowspan="4">Ngày tháng năm sinh</th>
                                            <th rowspan="4">Nhiệm kỳ đã tham gia (từ năm – đến năm)</th>
                                            <th rowspan="4">Trình độ văn hóa (10/10, 12/12)</th>
                                            <th rowspan="4">Trình độ chuyên môn(giáo sư, tiến sĩ, thạc sỹ, ĐH, CĐ)</th>
                                            <th rowspan="4">Chuyên ngành đào tạo</th>
                                            <th colspan="10">Chế độ làm việc</th>
                                            <th rowspan="4">Chức vụ trước khi chuyển về hội</th>
                                        </tr>
                                        <tr>
                                            <th colspan="7">Chuyên trách</th>
                                            <th rowspan="3">Kiêm nhiệm</th>
                                            <th colspan="2">3.Hợp đồng</th>
                                        </tr>
                                        <tr>
                                            <th rowspan="2">2.Cán bộ đã nghỉ hưu</th>
                                            <th colspan="6">1. Là công chức - viên chức</th>
                                            <th rowspan="2">Chỉ tiêu do nhà nước cấp</th>
                                            <th rowspan="2">Hội hợp đồng</th>
                                        </tr>
                                        <tr>
                                            <th>Ngày nhận QĐ</th>
                                            <th>Số QĐ tuyển dụng</th>
                                            <th>Tên cơ quan tuyển dụng</th>
                                            <th>Ngạch lương</th>
                                            <th>Bậc lương</th>
                                            <th>Hệ số lương</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Đoàn Quang Bình
                                            </td>
                                            <td>
                                                
                                            Chủ tịch
                                                    
                                            </td>
                                            <td>
                                                Nam
                                            </td>
                                            <td>
                                                06-09-1969
                                            </td>
                                            <td>
                                                Từ năm 1994 đến 2016
                                            </td>
                                            <td>
                                                Kinh tế chính trị
                                            </td>
                                            <td>
                                                ...
                                            </td>
                                            <td>
                                                ...
                                            </td>
                                            <td>
                                                ...
                                            </td>
                                            <td>
                                                ...
                                            </td>
                                            <td>
                                                ...
                                            </td>
                                            <td>
                                                ...
                                            </td>
                                            <td>
                                                ...
                                            </td>
                                            <td>
                                                ...
                                            </td>
                                            <td>
                                                ...
                                            </td>
                                            <td>
                                                ...
                                            </td>
                                            <td>
                                                ...
                                            </td>
                                            <td>
                                                ...
                                            </td>
                                            <td>
                                                ...
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                
                            </form>
                            <!-- XII. HỘI VIÊN, THÀNH VIÊN, CÁC TỔ CHỨC CƠ SỞ THUỘC HỘI -->
                            <form class="form_table_default form-horizontal col-xs-12">
                                <h3>XII. HỘI VIÊN, THÀNH VIÊN, CÁC TỔ CHỨC CƠ SỞ THUỘC HỘI</h3>

                                 
                                <p>
                                <strong>
                                    1. Số lượng hội viên hiện có 03 kỳ đại hội gần nhất: 3
                                </strong>
                                </p>
                                <div class="table-responsive">
                                  <table class="table table-bordered jambo_table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Nhiệm kỳ thứ</th>
                                            <th rowspan="2">Từ năm</th>
                                            <th rowspan="2">Đến năm</th>
                                            <th rowspan="2">Tổng số hội viên</th>
                                            <th rowspan="2">Số lượng BCH</th>
                                            <th rowspan="2">Số lượng Ban thường vụ</th>
                                            <th rowspan="2">Số lượng Ban kiểm tra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                2014
                                            </td>
                                            <td>
                                                2016
                                            </td>
                                            <td>
                                                3
                                            </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                1
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                
                            </form>
                            
                            <form class="form_table_default form-horizontal col-xs-12">
                                <h4>Hội viên danh dự</h4>

                                 
                                <div class="table-responsive">
                                  <table class="table table-bordered jambo_table">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Họ tên</th>
                                            <th>Ngày sinh</th>
                                            <th>Giới tính</th>
                                            <th>Chức vụ trước khi tham gia</th>
                                            <th>Quá trình tham gia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Doãn Chí Bình
                                            </td>
                                            <td>
                                                11 - 11 - 1991
                                            </td>
                                            <td>
                                                Nữ
                                            </td>
                                            <td>
                                                Không có
                                            </td>
                                            <td>
                                                Không có
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                
                            </form>
                            
                            <form class="form_table_default form-horizontal col-xs-12">
                                <h4>Hội viên người nước ngoài</h4>

                                 
                                <div class="table-responsive">
                                  <table class="table table-bordered jambo_table">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Họ tên</th>
                                            <th>Ngày sinh</th>
                                            <th>Giới tính</th>
                                            <th>Quốc tịch</th>
                                            <th>Chức vụ trước khi tham gia</th>
                                            <th>Quá trình tham gia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Vương Chí Tôn
                                            </td>
                                            <td>
                                                28 - 07 - 1987
                                            </td>
                                            <td>
                                                Nam
                                            </td>
                                            <td>
                                                Việt Nam
                                            </td>
                                            <td>
                                                Không có
                                            </td>
                                            <td>
                                                Không có
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                               
                            </form>
                            
                            <form class="form_table_default form-horizontal col-xs-12">
                                <h3>2. Hội viên tổ chức</h3>

                                 
                                <div class="table-responsive">
                                  <table class="table table-bordered jambo_table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">STT</th>
                                            <th rowspan="2">Tên đơn vị</th>
                                            <th rowspan="2">Tên người đại diện</th>
                                            <th rowspan="2">Chức danh</th>
                                            <th rowspan="2">Địa chỉ đơn vị</th>
                                            <th colspan="2">Số điện thoại</th>
                                            <th rowspan="2">Ngành nghề chính của đơn vị</th>
                                            <th rowspan="2">Ghi chú</th>
                                        </tr>
                                        <tr>
                                            <th>Cơ quan</th>
                                            <th>Di động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Hội chim cảnh Hà Nội
                                            </td>
                                            <td>
                                                Phạm thị Dung
                                            </td>
                                            <td>
                                                Tổng thư kí
                                            </td>
                                            <td>
                                                Số 69 ngõ 96 Đường Trần Duy Hưng, Hà Nội
                                            </td>
                                            <td>
                                                0243089999
                                            </td>
                                            <td>
                                                0996666999
                                            </td>
                                            <td>
                                                Buôn chim cảnh
                                            </td>
                                            <td>
                                                Không có
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                            </form>
                            <!-- Hội viên danh dự -->
                            <form class="form_table_default form-horizontal col-xs-12">
                                <h3>3. Đơn vị trực thuộc hội</h3>
                                <p><strong>a. Tổ chức có tư cách pháp nhân trực thuộc hội</strong></p>
                                 
                                <div class="table-responsive">
                                  <table class="table table-bordered jambo_table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">STT</th>
                                            <th rowspan="2">Tên đơn vị</th>
                                            <th rowspan="2">Địa chỉ</th>
                                            <th rowspan="2">Số điện thoại</th>
                                            <th rowspan="2">Cơ quan thành lập hoặc cho phép thành lập tổ chức thuộc hội</th>
                                            <th colspan="2">Lĩnh vực hoạt động</th>
                                            <th rowspan="2">Ghi chú</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Hội buôn máy bay không người lái
                                            </td>
                                            <td>
                                                Số 96 Đường Phạm Văn Đồng
                                            </td>
                                            <td>
                                                01234567899
                                            </td>
                                            <td>
                                                Không có
                                            </td>
                                            <td>
                                                Buôn máy bay
                                            </td>
                                            <td>
                                                Không có
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                            </form>
                            <!-- Hội viên người nước ngoài -->
                            <form class="form_table_default form-horizontal col-xs-12">
                                
                                <p><strong>b. Tổ chức cơ sở thuộc hội (liên chi hội, chi hội, phân hội, tổ hội thuộc hội)</strong></p>
                                 
                                <div class="table-responsive">
                                  <table class="table table-bordered jambo_table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">STT</th>
                                            <th rowspan="2">Tên đơn vị</th>
                                            <th rowspan="2">Chi hội trưởng</th>
                                            <th rowspan="2">Số điện thoại</th>
                                            <th colspan="2">Lĩnh vực hoạt động</th>
                                            <th rowspan="2">Ghi chú</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Hội chim lợn
                                            </td>
                                            <td>
                                                Vũ Văn Hợi
                                            </td>
                                            <td>
                                                0989876322
                                            </td>
                                            <td>
                                                Kinh doanh
                                            </td>
                                            <td>
                                                Không có
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                            </form>
                            <!-- Hội viên tổ chức -->
                            <form class="form_table_default form-horizontal col-xs-12">
                                <h3>XIII. NGƯỜI CÔNG TÁC TẠI HỘI</h3>
                                <p><strong>Số biên chế được giao (công chức, viên chức, định mức lao động, hợp đồng 68) 6</strong></p>
                                <p><strong>2. Số biên chế hiện có</strong></p>
                                <p><strong>a) Công chức, viên chức, định mức lao động, hợp đồng 68</strong></p>
                                 
                                <div class="table-responsive">
                                  <table class="table table-bordered jambo_table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">STT</th>
                                            <th rowspan="2">Họ và tên</th>
                                            <th rowspan="2">Ngày sinh</th>
                                            <th rowspan="2">Giới tính</th>
                                            <th colspan="2">Số QĐ tuyển dụng</th>
                                            <th rowspan="2">Cơ quan tuyển dụng</th>
                                            <th rowspan="2">Ngày tháng năm</th>
                                            <th rowspan="2">Cơ quan điều động luân chuyển, hợp đồng</th>
                                            <th rowspan="2">Ngày tháng năm</th>
                                            <th rowspan="2">Trình độ chuyên môn, nghiệp vụ</th>
                                            <th colspan="4">Ngạch bậc lương</th>
                                            <th rowspan="2">Chức danh làm việc tại hội</th>
                                        </tr>
                                        <tr>
                                            <th>Ngạch</th>
                                            <th>Bậc</th>
                                            <th>Hệ số</th>
                                            <th>Ngày tháng Nâng lương</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Phùng Trung Đông
                                            </td>
                                            <td>
                                                21-09-1986
                                            </td>
                                            <td>
                                                Nam
                                            </td>
                                            <td>
                                                176597647
                                            </td>
                                            <td>
                                                Hội người già
                                            </td>
                                            <td>
                                                36249287987
                                            </td>
                                            <td>
                                                01-09-2017
                                            </td>
                                            <td>
                                                Hội thanh niên
                                            </td>
                                            <td>
                                                01-09-2017
                                            </td>
                                            <td>
                                                Tiến sĩ chuyên ngành
                                            </td>
                                            <td>
                                                Ngạch tuổi già
                                            </td>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                9
                                            </td>
                                            <td>
                                                01-09-2017
                                            </td>
                                            <td>
                                                Chủ tịch
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                            </form>
                            <!-- Tổ chức có tư cách pháp nhân trực thuộc hội -->
                            <form class="form_table_default form-horizontal col-xs-12">
                                
                                <p><strong>b. Người nghỉ hưu làm công tác hội</strong></p>
                                 
                                <div class="table-responsive">
                                  <table class="table table-bordered jambo_table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">STT</th>
                                            <th rowspan="2">Họ tên</th>
                                            <th rowspan="2">Ngày sinh</th>
                                            <th rowspan="2">Chức danh</th>
                                            <th colspan="2">Chế độ thù lao (Nếu có)</th>
                                            <th rowspan="2">Chức vụ trước khi nghỉ hưu</th>
                                            <th rowspan="2">Cơ quan, đơn vị làm việc trước khi nghỉ hưu</th>
                                            <th rowspan="2">Số điện thoại</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Phạm Văn Dương
                                            </td>
                                            <td>
                                                06-09-1977
                                            </td>
                                            <td>
                                                Thành viên hội
                                            </td>
                                            <td>
                                                Không có
                                            </td>
                                            <td>
                                                Thành viên hội
                                            </td>
                                            <td>
                                                Hội chim lợn
                                            </td>
                                            <td>
                                                0900769437
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                            </form>
                            <!-- Tổ chức cơ sở thuộc hội (liên chi hội, chi hội, phân hội, tổ hội thuộc hội) -->
                            <form class="form_table_default form-horizontal col-xs-12 ">
                                
                                <p><strong>3. Tổng số hợp đồng lao động do hội tự ký bằng nguồn kinh phí của hộ</strong></p>
                                 
                                <div class="table-responsive">
                                  <table class="table table-bordered jambo_table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">STT</th>
                                            <th rowspan="2">Họ và tên</th>
                                            <th rowspan="2">Ngày tháng năm sinh</th>
                                            <th rowspan="2">Giới tính</th>
                                            <th colspan="2">Số hợp đồng tuyển dụng</th>
                                            <th rowspan="2">Thời hạn hợp đồng</th>
                                            <th rowspan="2">Trình độ chuyên môn, nghiệp vụ</th>
                                            <th rowspan="2">Tiền lương</th>
                                            <th rowspan="2">Vị trí làm việc</th>
                                            <th rowspan="2">Do hội tự hợp đồng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Kim Thị Dung
                                            </td>
                                            <td>
                                                27-06-1989
                                            </td>
                                            <td>
                                                Nữ
                                            </td>
                                            <td>
                                                09759282345
                                            </td>
                                            <td>
                                                5 năm
                                            </td>
                                            <td>
                                                Chuyên gia
                                            </td>
                                            <td>
                                                5.000.000 đồng
                                            </td>
                                            <td>
                                                Thư kí
                                            </td>
                                            <td>
                                                Đúng
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                <div style="display: flex;justify-content: space-around;">
                                    <p class="text-center"><strong>Người cung cấp thông tin</strong><br><i>(Ký, ghi rõ họ tên)</i><br>Kim thị Dung</p>
                                    <p class="text-center"><strong>Lãnh đạo đơn vị</strong><br><i>(Ký, ghi rõ họ tên)</i><br>Phạm trung Đông</p>
                                </div>
                            </form>
                            <!-- XIII. NGƯỜI CÔNG TÁC TẠI HỘI -->
                            <form class="form_table_default form-horizontal col-xs-12">
                                
                                <h3>XIII. BỘ QUY TẮC</h3>
                                 
                                <div class="table-responsive">
                                  <table class="table table-non-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Có</th>
                                            <th>Không</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1. Điều lệ hội
                                            </td>
                                            <td>
                                                Có
                                            </td>
                                            <td>
                                                
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                2. Quy chế hoạt động của Ban Chấp hành:
                                            </td>
                                            <td>
                                                Có
                                            </td>
                                            <td>
                                                
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                               3. Quy chế hoạt động của Ban Thường vụ:
                                            </td>
                                            <td>

                                            </td>
                                            <td>
                                                Không
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                4. Quy chế quản lý, sử dụng tài chính, tài sản của hội:
                                            </td>
                                            <td>
                                                Có
                                            </td>
                                            <td>
                                                
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                5. Quy chế quản lý, sử dụng con dấu của hội
                                            </td>
                                            <td>
                                                Có
                                            </td>
                                            <td>
                                                
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                6. Quy chế khen thưởng, kỷ luật:
                                            </td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                                Không
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                7. Quy chế lương, phụ cấp…:
                                            </td>
                                            <td>
                                                Có
                                            </td>
                                            <td>
                                                
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                8. Công tác khiếu nại tố cáo:
                                            </td>
                                            <td>
                                                Có
                                            </td>
                                            <td>
                                                
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                9. Các quy định nội bộ khác của hội:
                                            </td>
                                            <td>
                                                Có
                                            </td>
                                            <td>
                                                
                                            </td>
                                            
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                            </form>
                            <!-- XIV. KHÁI QUÁT TÌNH HÌNH HÌNH HOẠT ĐỘNG CỦA HỘI -->
                            <form class="form_table_default form-horizontal col-xs-12 ">
                                
                                <h3>XIV. KHÁI QUÁT TÌNH HÌNH HÌNH HOẠT ĐỘNG CỦA HỘI</h3>
                                <p><strong>1. Những kết quả đạt được</strong><i>(Khái quát tình hình hoạt động từ khi thành lập cho đến nay, nêu kết quả hoạt động cụ thể trong 3 năm gần đây từ 2014-2016)</i></p>
                                 
                                </div>
                                <textarea name="" type="text"></textarea>
                                <p><strong>2. Những tồn tại, hạn chế</strong></p>
                                <textarea name="" type="text"></textarea>
                                <p><strong>3. Đề xuất, kiến nghị</strong></p>
                                <textarea name="" type="text"></textarea>
                                <p><strong>Ghi chú</strong><i>Yêu cầu đơn vị gửi các tài liệu (bản photocopy) kèm theo Phiếu cung cấp thông tin về hội: Quyết định thành lập, Điều lệ hội, Giấy đăng ký mẫu dấu, Bộ quy tắc, danh sách trích ngang (họ tên, ngày tháng năm sinh, giới tính, chức danh, chức vụ, đơn vị công tác trước khi tham gia hội, số điện thoại) của Ban Chấp hành, Ban Thường vụ, Ban Kiểm tra…), đối chiếu khi nhập dữ liệu./.</i></p>
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </form>
                        </div>                 
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
@endsection