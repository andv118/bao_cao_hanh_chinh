@extends('master')

@section('content')
		@if(Session::has('delete'))
        <div class="alert alert-danger" style="margin-top: 30px;">
            <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{Session::get('delete')}}</strong>
        </div>
        @endif
<a href="{{route('admin.themmoitieuchi')}}" class="btn btn-success">Thêm mới</a>
<div class="danh-muc-hanh-chinh">
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="ver1">STT</th>
					<th>Tiêu chí</th>
					<th>Danh mục</th>
					<th class="ver1">Sửa</th>
					<th class="ver1">Xóa</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if (Auth::check()) {
				      $id_So_Ban_Nganh = Auth::user()->id_So_Ban_Nganh;
				      $id_QuanHuyen = Auth::user()->id_hanhchinh;
				    }
				?>
				<?php $stt=1; ?>

				@if($id_QuanHuyen != null)

				@foreach($JoinQHTC as $val)

				@if($val->id_quan_huyen == $id_QuanHuyen)
				
				@foreach($data as $item)
				
				@if($item->id_So_Ban_Nganh == $id_So_Ban_Nganh && $val->id_tieu_chi == $item->id)
				
				
				<tr>
					<td class="ver1">{{$stt}}</td>
					<td>{{$item->TieuChi}}</td>
					@foreach($DanhMuc as $item_danhmuc)
					@if($item->DanhMuc == $item_danhmuc->id)
					<td>{{$item_danhmuc->DanhMuc}}</td>
					@endif
					@endforeach
					<td class="ver1"><a class="btn btn-primary" href="{{route('admin.SuaTieuChi',$item->id)}}">Sửa</a></td>
					<td class="ver1">
						<form action="{{route('admin.XoaTieuChi',$item->id)}}" method="get" onsubmit="return confirmDelete();">
                                <button class="btn btn-danger" type="submit"><i class="far fa-trash-alt" style="color: white;"></i></button>
                           </form>
                       </td>
				</tr>
				<?php $stt++; ?>

				@endif

				@endforeach

				@endif

				@endforeach

				@else

				@foreach($data as $item)
				
				@if($item->id_So_Ban_Nganh == $id_So_Ban_Nganh)
				
				
				<tr>
					<td class="ver1">{{$stt}}</td>
					<td>{{$item->TieuChi}}</td>
					@foreach($DanhMuc as $item_danhmuc)
					@if($item->DanhMuc == $item_danhmuc->id)
					<td>{{$item_danhmuc->DanhMuc}}</td>
					@endif
					@endforeach
					<td class="ver1"><a class="btn btn-primary" href="{{route('admin.SuaTieuChi',$item->id)}}">Sửa</a></td>
					<td class="ver1">
						<form action="{{route('admin.XoaTieuChi',$item->id)}}" method="get" onsubmit="return confirmDelete();">
                                <button class="btn btn-danger" type="submit"><i class="far fa-trash-alt" style="color: white;"></i></button>
                           </form>
                       </td>
				</tr>
				<?php $stt++; ?>

				@endif

				@endforeach

				@endif
			</tbody>
		</table>
	</div>
</div>
<script>
   function confirmDelete(){
            var r = confirm("Bạn có chắc chắn muốn xóa không?");
            if(r) return true;
            else return false;
    }

</script>
@endsection