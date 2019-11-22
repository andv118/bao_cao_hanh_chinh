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
					<th class="ver1">Xem chi tiết</th>
					
				</tr>
			</thead>
			<tbody>

				<?php $stt=1; ?>
				@foreach($QH as $item)
				<tr>
					<td class="ver1">{{$stt}}</td>
					<td>{{$SoBanNganh[0]['Ten']}}</td>
					<td>{{$item->Ten}}</td>
					<td class="ver1"><a href="{{route('admin.ChiTietDanhMucHanhChinh',$item->id)}}" class="btn btn-primary">Xem chi tiết</a></td>
					
				</tr>
				<?php $stt++; ?>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection