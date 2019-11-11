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
                            @if(Session::has('success'))
                                <div class="alert alert-success" style="text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{Session::get('success')}}
                                </div>
                            @endif
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <form class="col-sm-8 form-horizontal col-sm-offset-2 form_input_default {{Session::has('success') ? 'show' : 'show' }}" enctype="multipart/form-data" method="post" action="{{route('admin.saveInfo')}}">
                                @csrf
                                <h3>I. TÊN HỘI:</h3>
                                <div class="block_input">
                                    <label>Tên đầy đủ bằng tiếng Việt:</label>
                                    <input type="text" name="vietnamese_name" placeholder="" value="{{$data['vietnamese_name']}}" />
                                </div>
                                <div class="block_input">
                                    <label>Tên bằng tiếng Anh (nếu có):</label>
                                    <input type="text" name="english_name" placeholder="" value="{{$data['english_name']}}" />
                                </div>
                                <div class="block_input">
                                    <label>Tên giao dịch bằng tiếng Anh (nếu có):</label>
                                    <input type="text" name="deal_name" placeholder="" value="{{$data['deal_name']}}" />
                                </div>
                                <div class="block_input">
                                    <label>Quyết định cho phép thành lập hội (số, ngày, tháng, cơ quan ban hành):</label>
                                    <textarea type="text" name="establish" placeholder="Nhập quyết định" value="{{$data['establish']}}" style="display: block;" ></textarea>
                                </div>
                                <div class="block_input">
                                    <label>Quyết định phê duyệt Điều lệ (số, ngày, tháng, cơ quan ban hành):</label>
                                    <textarea type="text" name="pending" placeholder="Nhập quyết định" value="{{$data['pending']}}" style="display: block;" ></textarea>
                                </div>
                                <div class="block_input">
                                    <label>Tên cơ quan quản lý nhà nước về ngành, lĩnh vực mà hội hoạt động (Ví dụ: Sở Công thương, Sở Lao động, Thương binh &amp; Xã hội):</label>
                                    <textarea type="text" name="organ_manage" placeholder="Nhập tên cơ quan" value="{{$data['organ_manage']}}" style="display: block;" ></textarea>
                                </div>
                                <h3>II. LOẠI HỘI :</h3>
                                <select name="id_type" required>
                                    <option value="{{$data['id_type']}}">
                                    @foreach($type as $item)
                                    @if ($item->id == $data['id_type'])
                                        {{$item->name}}
                                    @endif
                                    @endforeach
                                    </option>
                                    @foreach($type as $item)

                                    <option value="{{$item->id}}">{{$item->name}}</option>

                                    @endforeach
                                </select>
                                <h3>III. TRỤ SỞ HỘI</h3>
                                <div class="block_input">
                                    <label>Địa chỉ trụ sở của hội hiện nay <i>(số nhà, đường phố (thôn xóm), phường (xã),quận ( huyện )</i></label>
                                    <textarea type="text" name="address" value="{{$data['address']}}" placeholder="Địa chỉ..."></textarea>
                                </div>
                                <div class="block_input">
                                    <label>Số điện thoại:</label>
                                    <input type="tel" name="number_phone" value="{{$data['number_phone']}}" placeholder="">
                                </div>
                                <div class="block_input">
                                    <label>Fax:</label>
                                    <input type="number" name="fax" value="{{$data['fax']}}" placeholder="">
                                </div>
                                <div class="block_input">
                                    <label>Website:</label>
                                    <input type="text" name="website" value="{{$data['website']}}" placeholder="">
                                </div>
                                <div class="block_input">
                                    <label>Email:</label>
                                    <input type="email" name="email" value="{{$data['email']}}" placeholder="">
                                </div>
                                <div class="block_input">
                                    <label>Diện tích trụ sở:</label>
                                    <input type="text" name="area" value="{{$data['area']}}" placeholder="">
                                </div>
                                <div class="block_input">
                                    <h4>Do Hội thuê (bằng nguồn kinh phí của hội hoặc nhà nước hỗ trợ kinh phí)</h4>
                                    <div class="block_input">
                                        <label>Tự có:</label>
                                        <input type="text" name="funding" value="{{$data['funding']}}" placeholder="">
                                    </div>
                                    <div class="block_input">
                                        <label>Nhà nước cấp (Ghi rõ Số Quyết định hoặc Hợp đồng) :</label>
                                        <input type="text" name="state_level" value="{{$data['state_level']}}" placeholder="">
                                    </div>
                                </div>
                                <h3>IV. PHẠM VI HOẠT ĐỘNG</h3>
                                <div class="block_input">
                                    <label>Hội có phạm vi hoạt động:</label>
                                    <select name="arena">
                                        <option>{{$data['arena']}}</option>
                                        <option value="Thành phố">Thành phố</option>
                                        <option value="Quận, Huyện">Quận, huyện</option>
                                        <option value="Xã, phường, thị trấn">Xã, phường, thị trấn</option>
                                    </select>
                                </div>
                                <h3>V. LĨNH VỰC HOẠT ĐỘNG</h3>
                                <div class="block_input">
                                    <label>Lĩnh vực chính hội đang hoạt động:</label>
                                    <input type="text" name="field_active" value="" placeholder="">
                                </div>
                                <div class="block_input">
                                    <label>Lĩnh vực khác hội tham gia hoạt động :</label>
                                    <input type="text" name="field_other" value="" placeholder="">
                                </div>
                                <h3>VI. CÁC KỲ ĐẠI HỘI</h3>
                                <div class="block_input">
                                    <label>Nhiệm kỳ của hội:</label>
                                    <select name="term">
                                        <option>{{$data['term']}}</option>
                                        <option value="2">2 năm</option>
                                        <option value="3">3 năm</option>
                                        <option value="4">5 năm</option>
                                    </select>
                                </div>
                                <div class="block_input">
                                <label>Từ khi thành lập đến nay đã qua bao nhiêu kỳ đại hội:</label>
                                <textarea name="term_current" type="text" placeholder="Nhiệm kỳ hiện tại:" value="{{$data['term_current']}}"></textarea>
                                </div>
                                <h3>VII. TỔ CHỨC ĐẢNG TRONG HỘI</h3>
                                <div class="block_input">
                                    <label>Hội có tổ chức đảng:</label>
                                    <select name="is_systematical">
                                        <option>{{$data['is_systematical']}}</option>
                                        <option value="1">Có</option>
                                        <option value="0">Không</option>
                                    </select>
                                </div>
                                <div class="block_input">
                                    <label>Nếu có ghi rõ:</label>
                                    <select name="note">
                                        <option>{{$data['note']}}</option>
                                        <option value="Đảng đoàn">Đảng đoàn</option>
                                        <option value="Đảng bộ">Đảng bộ</option>
                                        <option value="Chi bộ">Chi bộ</option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Lưu lại</button>
                                </div>
                            </form>

                            <form action="{{route('admin.saveRename')}}" method="post" class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                               @csrf 
                               <h3 >VIII. ĐỔI TÊN, SÁP NHẬP, GIẢI THỂ</h3>
                                <p>Từ khi thành lập đến nay, Hội đã đổi tên, sáp nhập, giải thể mấy lần? .Nếu có ghi rõ:</p>
                                <label>1. Đổi tên</label>
                                <div style="margin-bottom: 30px;">
                                
                                </div>
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
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="name" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="number_decision" value="">
                                            </td>
                                            <td>
                                                <input type="date" name="date_decision" value="" placeholder=".../.../...">
                                            </td>
                                            <td>
                                                <input type="text" name="organ_decision" value="">
                                            </td>
                                        </tr>
                                    </tbody>
                                  </table>
                                </div>

                                <button type="submit" class="btn btn-primary">Lưu lại</button>
                            </form>
                            <br>
                            <form method="post" action="{{route('admin.saveJoining')}}" class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                @csrf
                                <label>2. Sáp nhập</label>
                                <select name="id_info"  class="form-control">
                                     <option value="{{$data['id']}}">{{$data['vietnamese_name']}}</option>
                                </select>
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
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="name" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="number_decision" value="">
                                            </td>
                                            <td>
                                                <input type="date" name="date_decision" value="" placeholder=".../.../...">
                                            </td>
                                            <td>
                                                <input type="text" name="organ_decision" value="">
                                            </td>
                                        </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <button class="btn btn-primary" type="submit">Lưu lại</button>
                               </form>
                                <br>
                                <br>

                               <form method="post" action="" class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                @csrf
                                <label>3. Giải thể</label>
                                 <select name="id_info"  class="form-control">
                                     <option value="{{$data['id']}}">{{$data['vietnamese_name']}}</option>
                                </select>
                                <div class="table-responsive">
                                  <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Năm</th>
                                            <th>Tên hội</th>
                                            <th>Số Quyết định</th>
                                            <th>Ngày tháng ra quyết định</th>
                                            <th>Cơ quan ra quyết định</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="number" name="year" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="name" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="number_decision" value="">
                                            </td>
                                            <td>
                                                <input type="date" name="date_decision" value="" placeholder=".../.../...">
                                            </td>
                                            <td>
                                                <input type="text" name="organ_decision" value="">
                                            </td>
                                        </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <button class="btn btn-primary" type="submit">Lưu lại</button>
                            </form>

                            <form action="" method="post" class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                @csrf
                                <h3>IX. KINH PHÍ HOẠT ĐỘNG CỦA HỘI</h3>
                                <label>1. Tổng kinh phí hoạt động trong 1 năm của hội</label>
                                <div style="margin-bottom: 30px;">
                                    <select name="id_info"  class="form-control">
                                       
                                        <option value="{{$data['id']}}">{{$data['vietnamese_name']}}</option>
                                    </select>
                                </div>
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
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Kinh phí do hội viên đóng góp
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Kinh phí của các tổ chức trực thuộc hội đóng góp
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Kinh phí từ các dịch vụ của hội
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Kinh phí từ nguồn tài trợ cả các tổ chức trong nước, nước ngoài (nếu tài trợ bằng hiện vật ghi rõ hiện tên hiện vật và có thể quy đổi bằng tiền)
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Các nguồn thu khác (nếu có)
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
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
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Chi mua sắm, sửa chữa trang thiết bị, cơ sở vật chất
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Thuế (nếu có)
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tích lũy (nếu có)
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Khen thưởng
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Các khoản chi khác
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                        </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu lại</button>
                            </form>
                            <form class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                <h3>X. CƠ SỞ VẬT CHẤT, TRANG THIẾT BỊ (NGOÀI TRỤ SỞ)</h3>
                                 <div style="margin-bottom: 30px;">
                                    <select name="id_info"  class="form-control">
                                       
                                        <option value="{{$data['id']}}">{{$data['vietnamese_name']}}</option>
                                    </select>
                                </div>
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
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <select>
                                                    <option>-- Chọn --</option>
                                                    <option>-- Không --</option>
                                                    <option>-- Hoạt động --</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                            <td>
                                                <input type="number" name="" value="">
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu lại</button>
                            </form>
                            <!-- XI. LÃNH ĐẠO CHỦ CHỐT CỦA HỘI -->
                            <form class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                <h3>XI. LÃNH ĐẠO CHỦ CHỐT CỦA HỘI</h3>
                                <h4>1. Lãnh đạo chủ chốt của hội</h4>
                                 <div style="margin-bottom: 30px;">
                                    
                                </div>
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
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <select>
                                                    <option>-- Chọn --</option>
                                                    <option>-- Chủ tịch --</option>
                                                    <option>-- Phó chủ tịch --</option>
                                                    <option>-- Tổng thư ký --</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                            <!-- XII. HỘI VIÊN, THÀNH VIÊN, CÁC TỔ CHỨC CƠ SỞ THUỘC HỘI -->
                            <form class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                <h3>XII. HỘI VIÊN, THÀNH VIÊN, CÁC TỔ CHỨC CƠ SỞ THUỘC HỘI</h3>

                                 <div style="margin-bottom: 30px;">
                                    
                                </div>
                                <p>
                                <strong>
                                    1. Số lượng hội viên hiện có 03 kỳ đại hội gần nhất: 
                                    <input type="text" name="" value="">
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
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                            
                            <form class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                <h4>Hội viên danh dự</h4>

                                 <div style="margin-bottom: 30px;">
                                    
                                </div>
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
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                            
                            <form class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                <h4>Hội viên người nước ngoài</h4>

                                 <div style="margin-bottom: 30px;">
                                    
                                </div>
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
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                            
                            <form class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                <h3>2. Hội viên tổ chức</h3>

                                 <div style="margin-bottom: 30px;">
                                    
                                </div>
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
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                            <!-- Hội viên danh dự -->
                            <form class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                <h3>3. Đơn vị trực thuộc hội</h3>
                                <p><strong>a. Tổ chức có tư cách pháp nhân trực thuộc hội</strong></p>
                                 <div style="margin-bottom: 30px;">
                                    
                                </div>
                                <div class="table-responsive">
                                  <table class="table table-bordered jambo_table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">STT</th>
                                            <th rowspan="2">Tên đơn vị</th>
                                            <th rowspan="2">Địa chỉ</th>
                                            <th rowspan="2">Số điện thoại</th>
                                            <th rowspan="2">Cơ quan thành lập hoặc cho phép tổ chức thuộc hội</th>
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
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                            <!-- Hội viên người nước ngoài -->
                            <form class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                
                                <p><strong>b. Tổ chức cơ sở thuộc hội (liên chi hội, chi hội, phân hội, tổ hội thuộc hội)</strong></p>
                                 <div style="margin-bottom: 30px;">
                                    
                                </div>
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
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                            <!-- Hội viên tổ chức -->
                            <form class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                <h3>XIII. NGƯỜI CÔNG TÁC TẠI HỘI</h3>
                                <p><strong>Số biên chế được giao (công chức, viên chức, định mức lao động, hợp đồng 68) <input type="number" name="" value=""></strong></p>
                                <p><strong>2. Số biên chế hiện có</strong></p>
                                <p><strong>a) Công chức, viên chức, định mức lao động, hợp đồng 68</strong></p>
                                 <div style="margin-bottom: 30px;">
                                    
                                </div>
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
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                            <!-- Tổ chức có tư cách pháp nhân trực thuộc hội -->
                            <form class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                
                                <p><strong>b. Người nghỉ hưu làm công tác hội</strong></p>
                                 <div style="margin-bottom: 30px;">
                                    
                                </div>
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
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                            <!-- Tổ chức cơ sở thuộc hội (liên chi hội, chi hội, phân hội, tổ hội thuộc hội) -->
                            <form class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                
                                <p><strong>3. Tổng số hợp đồng lao động do hội tự ký bằng nguồn kinh phí của hộ</strong></p>
                                 <div style="margin-bottom: 30px;">
                                    
                                </div>
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
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="" value="">
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                <div style="display: flex;justify-content: space-around;">
                                    <p class="text-center"><strong>Người cung cấp thông tin</strong><br><i>(Ký, ghi rõ họ tên)</i></p>
                                    <p class="text-center"><strong>Lãnh đạo đơn vị</strong><br><i>(Ký, ghi rõ họ tên)</i></p>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                            <!-- XIII. NGƯỜI CÔNG TÁC TẠI HỘI -->
                            <form class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                
                                <h3>XIII. BỘ QUY TẮC</h3>
                                 <div style="margin-bottom: 30px;">
                                    
                                </div>
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
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                2. Quy chế hoạt động của Ban Chấp hành:
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                               3. Quy chế hoạt động của Ban Thường vụ:
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                4. Quy chế quản lý, sử dụng tài chính, tài sản của hội:
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                5. Quy chế quản lý, sử dụng con dấu của hội
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                6. Quy chế khen thưởng, kỷ luật:
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                7. Quy chế lương, phụ cấp…:
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                8. Công tác khiếu nại tố cáo:
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                9. Các quy định nội bộ khác của hội:
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" value="">
                                            </td>
                                            
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                            <!-- XIV. KHÁI QUÁT TÌNH HÌNH HÌNH HOẠT ĐỘNG CỦA HỘI -->
                            <form class="form_table_default form-horizontal col-xs-12 {{Session::has('success') ? 'show' : 'show' }}">
                                
                                <h3>XIV. KHÁI QUÁT TÌNH HÌNH HÌNH HOẠT ĐỘNG CỦA HỘI</h3>
                                <p><strong>1. Những kết quả đạt được</strong><i>(Khái quát tình hình hoạt động từ khi thành lập cho đến nay, nêu kết quả hoạt động cụ thể trong 3 năm gần đây từ 2014-2016)</i></p>
                                 <div style="margin-bottom: 30px;">
                                    
                                </div>
                                <textarea name="" type="text"></textarea>
                                <p><strong>2. Những tồn tại, hạn chế</strong></p>
                                <textarea name="" type="text"></textarea>
                                <p><strong>3. Đề xuất, kiến nghị</strong></p>
                                <textarea name="" type="text"></textarea>
                                <p><strong>Ghi chú</strong><i>Yêu cầu đơn vị gửi các tài liệu (bản photocopy) kèm theo Phiếu cung cấp thông tin về hội: Quyết định thành lập, Điều lệ hội, Giấy đăng ký mẫu dấu, Bộ quy tắc, danh sách trích ngang (họ tên, ngày tháng năm sinh, giới tính, chức danh, chức vụ, đơn vị công tác trước khi tham gia hội, số điện thoại) của Ban Chấp hành, Ban Thường vụ, Ban Kiểm tra…), đối chiếu khi nhập dữ liệu./.</i></p>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>                 
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
</div>
@endsection