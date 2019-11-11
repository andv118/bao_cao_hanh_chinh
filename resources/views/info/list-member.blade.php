@extends('master')

@section('content')
<style>
    tbody tr td{
        text-align: center;
        font-size: 16px;
        vertical-align: middle !important;
    }
</style>
 <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>/PHIẾU CUNG CẤP THÔNG TIN VỀ HỘI</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="table-responsive">
                                  <table class="table table-bordered jambo_table">
                                    <thead>
                                        <tr>
                                            <th width="40px">STT</th>
                                            <th>Tên đăng nhập</th>
                                            <th>Họ và tên</th>
                                            <th>Số điện thoại</th>
                                            <th width="200px">Mô tả</th>
                                            <th width="60px">Xem chi tiết</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                       
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                phongtd
                                            </td>
                                            <td>
                                                Trương Đại Phong
                                            </td>
                                            <td>
                                                0934456169
                                            </td>
                                            <td>
                                                Tham gia hoạt động về lĩnh vực bất động sản và đã đóng góp rất nhiều cho việc thúc đẩy sự nghiệp công nghiệp hóa hiện đại hóa
                                            </td>
                                            <td>
                                                <a href="">Xem chi tiết</a>
                                            </td>
                                            

                                        </tr>

                                        <tr>
                                            <td>
                                               2
                                            </td>
                                            <td>
                                                buidung
                                            </td>
                                            <td>
                                                Bùi Văn Dũng
                                            </td>
                                            <td>
                                                0974498268
                                            </td>
                                            <td>
                                                Tham gia hoạt động về lĩnh vực Cà Phê Ca Cao Việt Nam và đã đóng góp rất nhiều những thành công trong lĩnh vực này.
                                            </td>
                                            <td>
                                                <a href="">Xem chi tiết</a>
                                            </td>
                                            

                                        </tr>
                                        
                                        <tr>
                                            <td>
                                               3
                                            </td>
                                            <td>
                                                ngosi
                                            </td>
                                            <td>
                                                Ngô Văn Sĩ
                                            </td>
                                            <td>
                                                0934498168
                                            </td>
                                            <td>
                                                Tham gia hoạt động về lĩnh vực Thép Việt Nam và đã đóng góp rất nhiều những thành công trong lĩnh vực này.
                                            </td>
                                            <td>
                                                <a href="">Xem chi tiết</a>
                                            </td>
                                            

                                        </tr>
                                        
                                    </tbody>
                                  </table>
                                </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
@endsection