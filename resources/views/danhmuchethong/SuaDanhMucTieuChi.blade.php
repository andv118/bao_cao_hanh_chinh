@extends('master')

@section('content')
		@if(Session::has('success'))
        <div class="alert alert-success" style="margin-top: 30px;">
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{Session::get('success')}}</strong>
        </div>
        @endif
<form action="{{route('admin.PostSuaDanhMucTieuChi')}}" method="POST" role="form">
	@csrf
	<input type="hidden" name="id" value="{{$data[0]['id']}}">
	<div class="form-group">
		<label for="">Tên danh mục</label>
		<input type="text" class="form-control" name="TenDanhMuc" placeholder="Nhập tên" value="{{$data[0]['DanhMuc']}}">
	</div>
	<div class="form-group">
		<label for="" style="display: block;">Danh mục cha</label>
		<select name="DanhMucCha">
			@foreach($data2 as $item)
			@if($item->id == $data[0]['DanhMucCha'])
			<option value="{{$data[0]['DanhMucCha']}}">{{$item->DanhMuc}}</option>
			@else
			
			<option value="">-- Chọn Danh Mục Cha --</option>
			@break
			@endif
			@endforeach
			@foreach($data2 as $item)
			@if($item->id == $data[0]['DanhMucCha'])
			@continues
			@else
			<option value="{{$item->id}}">{{$item->DanhMuc}}</option>
			@endif

			@endforeach
		</select>
	</div>

	<button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

@endsection