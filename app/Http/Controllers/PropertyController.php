<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Cell;
use App\Property;
use App\Streets;
use App\Phonebook;
use App\Landcost;
use App\Typehouse;
use Hash;
use Session;
use Auth;


class PropertyController extends Controller
{
  
  public function declare_property(Request $req){
     $id = $req->id;
     $data = Landcost::all();
     $data2 = Typehouse::all(); 
     $data3 = Phonebook::where('id_phonebook',$id)->get();
     return view('taisan/declare',compact('data','data2','data3'));
  }

  public function search_property(Request $req){
     $key = $req->keyword;
     $select = $req->select;
     if($key==""){
        return redirect()->back()->with('loi','Hãy nhập từ khóa tìm kiếm');
     }else{
        if($req->select==1){
          $data = Property::where('tax_code','like','%'.$key.'%')->paginate(20);
        }elseif($req->select==2){
          $data = Property::where('code','like','%'.$key.'%')->paginate(20);
        }elseif($req->select==3){
           $data = Property::where('fullname','like','%'.$key.'%')->paginate(20);
        }
        return view('taisan/search',compact('data','key','select'));
     }
     
  } 


  public function getProperty(Request $req){
     $key = $req->key;
     
     $data = Phonebook::where('tax_code','like','%'.$key.'%')->get()->toArray();
     if(count($data)>0){
       echo "<ul>";
       foreach ($data as $key => $v) {
         echo "<li>".$v['tax_code']."</li>";
       }
       echo "</ul>";
     }
    
  } 

  public function getPropertyById(Request $req){
     $key = $req->result;
     
     $data = Property::where('tax_code','like','%'.$key.'%')->get()->toArray();

     if(count($data)>0){
       echo "<ul>";
       foreach ($data as $key => $v) {
         echo "<li>".$v['code']."</li>";
       }
       echo "</ul>";
     }
     
    
  } 

  public function getNameByTaxcode(Request $req){
     $key = $req->result; 
     $data = Phonebook::where('tax_code',$key)->get()->toArray();
     if(count($data)>0){
        echo $data[0]['fullname'];
     }
    
  }
    
  public function export_property(){

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Danh sách tài sản');
       
        $excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true)->setSize(12)
                            ->getColor()->setRGB('6F6F5F');
     
        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã tài sản');
        $excel->getActiveSheet()->setCellValue('D1', 'Tên chủ nhà');
        $excel->getActiveSheet()->setCellValue('E1', 'Đoạn đường');
        $excel->getActiveSheet()->setCellValue('F1', 'Tuyến phố');
        $excel->getActiveSheet()->setCellValue('G1', 'Vị trí');
        $excel->getActiveSheet()->setCellValue('H1', 'Loại nhà');
        $excel->getActiveSheet()->setCellValue('I1', 'Số tầng tổng thể');
        $excel->getActiveSheet()->setCellValue('J1', 'Diện tích sàn tổng thể');
        $excel->getActiveSheet()->setCellValue('K1', 'Số tầng cho thuê');
        $excel->getActiveSheet()->setCellValue('L1', 'Diện tích sàn cho thuê');
        $excel->getActiveSheet()->setCellValue('M1', 'Giá cho thuê tổng thể tham chiếu/tháng');
        $excel->getActiveSheet()->setCellValue('N1', 'Giá cho thuê thực tế tham chiếu/tháng');
        $excel->getActiveSheet()->setCellValue('O1', 'Giá trị thực tế cho thuê/tháng (theo hợp đồng)');
        $numRow = 1;
        $stt = 0;
        $row = Property::all()->toArray();
        foreach ($row as $v) {
            $stt+=1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A'.$numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B'.$numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('C'.$numRow, $v['code']);
            $excel->getActiveSheet()->setCellValue('D'.$numRow, $v['fullname']);
            $excel->getActiveSheet() ->setCellValue('E'.$numRow, $v['street']);
            $excel->getActiveSheet() ->setCellValue('F'.$numRow, $v['road']);
            $excel->getActiveSheet() ->setCellValue('G'.$numRow, $v['location']);
            $excel->getActiveSheet() ->setCellValue('H'.$numRow, $v['house_type']);
            $excel->getActiveSheet() ->setCellValue('I'.$numRow, $v['total_floor']);
            $excel->getActiveSheet() ->setCellValue('J'.$numRow, $v['total_area']*$v['total_area']);
            $excel->getActiveSheet() ->setCellValue('K'.$numRow, $v['rent_floor']);
            $excel->getActiveSheet() ->setCellValue('L'.$numRow, $v['rent_area']*$v['rent_area']);
            $excel->getActiveSheet() ->setCellValue('M'.$numRow, number_format($v['total_value']));
            $excel->getActiveSheet() ->setCellValue('N'.$numRow,number_format($v['real_value']));
            $excel->getActiveSheet() ->setCellValue('O'.$numRow, number_format($v['real_price_contract']));
           
        }
       // header('Content-type: application/vnd.ms-excel');
        
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('listproperty.xlsx');
        header('Content-Disposition: attachment; filename="danh-sach-tai-san.xlsx"');
        readfile('listproperty.xlsx');

