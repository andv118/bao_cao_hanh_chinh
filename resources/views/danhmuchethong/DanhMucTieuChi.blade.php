@extends('master')

@section('content')
@if(Session::has('success'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{Session::get('success')}}</strong>
</div>
@endif
<a class="btn btn-success" data-toggle="modal" href='#modal-themdanhmuc'>Thêm mới</a>
<div class="danh-muc-hanh-chinh">
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="ver1">STT</th>
					<th>Danh Mục</th>
					<th class="ver1">Sửa</th>
				</tr>
			</thead>
			<tbody>
				<?php $stt=1; ?>
				@foreach($data as $item)
				<tr>
					<td class="ver1">{{$stt}}</td>
					<td>{{$item->DanhMuc}}</td>
					<td class="ver1"><a class="btn btn-primary" href="{{route('admin.SuaDanhMucTieuChi',$item->id)}}">Sửa</a></td>
				</tr>
				<?php $stt++; ?>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="modal-themdanhmuc">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title">Thêm mới danh mục</h3>
			</div>
			<div class="modal-body">
				<form action="{{route('admin.ThemDanhMuc')}}" method="POST" role="form">
					@csrf
					<div class="form-group">
						<label for="">Tên danh mục</label>
						<input type="text" class="form-control" name="TenDanhMuc" placeholder="Nhập tên">
					</div>
					<div class="form-group">
						<label for="" style="display: block;">Danh mục cha</label>
						<select name="DanhMucCha">
							<option value="">-- Chọn Danh Mục Cha --</option>
							@foreach($data as $item)
							<option value="{{$item->id}}">{{$item->DanhMuc}}</option>
							@endforeach
						</select>
					</div>
				
					<button type="submit" class="btn btn-primary">Thêm mới</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
			</div>
		</div>
	</div>
</div>


@endsection