<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Cell;
use PHPExcel_Style_Alignment;
use App\Contract;
use App\Signature;
use File;


class ContractController extends Controller
{   
    public function search_contract(Request $req){
        
         $key = $req->keyword;
         $select = $req->select;
         if($key==""){
            return redirect()->back()->with('loi','Hãy nhập từ khóa tìm kiếm');
        }else{
            if($select==1){
              $data = Contract::where('tax_code','like','%'.$key.'%')->paginate(20);
            }elseif($select==2){
              $data = Contract::where('property_code','like','%'.$key.'%')->paginate(20);
            }elseif($select==3){
              $data = Contract::where('contract_code','like','%'.$key.'%')->paginate(20);
            }elseif($select==4){
              $data = Contract::where('fullname','like','%'.$key.'%')->paginate(20);
            }
            return view('hopdong/search',compact('data','key','select'));
        }
         
    }

    public function delete_file(Request $req){
        $filename = $req->filename;
        File::delete('public/contract/'.$filename);
    }


    public function export_contract(){

        $data = Signature::all()->toArray();
        $signal = $data[0]['name'];
    	$excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Danh sách hợp đồng');
       
        $excel->getActiveSheet()->getStyle('A1:W1')->getFont()->setBold(true)->setSize(13)
                            ->getColor()->setRGB('6F6F5F');
        $excel->getActiveSheet()->setCellValue('A1','DANH SÁCH HỢP ĐỒNG');
        $excel->getActiveSheet()->mergeCells('A1:W1');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

        $excel->getActiveSheet()->getStyle("A1:W1")->applyFromArray($style);
       
             
        $excel->getActiveSheet()->setCellValue('A2', 'STT');
        $excel->getActiveSheet()->setCellValue('B2', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('C2', 'Mã tài sản');
        $excel->getActiveSheet()->setCellValue('D2', 'Tên chủ nhà');
        $excel->getActiveSheet()->setCellValue('E2', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('F2', 'Hình thức');
        $excel->getActiveSheet()->setCellValue('G2', 'Tên khách hàng thuê');
        $excel->getActiveSheet()->setCellValue('H2', 'Số điện thoại khách hàng thuê');
        $excel->getActiveSheet()->setCellValue('I2', 'Diện tích nhà thuê');
        $excel->getActiveSheet()->setCellValue('J2', 'Tầng số');
        $excel->getActiveSheet()->setCellValue('K2', 'Phòng số');
        $excel->getActiveSheet()->setCellValue('L2', 'Mục đích thuê');
        $excel->getActiveSheet()->setCellValue('M2', 'Ngày bắt đầu hợp đồng');
        $excel->getActiveSheet()->setCellValue('N2', 'Ngày kết thúc hợp đồng');
        $excel->getActiveSheet()->setCellValue('O2', 'Kỳ thanh toán');
        $excel->getActiveSheet()->setCellValue('P2', 'Giá quy đổi theo tháng');
        $excel->getActiveSheet()->setCellValue('Q2', 'Giá quy đổi theo năm');
        $excel->getActiveSheet()->setCellValue('R2', 'Giá quy đổi theo quý');
        $excel->getActiveSheet()->setCellValue('S2', 'Giá đã có thuế');
        $excel->getActiveSheet()->setCellValue('T2', 'Giá chưa có thuế');
        $excel->getActiveSheet()->setCellValue('U2', 'Giá trên hợp đồng (tháng)');
        $excel->getActiveSheet()->setCellValue('V2', 'Giá quy đổi theo tháng đã có thuế');
        $excel->getActiveSheet()->setCellValue('W2', 'Đơn vị tiền tệ');
        $excel->getActiveSheet()->getStyle("A2:W2")->applyFromArray($style);

        $numRow = 2;
        $stt = 0;
        $row = Contract::all()->toArray();
        foreach ($row as $v) {
            $stt+=1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A'.$numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B'.$numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('C'.$numRow, $v['property_code']);
            $excel->getActiveSheet()->setCellValue('D'.$numRow, $v['fullname']);
            $excel->getActiveSheet() ->setCellValue('E'.$numRow, $v['contract_code']);
            $excel->getActiveSheet() ->setCellValue('F'.$numRow, $v['method']);
            $excel->getActiveSheet() ->setCellValue('G'.$numRow, $v['customer_name']);
            $excel->getActiveSheet() ->setCellValue('H'.$numRow, $v['customer_phone']);
            $excel->getActiveSheet() ->setCellValue('I'.$numRow, $v['area']);
            $excel->getActiveSheet() ->setCellValue('J'.$numRow, $v['floor']);
            $excel->getActiveSheet() ->setCellValue('K'.$numRow, $v['room']);
            $excel->getActiveSheet() ->setCellValue('L'.$numRow, $v['purpose']);
            $excel->getActiveSheet() ->setCellValue('M'.$numRow, date("d/m/Y",strtotime($v['from'])));
            $excel->getActiveSheet() ->setCellValue('N'.$numRow,date("d/m/Y",strtotime($v['to'])));
            if($v['payment']==0){
            $excel->getActiveSheet() ->setCellValue('O'.$numRow, "1 năm/lần");
            }elseif($v['payment']!=0){
             $excel->getActiveSheet() ->setCellValue('O'.$numRow, $v['payment']." tháng/lần");	
            }
            $excel->getActiveSheet() ->setCellValue('P'.$numRow, number_format($v['payment_month']));
            $excel->getActiveSheet() ->setCellValue('Q'.$numRow, number_format($v['payment_year']));
            $excel->getActiveSheet() ->setCellValue('R'.$numRow, number_format($v['payment_precious']));
            $excel->getActiveSheet() ->setCellValue('S'.$numRow, number_format($v['tax_cost']));
            $excel->getActiveSheet() ->setCellValue('T'.$numRow, number_format($v['notax_cost']));
            $excel->getActiveSheet() ->setCellValue('U'.$numRow, number_format($v['total_cost']));
            $excel->getActiveSheet() ->setCellValue('V'.$numRow, number_format($v['cost_month']));
            $excel->getActiveSheet() ->setCellValue('W'.$numRow, $v['currency']);
           
        }

        $row_count = count($row);
        $excel->getActiveSheet()->setCellValue('A'.($row_count+1),'Chữ ký người đại diện');
        $excel->getActiveSheet()->setCellValue('A'.($row_count+2),$signal);
        $excel->getActiveSheet()->mergeCells("A".($row_count+1).":W".($row_count+1)); 
        $excel->getActiveSheet()->mergeCells("A".($row_count+2).":W".($row_count+2)); 
        $style1 = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            )
        );

        $excel->getActiveSheet()->getStyle("A".($row_count+1).":W".($row_count+1))->applyFromArray($style1); 
        $excel->getActiveSheet()->getStyle("A".($row_count+2).":W".($row_count+2))->applyFromArray($style1);
       // header('Content-type: application/vnd.ms-excel');
        
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('listcontract.xlsx');
        header('Content-Disposition: attachment; filename="danh-sach-hop-dong.xlsx"');
        readfile('listcontract.xlsx');
    }

