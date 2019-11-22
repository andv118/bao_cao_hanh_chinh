@extends('master')

@section('content')
<div class="danh-muc-hanh-chinh">
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="ver1">STT</th>
					<th>Sở, Ban, Ngành</th>
					<th>Quận/huyện</th>
					<th>Xem chi tiết</th>
					<th>Sửa</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="ver1">1</td>
					<td>Sở giao thông</td>
					<td>Hà đông</td>
					<td><a href="{{route('admin.ChiTietDanhMucHanhChinh')}}">Xem chi tiết</a></td>
					<td><a class="btn btn-primary" href="{{route('admin.SuaDanhMucHanhChinh')}}">Sửa</a></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection