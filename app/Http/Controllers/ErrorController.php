<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Cell;
use App\Users;
use App\Phonebook;
use App\Landcost;
use App\Apartment;
use App\Versatilehouse;
use App\Property;
use App\Contract;
use App\Tax;

class ErrorController extends Controller
{
    public function manage_error(){
    	$data1 = Property::where([['real_value','>','100000000'],['manager','<>','1']])->get();
    	$err1 = count($data1);
    	$data2 = Property::whereRaw('property.real_value < property.total_value')->get();
    	$err2 = count($data2);
    	$data3 = Property::whereRaw('property.real_price_contract < property.real_value')->get();
        $err3 = count($data3);
         $data4 = Contract::where([['payment_year','>',100000000],['manager','<>',1]])->get();
         $err4 = count($data4); 
         $data5 =Tax::join('contract','contract.contract_code','=','tax.contract_code')->where([['contract.total_cost','<>','tax.price_contract'],['contract.manager',1]])->get();
         $err5 = count($data5);
    	return view('ruiro/home',compact('err1','err2','err3','err4','err5'));
    }

    public function error5(){
 
    	$data = Property::whereRaw('property.real_value < property.total_value')->get();
    	return view('ruiro/error5',compact('data'));
    }

      public function export_error5(){
        
        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Rủi ro 5');
       
        $excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true)->setSize(12)
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
        $excel->getActiveSheet()->setCellValue('J1', 'Diện tích tổng thể');
        $excel->getActiveSheet()->setCellValue('K1', 'Số tầng cho thuê');
        $excel->getActiveSheet()->setCellValue('L1', 'Diện tích cho thuê');
        $excel->getActiveSheet()->setCellValue('M1', 'Tổng giá trị tài sản tổng thể');
        $excel->getActiveSheet()->setCellValue('N1', 'Tổng giá trị tài sản thực tế cho thuê');
        $numRow = 1;
        $stt = 0;
        $row =  Property::whereRaw('property.real_value < property.total_value')->get()->toArray();
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
            $excel->getActiveSheet() ->setCellValue('J'.$numRow, $v['total_area']);
            $excel->getActiveSheet() ->setCellValue('K'.$numRow, $v['rent_floor']);
            $excel->getActiveSheet() ->setCellValue('L'.$numRow, $v['rent_area']);
            $excel->getActiveSheet() ->setCellValue('M'.$numRow, number_format($v['total_value']));
            $excel->getActiveSheet() ->setCellValue('N'.$numRow, number_format($v['real_value']));
        }
       // header('Content-type: application/vnd.ms-excel');
        
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('error5.xlsx');
        header('Content-Disposition: attachment; filename="rui-ro-5.xlsx"');
        readfile('error5.xlsx');
    }



    public function error4(){
 
    	$data = Property::where([['real_value','>','100000000'],['manager','<>','1']])->get();
    	return view('ruiro/error4',compact('data'));
    }

    public function export_error4(){
        
        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Rủi ro 4');
       
        $excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true)->setSize(12)
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
        $excel->getActiveSheet()->setCellValue('J1', 'Diện tích tổng thể');
        $excel->getActiveSheet()->setCellValue('K1', 'Số tầng cho thuê');
        $excel->getActiveSheet()->setCellValue('L1', 'Diện tích cho thuê');
        $excel->getActiveSheet()->setCellValue('M1', 'Tổng giá trị tài sản tổng thể');
        $excel->getActiveSheet()->setCellValue('N1', 'Tổng giá trị tài sản thực tế cho thuê');
        $numRow = 1;
        $stt = 0;
        $row =  Property::where([['real_value','>','100000000'],['manager','<>','1']])->get()->toArray();
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
            $excel->getActiveSheet() ->setCellValue('J'.$numRow, $v['total_area']);
            $excel->getActiveSheet() ->setCellValue('K'.$numRow, $v['rent_floor']);
            $excel->getActiveSheet() ->setCellValue('L'.$numRow, $v['rent_area']);
            $excel->getActiveSheet() ->setCellValue('M'.$numRow, number_format($v['total_value']));
            $excel->getActiveSheet() ->setCellValue('N'.$numRow, number_format($v['real_value']));
        }
       // header('Content-type: application/vnd.ms-excel');
        
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('error4.xlsx');
        header('Content-Disposition: attachment; filename="rui-ro-4.xlsx"');
        readfile('error4.xlsx');
    }



    public function error3(){
 
    	$data = Property::whereRaw('property.real_price_contract < property.real_value')->get();
    	return view('ruiro/error3',compact('data'));
    }

    public function export_error3(){
        
        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Rủi ro 3');
       
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
        $excel->getActiveSheet()->setCellValue('J1', 'Diện tích tổng thể');
        $excel->getActiveSheet()->setCellValue('K1', 'Số tầng cho thuê');
        $excel->getActiveSheet()->setCellValue('L1', 'Diện tích cho thuê');
        $excel->getActiveSheet()->setCellValue('M1', 'Giá cho thuê tổng thể tham chiếu/tháng');
        $excel->getActiveSheet()->setCellValue('N1', 'Giá cho thuê thực tế tham chiếu/tháng');
        $excel->getActiveSheet()->setCellValue('O1', 'Giá trị thực tế cho thuê/tháng (theo hợp đồng)');
        $numRow = 1;
        $stt = 0;
        $row = Property::whereRaw('property.real_price_contract < property.real_value')->get()->toArray();
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
            $excel->getActiveSheet() ->setCellValue('J'.$numRow, $v['total_area']);
            $excel->getActiveSheet() ->setCellValue('K'.$numRow, $v['rent_floor']);
            $excel->getActiveSheet() ->setCellValue('L'.$numRow, $v['rent_area']);
            $excel->getActiveSheet() ->setCellValue('M'.$numRow, number_format($v['total_value']));
            $excel->getActiveSheet() ->setCellValue('N'.$numRow, number_format($v['real_value']));
            $excel->getActiveSheet() ->setCellValue('O'.$numRow, number_format($v['real_price_contract']));
        }
       // header('Content-type: application/vnd.ms-excel');
        
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('error3.xlsx');
        header('Content-Disposition: attachment; filename="rui-ro-3.xlsx"');
        readfile('error3.xlsx');
    }


    public function error2(){
        $data = Contract::where([['payment_year','>',100000000],['manager','<>',1]])->get();
        return view('ruiro/error2',compact('data'));
    }

     public function export_error2(){
        
        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Rủi ro 2');
       
        $excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true)->setSize(12)
                            ->getColor()->setRGB('6F6F5F');
     
        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('D1', 'Tên chủ nhà');
        $excel->getActiveSheet()->setCellValue('E1', 'Giá Đã Có Thuế (Tháng)');
        $excel->getActiveSheet()->setCellValue('F1', 'Giá Trên Hợp Đồng(Tháng)');
        $excel->getActiveSheet()->setCellValue('G1', 'Giá Trên Hợp Đồng(Năm)');
        $numRow = 1;
        $stt = 0;
        $row = Contract::where([['payment_year','>',100000000],['manager','<>',1]])->get()->toArray();
        foreach ($row as $v) {
            $stt+=1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A'.$numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B'.$numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('C'.$numRow, $v['contract_code']);
            $excel->getActiveSheet()->setCellValue('D'.$numRow, $v['fullname']);
            $excel->getActiveSheet() ->setCellValue('E'.$numRow, number_format($v['tax_cost']));
            $excel->getActiveSheet() ->setCellValue('F'.$numRow, number_format($v['total_cost']));
            $excel->getActiveSheet() ->setCellValue('G'.$numRow, number_format($v['payment_year']));
        }
       // header('Content-type: application/vnd.ms-excel');
        
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('error2.xlsx');
        header('Content-Disposition: attachment; filename="rui-ro-2.xlsx"');
        readfile('error2.xlsx');
    }



    public function error1(){
        $data = Tax::join('contract','contract.contract_code','=','tax.contract_code')->where([['contract.total_cost','<>','tax.price_contract'],['contract.manager',1]])->paginate(20);
        return view('ruiro/error1',compact('data'));
    }
    public function export_error1(){
        
        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Rủi ro 1');
       
        $excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true)->setSize(12)
                            ->getColor()->setRGB('6F6F5F');
     
        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Tên chủ nhà');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('D1', 'Mã tài sản');
        $excel->getActiveSheet()->setCellValue('E1', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('F1', 'Giá Trên Hợp Đồng Gốc Thu Thập');
        $excel->getActiveSheet()->setCellValue('G1', 'Giá Trên Hợp Đồng Kê Khai Thuế');
        $numRow = 1;
        $stt = 0;
        $row = Tax::join('contract','contract.contract_code','=','tax.contract_code')->where([['contract.total_cost','<>','tax.price_contract'],['contract.manager',1]])->get()->toArray();
        
        foreach ($row as $v) {
            $stt+=1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A'.$numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B'.$numRow, $v['fullname']);
            $excel->getActiveSheet()->setCellValue('C'.$numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('D'.$numRow, $v['property_code']);
            $excel->getActiveSheet() ->setCellValue('E'.$numRow, $v['contract_code']);
            $excel->getActiveSheet() ->setCellValue('F'.$numRow, number_format($v['total_cost']));
            $excel->getActiveSheet() ->setCellValue('G'.$numRow, number_format($v['price_contract']));
        }
       // header('Content-type: application/vnd.ms-excel');
        
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('error1.xlsx');
        header('Content-Disposition: attachment; filename="rui-ro-1.xlsx"');
        readfile('error1.xlsx');
    }
}