         //return Excel::download(new UsersExport, 'danhsachcanbo.xlsx');
  }
  public function export_search_property(Request $req){

         $key = $req->keyword;
         $select = $req->select;

        if($select==1){
          $row = Property::where('tax_code','like','%'.$key.'%')->get()->toArray();
        }elseif($select==2){
          $row = Property::where('code','like','%'.$key.'%')->get()->toArray();
        }elseif($select==3){
          $row = Property::where('fullname','like','%'.$key.'%')->get()->toArray();
        }
        
        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Danh sách tài sản');
       
        $excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true)->setSize(12)
                            ->getColor()->setRGB('6F6F5F');
     
        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã tài sản');
        $excel->getActiveSheet()->setCellValue('D1', 'Tên chủ nhà');
        $excel->getActiveSheet()->setCellValue('E1', 'Đoạn đường');
        $excel->getActiveSheet()->setCellValue('F1', 'Tuyến phố');
        $excel->getActiveSheet()->setCellValue('G1', 'Vị trí');
        $excel->getActiveSheet()->setCellValue('H1', 'Loại nhà');
        $excel->getActiveSheet()->setCellValue('I1', 'Số tầng tổng thể');
        $excel->getActiveSheet()->setCellValue('J1', 'Diện tích sàn tổng thể');
        $excel->getActiveSheet()->setCellValue('K1', 'Số tầng cho thuê');
        $excel->getActiveSheet()->setCellValue('L1', 'Diện tích sàn cho thuê');
        $excel->getActiveSheet()->setCellValue('M1', 'Giá cho thuê tổng thể tham chiếu/tháng');
        $excel->getActiveSheet()->setCellValue('N1', 'Giá cho thuê thực tế tham chiếu/tháng');
        $excel->getActiveSheet()->setCellValue('O1', 'Giá trị thực tế cho thuê/tháng (theo hợp đồng)');
        $numRow = 1;
        $stt = 0;
        foreach ($row as $v) {
            $stt+=1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A'.$numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B'.$numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('C'.$numRow, $v['code']);
            $excel->getActiveSheet()->setCellValue('D'.$numRow, $v['fullname']);
            $excel->getActiveSheet() ->setCellValue('E'.$numRow, $v['street']);
            $excel->getActiveSheet() ->setCellValue('F'.$numRow, $v['road']);
            $excel->getActiveSheet() ->setCellValue('G'.$numRow, $v['location']);
            $excel->getActiveSheet() ->setCellValue('H'.$numRow, $v['house_type']);
            $excel->getActiveSheet() ->setCellValue('I'.$numRow, $v['total_floor']);
            $excel->getActiveSheet() ->setCellValue('J'.$numRow, $v['total_area']*$v['total_area']);
            $excel->getActiveSheet() ->setCellValue('K'.$numRow, $v['rent_floor']);
            $excel->getActiveSheet() ->setCellValue('L'.$numRow, $v['rent_area']*$v['rent_area']);
            $excel->getActiveSheet() ->setCellValue('M'.$numRow, number_format($v['total_value']));
            $excel->getActiveSheet() ->setCellValue('N'.$numRow,number_format($v['real_value']));
            $excel->getActiveSheet() ->setCellValue('O'.$numRow, number_format($v['real_price_contract']));
           
        }
       // header('Content-type: application/vnd.ms-excel');
        
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('listpropertysearch.xlsx');
        header('Content-Disposition: attachment; filename="Tìm kiếm tài sản.xlsx"');
        readfile('listpropertysearch.xlsx');

         //return Excel::download(new UsersExport, 'danhsachcanbo.xlsx');
  }




} 


