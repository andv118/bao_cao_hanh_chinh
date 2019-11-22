@extends('master')

@section('content')
		@if(Session::has('success'))
        <div class="alert alert-success" style="margin-top: 30px;">
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{Session::get('success')}}</strong>
        </div>
        @endif
<form method="post" action="{{route('admin.UpdateTieuChi')}}">
	<input type="hidden" name="id" value="{{$data[0]['id']}}">
	@csrf
	
	<div class="mgb_30">
		<label>Tiêu chí</label>
		<div class="mgb_30">
			<textarea placeholder="Nhập tiêu chí" name="TenTieuChi" required>{{$data[0]['TieuChi']}}</textarea>
		</div>
	</div>
	<div class="mgb_30">
		<label>Số Lượng ( Nếu có )</label>
		<div class="mgb_30">
			<textarea placeholder="Nhập số lượng" name="SoLuong">{{$data[0]['SoLuong']}}</textarea>
		</div>
	</div>
	<div class="mgb_30">
		<label>Đơn vị tính ( Nếu có )</label>
		<div class="mgb_30">
			<textarea placeholder="Nhập đơn vị tính" name="DonViTinh">{{$data[0]['DonViTinh']}}</textarea>
		</div>
	</div>
	<div class="mgb_30">
		<label>Giải Trình/tên văn bản, số ký hiệu, ngày tháng năm ban hành văn bản/tài liệu đính kèm</label>
		<div class="mgb_30">
			<textarea placeholder="Giải Trình/tên văn bản, số ký hiệu, ngày tháng năm ban hành văn bản/tài liệu đính kèm" name="GiaiTrinh" id="GiaiTrinh">{{$data[0]['GiaiTrinh']}}</textarea>
		</div>
	</div>
	<div class="mgb_30">
		<label>Tiêu chí cha</label>
		<div class="mgb_30">
			<select name="TieuChiCha">
				<option value="{{$data[0]['TieuChiCha']}}">
					@foreach($data2 as $item)
					@if($item->id == $data[0]['TieuChiCha'])
					{{$item->TieuChi}}
					@else
					--Chọn Tiêu Chí Cha--
					@break
					@endif
					@endforeach</option>
				@foreach($data2 as $item)
				@if($item->id == $data[0]['TieuChiCha'])
				@continues
				@else
				<option value="{{$item->id}}">{{$item->TieuChi}}</option>
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="mgb_30">
		<label>Danh mục</label>
		<div class="mgb_30">
			<select name="DanhMuc">
				<option value="{{$data[0]['DanhMuc']}}">
					@foreach($DanhMuc as $item)
					@if($item->id == $data[0]['DanhMuc'])
					{{$item->DanhMuc}}
					@endif
					@endforeach
				</option>
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
				@foreach($JoinQHTC as $item)
				@if($item->id_tieu_chi == $data[0]['id'])
				<option value="{{$item->id_quan_huyen}}">
					@foreach($QuanHuyen as $val)
					@if($item->id_quan_huyen == $val->id)
					{{$val->Ten}}
					@endif
					@endforeach
				</option>
				@endif

				@endforeach

				@foreach($QuanHuyen as $item)
				<option value="{{$item->id}}">{{$item->Ten}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

<script>
	window.onload = function () {
        CKEDITOR.replace('GiaiTrinh', {
	        filebrowserBrowseUrl: '{{ asset('public/ckfinder/ckfinder.html') }}',
	        filebrowserImageBrowseUrl: '{{ asset('public/ckfinder/ckfinder.html?type=Images') }}',
	        filebrowserFlashBrowseUrl: '{{ asset('public/ckfinder/ckfinder.html?type=Flash') }}',
	        filebrowserUploadUrl: '{{ asset('public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
	        filebrowserImageUploadUrl: '{{ asset('public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
	        filebrowserFlashUploadUrl: '{{ asset('public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        });
    };
</script>

@endsection