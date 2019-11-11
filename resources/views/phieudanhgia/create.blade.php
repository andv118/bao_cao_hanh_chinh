 @extends('master')

@section('content')
  <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-home"></i>| Quản lý phiếu đánh giá hội | Thêm mới</b></div>
            <div class="panel-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar"></div>
                    <div class="fixed-table-container">
                        <div class="fixed-table-header">
                        	<h3 ><b>PHIẾU ĐÁNH GIÁ HỘI</b></h3>
                        </div>
                       
                        <div class="fixed-table-body" style="margin-top: 30px;">
                            <div class="fixed-table-loading " style="top: 37px; display: none;">Loading, please wait…</div>
                            <form method="post">
                                <div class="form-group">
                                    <label for="email">Tên phiếu:</label>
                                    <input type="text" placeholder="Nhập tên phiếu" class="form-control"  style="width: 400px;">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Mã phiếu:</label>
                                    <input type="text" placeholder="Nhập mã phiếu" class="form-control" style="width: 400px;">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Tiêu chuẩn:</label>
                                    <input type="text" placeholder="Nhập mã tiêu chuẩn" class="form-control" style="width: 400px;">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Tiêu chí:</label>
                                    <input type="text" placeholder="Nhập tiêu chí" class="form-control" style="width: 400px;">
                                </div>
                                <p><b>1. Mô tả hiện trạng (Mô tả theo từng mức đánh giá đối với từng chỉ báo):</b></p>
                                <div class="form-group">
                                    <label for="pwd">1.1.Mức 1:</label><br>
                                   <b> a)</b><input type="text" class="form-control" style="width: 400px;"> 
                                   <b> b)</b><input type="text" class="form-control" style="width: 400px;"> 
                                   <b> c)</b><input type="text" class="form-control" style="width: 400px;">
                                </div>
                                 <div class="form-group">
                                    <label for="pwd">1.2.Mức 2 (Nếu có):</label><br>
                                    <input type="text" class="form-control" style="width: 400px;"> 
                                </div> 
                                <div class="form-group">
                                    <label for="pwd">1.3.Mức 3 (Nếu có):</label><br>
                                    <input type="text" class="form-control" style="width: 400px;"> 
                                </div>
                                 <div class="form-group">
                                    <label for="pwd">2.Điểm mạnh:</label><br>
                                     <textarea style="width: 400px;"></textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="pwd">3.Điểm yếu:</label><br>
                                    <textarea style="width: 400px;"></textarea> 
                                </div>
                                <div class="form-group">
                                    <label for="pwd">4.Kế hoạch phát triển hội:</label><br>
                                   <textarea style="width: 600px;"></textarea>
                                </div>
                                <p><b>5.Tự đánh giá</b></p>
                                <table data-toggle="table"  class="table table-hover table-bordered table-responsive table-striped jambo_table bulk_action">
                                    <thead >
                                        <tr>
                                            <th  colspan="2"  style="text-align: center;">Mức 1</th>
                                            <th  colspan="2"   style="text-align: center;">Mức 2</th>
                                            <th  colspan="2"   style="text-align: center;">Mức 3</th>
                                        </tr>
                                        <tr>
                                            <th  style="text-align: center;">Chỉ báo</th>
                                            <th  style="text-align: center;">Đạt/ Không đạt</th> 
                                            <th  style="text-align: center;">Chỉ báo</th>
                                            <th  style="text-align: center;">Đạt/ Không đạt (Nếu có)</th>
                                            <th  style="text-align: center;">Chỉ báo</th>
                                            <th  style="text-align: center;">Đạt/ Không đạt (Nếu có)</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                            <td style="text-align: center;"><input type="text" name="" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align: center;">Đạt/ Không đạt</td>
                                            <td colspan="2" style="text-align: center;">Đạt/ Không đạt</td>
                                            <td colspan="2" style="text-align: center;">Đạt/ Không đạt</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                             <button type="submit" class="btn btn-info">Lưu lại</button>
                        </div>  
                        
                         <a href="{{route('admin.quanlyphieu.phieudanhgia')}}" class="btn btn-success"><i class="fa fa-undo-alt"></i> Quay lại</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
  </div>
@endsection