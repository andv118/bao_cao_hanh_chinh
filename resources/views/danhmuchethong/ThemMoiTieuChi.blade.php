@extends('master')

@section('content')
		@if(Session::has('success'))
        <div class="alert alert-success" style="margin-top: 30px;">
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{Session::get('success')}}</strong>
        </div>
        @endif
<form method="post" action="{{route('admin.luutieuchi')}}" name="myForm">
	@csrf
	<div class="mgb_30">
		<label>Tiêu chí</label>
		<div class="mgb_30">
			<textarea placeholder="Nhập tiêu chí" name="TenTieuChi" required></textarea>
		</div>
	</div>
	<div class="mgb_30">
		<label>Số Lượng ( Nếu có )</label>
		<div class="mgb_30">
			<textarea placeholder="Nhập số lượng" name="SoLuong"></textarea>
		</div>
	</div>
	<div class="mgb_30">
		<label>Đơn vị tính ( Nếu có )</label>
		<div class="mgb_30">
			<textarea placeholder="Nhập đơn vị tính" name="DonViTinh"></textarea>
		</div>
	</div>
	<div class="mgb_30">
		<label>Giải Trình/tên văn bản, số ký hiệu, ngày tháng năm ban hành văn bản/tài liệu đính kèm</label>
		<div class="mgb_30">
			<textarea placeholder="Giải Trình/tên văn bản, số ký hiệu, ngày tháng năm ban hành văn bản/tài liệu đính kèm" name="GiaiTrinh"></textarea>
		</div>
	</div>
	<div class="mgb_30">
		<label>Tiêu chí cha</label>
		<div class="mgb_30">
			<select name="TieuChiCha">
				<option value="">--Chọn tiêu chí cha--</option>
				@foreach($data2 as $item)
				<option value="{{$item->id}}">{{$item->TieuChi}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="mgb_30">
		<label>Danh mục</label>
		<div class="mgb_30">
			<select name="DanhMuc">
				<option value="">--Chọn danh mục--</option>
				@foreach($DanhMuc as $item)
				<option value="{{$item->id}}">{{$item->DanhMuc}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="mgb_30">
		<label>Quận/Huyện</label>
		<div class="mgb_30">
			<select name="QuanHuyen">
				<option value="">--Chọn quận huyện--</option>
				@foreach($QuanHuyen as $item)
				<option value="{{$item->id}}">{{$item->Ten}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<button type="submit" class="btn btn-primary">Thêm mới</button>
</form>
<!-- <script>
function validateForm() {
  var x = document.forms["myForm"]["TenTieuChi"].value;
  if (x == "") {
    alert("Bạn chưa nhập tiêu chí!!!");
    return false;
  }
}
</script> -->
@endsection