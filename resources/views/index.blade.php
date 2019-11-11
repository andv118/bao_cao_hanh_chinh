@extends('masterIndex')
@section('content')
		<div class="row">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content_main">
				<h3 class="title relative">TRA CỨU THÔNG TIN TRONG NGÀNH</h3>
			     @if(isset($_GET['search']))
			     <h4><i class="fa fa-search"></i> <b>Kết quả tìm kiếm : <span style="color: red;">{{count($data)}}</span></b></h4>
                 <div class="content_child">
						<?php $stt = 1; ?>
						@foreach ( $data as $item)
						
						<div class="item col-lg-4 col-md-4 col-sm-6 col-xs-6">
							<div class="item-child" >
								<div>
									<img src="public/images/default.jpg" class="img-responsive" alt="">
								</div>
								<h4>{{$stt++}}. {{$item->TenTiengViet}}</h4>
								@if($item->address != '')
								<p>+ Địa chỉ: {{$item->DiaChi}}</p>
								@endif
								@if($item->SoDienThoai != '')
								<p>	+ Điện thoại: {{$item->SoDienThoai}}</p>
								@endif
								@if($item->Email != '')
								<p>	+ Email: {{$item->Email}}</p>
								@endif
								@if($item->Website != '')
								<p>	+ Website: {{$item->Website}}</p>
								@endif
								<div>
									<a href="{{route('thong-tin-chi-tiet-hoi',$item->MaHoi)}}">
										Xem chi tiết
									</a>
								</div>

								@if(Session::has('username'))
								<button data-toggle="modal" data-target="#myModal" class="btn btn-primary">Đánh giá hội</button>
								@endif
							</div>
						</div>
						
						@endforeach
					</div>
			       @else
					<div class="content_child">
						<?php $stt = 1; ?>
						@foreach ( $data as $item)
						
						<div class="item col-lg-4 col-md-4 col-sm-6 col-xs-6">
							<div class="item-child" >
								<div>
									<img src="public/images/default.jpg" class="img-responsive" alt="">
								</div>
								<h4>
										{{$stt++}}. {{$item->TenTiengViet}}
								</h4>
								@if($item->address != '')
								<p>+ Địa chỉ: {{$item->DiaChi}}</p>
								@endif
								@if($item->SoDienThoai != '')
								<p>	+ Điện thoại: {{$item->SoDienThoai}}</p>
								@endif
								@if($item->Email != '')
								<p>	+ Email: {{$item->Email}}</p>
								@endif
								@if($item->Website != '')
								<p>	+ Website: {{$item->Website}}</p>
								@endif
								<div>
									<a href="{{route('thong-tin-chi-tiet-hoi',$item->MaHoi)}}">
										Xem chi tiết
									</a>
								</div>
								@if(Session::has('username'))
								<button data-toggle="modal" data-target="#myModal" class="btn btn-primary">Đánh giá hội</button>
								@endif
							</div>
						</div>
						
						@endforeach
					</div>
					{{$data->links()}}
			       @endif
			</div>
		</div>
		 <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title" style="text-align: center;color: green;"><b>KHẢO SÁT HỘI</b></h3>
                    </div>
                    <div class="modal-body" style="display: flex;align-items: center;justify-content: center;">
                      <a href="{{route('khaosat')}}" class="btn btn-danger">Bắt đầu khảo sát</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
@endsection