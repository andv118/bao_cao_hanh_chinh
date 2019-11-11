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
                             
                            <form class="col-sm-8 form-horizontal col-sm-offset-2 form_input_default" enctype="multipart/form-data" method="post" action="{{route('admin.save_contract')}}" onsubmit="return checkValidate();">
                                <h3>I. TÊN HỘI:</h3>
                                <div class="block_input">
                                    <label>Tên đầy đủ bằng tiếng Việt:</label>
                                    <span><strong>Công ty CP Công nghệ thông tin và truyền thông HTN</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Tên bằng tiếng Anh (nếu có):</label>
                                    <span><strong>HTN Software</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Tên giao dịch bằng tiếng Anh (nếu có):</label>
                                    <span><strong>HTN Software</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Quyết định cho phép thành lập hội (số, ngày, tháng, cơ quan ban hành):</label>
                                    <p><strong>Số 190010069, ngày 09 tháng 06 do Bộ nào đó ban hành</strong></p>
                                </div>
                                <div class="block_input">
                                    <label>Quyết định phê duyệt Điều lệ (số, ngày, tháng, cơ quan ban hành):</label>
                                    <p><strong>Số 190010069, ngày 09 tháng 06 do Bộ nào đó ban hành</strong></p>
                                </div>
                                <div class="block_input">
                                    <label>Tên cơ quan quản lý nhà nước về ngành, lĩnh vực mà hội hoạt động (Ví dụ: Sở Công thương, Sở Lao động, Thương binh &amp; Xã hội):</label>
                                    <p><strong>Sở Công thương</strong></p>
                                </div>
                                <h3>II. LOẠI HỘI :</h3>
                                
                                    <p><strong>Tổ chức xã hội nhân đạo, từ thiện</strong></p>
                                
                                <h3>III. TRỤ SỞ HỘI</h3>
                                <div class="block_input">
                                    <label>Địa chỉ trụ sở của hội hiện nay <i>(số nhà, đường phố (thôn xóm), phường (xã),quận ( huyện )</i></label>
                                    <p><strong>Số 68 ngõ 69 đường thành công quận thanh xuân</strong></p>
                                </div>
                                <div class="block_input">
                                    <label>Số điện thoại:</label>
                                    <span><strong>0912345678</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Fax:</label>
                                    <span><strong>0912345678</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Website:</label>
                                    <span><strong>htnsoft.com</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Email:</label>
                                    <span><strong>htnsoft@gmail.com</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Diện tích trụ sở:</label>
                                    <span><strong>1 tỷ hecta</strong></span>
                                </div>
                                <div class="block_input">
                                    <h4>Do Hội thuê (bằng nguồn kinh phí của hội hoặc nhà nước hỗ trợ kinh phí)</h4>
                                    <div class="block_input">
                                        <label>Tự có:</label>
                                        <span><strong>1 tỷ hecta</strong></span>
                                    </div>
                                    <div class="block_input">
                                        <label>Nhà nước cấp (Ghi rõ Số Quyết định hoặc Hợp đồng) :</label>
                                        <span><strong>Không có</strong></span>
                                    </div>
                                </div>
                                <h3>IV. PHẠM VI HOẠT ĐỘNG</h3>
                                <div class="block_input">
                                    <label>Hội có phạm vi hoạt động:</label>
                                    <span><strong>Thành phố</strong></span>
                                </div>
                                <h3>V. LĨNH VỰC HOẠT ĐỘNG</h3>
                                <div class="block_input">
                                    <label>Lĩnh vực chính hội đang hoạt động:</label>
                                    <span><strong>Công nghệ</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Lĩnh vực khác hội tham gia hoạt động :</label>
                                    <span><strong>Kinh doanh</strong></span>
                                </div>
                                <h3>VI. CÁC KỲ ĐẠI HỘI</h3>
                                <div class="block_input">
                                    <label>Nhiệm kỳ của hội:</label>
                                    <span><strong>5 năm</strong></span>
                                </div>
                                <div class="block_input">
                                <label>Từ khi thành lập đến nay đã qua bao nhiêu kỳ đại hội:</label>
                                <p><strong>8 kỳ đại hội</strong></p>
                                </div>
                                <h3>VII. TỔ CHỨC ĐẢNG TRONG HỘI</h3>
                                <div class="block_input">
                                    <label>Hội có tổ chức đảng:</label>
                                    <span><strong>Không</strong></span>
                                </div>
                                <div class="block_input">
                                    <label>Nếu có ghi rõ:</label>
                                    <span><strong>Không có</strong></span>
                                </div>
                                
                            </form>

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
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Công ty CP HTN
                                            </td>
                                            <td>
                                                19686868
                                            </td>
                                            <td>
                                                01/07/2008
                                            </td>
                                            <td>
                                                Bộ công thương
                                            </td>
                                        </tr>
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
                        </div>                 
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
@endsection