    public function export_search_contract(Request $req){

         $key = $req->keyword;
         $select = $req->select;
        
        if($select==1){
          $row = Contract::where('tax_code','like','%'.$key.'%')->get()->toArray();
        }elseif($select==2){
          $row = Contract::where('property_code','like','%'.$key.'%')->get()->toArray();
        }elseif($select==3){
          $row = Contract::where('contract_code','like','%'.$key.'%')->get()->toArray();
        }elseif($select==4){
          $row = Contract::where('fullname','like','%'.$key.'%')->get()->toArray();
        }

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Danh sách hợp đồng');
       
        $excel->getActiveSheet()->getStyle('A1:W1')->getFont()->setBold(true)->setSize(13)
                            ->getColor()->setRGB('6F6F5F');
     
        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã tài sản');
        $excel->getActiveSheet()->setCellValue('D1', 'Tên chủ nhà');
        $excel->getActiveSheet()->setCellValue('E1', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('F1', 'Hình thức');
        $excel->getActiveSheet()->setCellValue('G1', 'Tên khách hàng thuê');
        $excel->getActiveSheet()->setCellValue('H1', 'Số điện thoại khách hàng thuê');
        $excel->getActiveSheet()->setCellValue('I1', 'Diện tích nhà thuê');
        $excel->getActiveSheet()->setCellValue('J1', 'Tầng số');
        $excel->getActiveSheet()->setCellValue('K1', 'Phòng số');
        $excel->getActiveSheet()->setCellValue('L1', 'Mục đích thuê');
        $excel->getActiveSheet()->setCellValue('M1', 'Ngày bắt đầu hợp đồng');
        $excel->getActiveSheet()->setCellValue('N1', 'Ngày kết thúc hợp đồng');
        $excel->getActiveSheet()->setCellValue('O1', 'Kỳ thanh toán');
        $excel->getActiveSheet()->setCellValue('P1', 'Giá quy đổi theo tháng');
        $excel->getActiveSheet()->setCellValue('Q1', 'Giá quy đổi theo năm');
        $excel->getActiveSheet()->setCellValue('R1', 'Giá quy đổi theo quý');
        $excel->getActiveSheet()->setCellValue('S1', 'Giá đã có thuế');
        $excel->getActiveSheet()->setCellValue('T1', 'Giá chưa có thuế');
        $excel->getActiveSheet()->setCellValue('U1', 'Giá trên hợp đồng (tháng)');
        $excel->getActiveSheet()->setCellValue('V1', 'Giá quy đổi theo tháng đã có thuế');
        $excel->getActiveSheet()->setCellValue('W1', 'Đơn vị tiền tệ');
        $numRow = 1;
        $stt = 0;
        foreach ($row as $v) {
            $stt+=1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A'.$numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B'.$numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('C'.$numRow, $v['property_code']);
            $excel->getActiveSheet()->setCellValue('D'.$numRow, $v['fullname']);
            $excel->getActiveSheet() ->setCellValue('E'.$numRow, $v['contract_code']);
            $excel->getActiveSheet() ->setCellValue('F'.$numRow, $v['method']);
            $excel->getActiveSheet() ->setCellValue('G'.$numRow, $v['customer_name']);
            $excel->getActiveSheet() ->setCellValue('H'.$numRow, $v['customer_phone']);
            $excel->getActiveSheet() ->setCellValue('I'.$numRow, $v['area']);
            $excel->getActiveSheet() ->setCellValue('J'.$numRow, $v['floor']);
            $excel->getActiveSheet() ->setCellValue('K'.$numRow, $v['room']);
            $excel->getActiveSheet() ->setCellValue('L'.$numRow, $v['purpose']);
            $excel->getActiveSheet() ->setCellValue('M'.$numRow, date("d/m/Y",strtotime($v['from'])));
            $excel->getActiveSheet() ->setCellValue('N'.$numRow,date("d/m/Y",strtotime($v['to'])));
            if($v['payment']==0){
            $excel->getActiveSheet() ->setCellValue('O'.$numRow, "1 năm/lần");
            }elseif($v['payment']!=0){
             $excel->getActiveSheet() ->setCellValue('O'.$numRow, $v['payment']." tháng/lần");  
            }
            $excel->getActiveSheet() ->setCellValue('P'.$numRow, number_format($v['payment_month']));
            $excel->getActiveSheet() ->setCellValue('Q'.$numRow, number_format($v['payment_year']));
            $excel->getActiveSheet() ->setCellValue('R'.$numRow, number_format($v['payment_precious']));
            $excel->getActiveSheet() ->setCellValue('S'.$numRow, number_format($v['tax_cost']));
            $excel->getActiveSheet() ->setCellValue('T'.$numRow, number_format($v['notax_cost']));
            $excel->getActiveSheet() ->setCellValue('U'.$numRow, number_format($v['total_cost']));
            $excel->getActiveSheet() ->setCellValue('V'.$numRow, number_format($v['cost_month']));
            $excel->getActiveSheet() ->setCellValue('W'.$numRow, $v['currency']);
           
        }
       // header('Content-type: application/vnd.ms-excel');
        
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('listcontractsearch.xlsx');
        header('Content-Disposition: attachment; filename="Kết quả tìm kiếm hợp đồng.xlsx"');
        readfile('listcontractsearch.xlsx');
    }



}
