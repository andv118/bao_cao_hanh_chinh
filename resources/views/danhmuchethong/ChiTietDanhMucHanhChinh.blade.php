@extends('master')

@section('content')
<div class="danh-muc-hanh-chinh">
	

	<?php
		function TieuChi($Join,$TieuChi,$id_TieuChiParent,$DanhMuc,$char='-'){

		    //lấy tiêu chí
			if (Auth::check()) {
		      $id_So_Ban_Nganh = Auth::user()->id_So_Ban_Nganh;
		      $id_QuanHuyen = Auth::user()->id_hanhchinh;

			    foreach ($Join as $value) {

			    	if ($value->id_quan_huyen == $id_QuanHuyen) {
			    		
			    		foreach ($TieuChi as $item) {

			            	if ($item->DanhMuc == $DanhMuc && $item->id_So_Ban_Nganh == $id_So_Ban_Nganh && $item->id == $value->id_tieu_chi) {

			            		if($item->TieuChiCha == $id_TieuChiParent){
				            		echo '<tr>';
					            		echo '<td class="ver1">'.$char.'</td>';
						                echo '<td class="text_left">';
						                    echo $item->TieuChi;
						                echo '</td>';
						                echo '<td class="ver1">'.$item->SoLuong.'</td>';
						                echo '<td class="ver1">'.$item->DonViTinh.'</td>';
						                echo '<td>'.$item->GiaiTrinh.'</td>';
						            echo '</tr>';
						            
						            //Tiếp tục đệ quy để tìm tiêu chí con của tiêu chí đang lặp
			            			TieuChi($TieuChi,$item->id,$DanhMuc,'+');
						        }
			            	}
		            		
			            }
			    	}
			    }
		      	

		    }
		            

	    }

	 
	    function menuParent($Join,$DanhMuc,$id_DanhMucParent,$TieuChi,$id_TieuChiParent,$char='I'){

	        foreach($DanhMuc as $key => $val){
	        	
	            if($val->DanhMucCha==$id_DanhMucParent){
	            	echo '<tr>';
	            		echo '<td class="ver1">'.$char.'</td>';
		                echo '<td class="text_left"><strong style="color:#000;">';
		                    echo $val->DanhMuc;
		                echo '</strong></td>';
		                echo '<td class="ver1"></td>';
		                echo '<td class="ver1"></td>';
		                echo '<td></td>';
		            echo '</tr>';

		            // Xóa chuyên mục đã lặp
            		unset($DanhMuc[$key]);

		            //lấy tiêu chí
		           	TieuChi($Join,$TieuChi,$id_TieuChiParent,$val->id);
		           	
	            	
		            //Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
		            menuParent($Join,$DanhMuc,$val->id,$TieuChi,$id_TieuChiParent,$char.'.I');

	        	}

			}
		}
	 
	?>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="ver1">TT</th>
					<th>Nội dung báo cáo của đơn vị</th>
					<th class="ver1">Số lượng</th>
					<th class="ver1">Đơn vị tính</th>
					<th>Giải trình/tên văn bản, số ký hiệu, ngày tháng năm ban hành văn bản/tài liệu đính kèm</th>
				</tr>
			</thead>
			<tbody>
				
				<?php menuParent($join,$DanhMuc,0,$TieuChi,0,'I'); ?>
				
			</tbody>
		</table>
	</div>
</div>
@endsection