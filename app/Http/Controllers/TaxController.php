<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Cell;
use PHPExcel_Writer_Excel2007;
use App\Tax;
use App\TaxDeclaration;
use App\Contract;
use App\Phonebook;

class TaxController extends Controller
{
    public function create_tax(){
    	$data = Tax::paginate(25);
    	return view('thue/create',compact('data'));
    }


    public function update_tax(Request $req){
        $id = $req->id;
       $data =  Tax::where('id',$id)->get();
        return view('thue/update',compact('data'));
    }

    public function search_tax(Request $req){

        $key = $req->keyword;
        $select = $req->select;
        if($key==""){
            return redirect()->back()->with('loi','Hãy nhập từ khóa tìm kiếm');
        }else{
            if($select==1){
              $data =  Tax::join('tax_declaration','tax.contract_code','=','tax_declaration.id_contractcode')->where([['tax_declaration.declare',1],['tax.tax_code','like','%'.$key.'%']])->orderBy('tax_declaration.updated_at','asc')->paginate(20);
            }elseif($select==2){
              $data =  Tax::join('tax_declaration','tax.contract_code','=','tax_declaration.id_contractcode')->where([['tax_declaration.declare',1],['tax.property_code','like','%'.$key.'%']])->orderBy('tax_declaration.updated_at','asc')->paginate(20);
            }elseif($select==3){
              $data =  Tax::join('tax_declaration','tax.contract_code','=','tax_declaration.id_contractcode')->where([['tax_declaration.declare',1],['tax_declaration.id_contractcode','like','%'.$key.'%']])->orderBy('tax_declaration.updated_at','asc')->paginate(20);
            }elseif($select==4){
              $data =  Tax::join('tax_declaration','tax.contract_code','=','tax_declaration.id_contractcode')->where([['tax_declaration.declare',1],['tax.fullname','like','%'.$key.'%']])->orderBy('tax_declaration.updated_at','asc')->paginate(20);
            }
            return view('thue/search',compact('data','key','select'));
        }
     
    } 

    public function delete_tax_declare(Request $req){
        $contract_code = $req->contract_code;
        $data = TaxDeclaration::where([['id_contractcode',$contract_code],['declare',1]])->get();
        $count = count($data);
        if($count>0){
            return redirect()->back()->with('loi','Tờ khai này đã được kê khai thuế. Bạn không thể xóa tờ khai này !');
        }else{
            
            TaxDeclaration::where('id_contractcode',$contract_code)->delete();
            Tax::where('contract_code',$contract_code)->delete();
            return redirect()->back();

        }
    } 


    public function get_money(){
    	return view('thue/money');
    } 

    public function check_contractcode(Request $req){
    	$code = $req->val;
    	$data = Contract::where('contract_code',$code)->get();
    
    	//echo json_encode($data);
    	if(count($data)>0){
    		echo '<span style="color: green;text-align: center;"><i class="fas fa-check"></i> Mã hợp đồng hợp hợp lệ</span>';
    	}else{
    		echo '<span style="color: red;text-align: center;"> Mã hợp đồng hợp không tồn tại</span>';
    	}
    	
    }   

    public function get_declare(Request $req){
    	$code = $req->val;
    	$data = TaxDeclaration::where('id_contractcode',$code)->get()->toArray();
    	$register = $data[0]['register'];
    	if($register==1){
    		echo '<option value="">Chọn kỳ kê khai</option>';
    		foreach ($data as $v) {
    			echo '<option value="'.$v['id'].'">'.$v['precious'].'</option>';
    		}
    	
    	}elseif($register==2){
    		echo '<option value="">Chọn kỳ kê khai</option>';
    		foreach ($data as $v) {
				echo '<option value="'.$v['id'].'">'.$v['year'].'</option>';
    		}
    	
    	}
    
    }  

    public function get_contractcode(Request $req){
    	$code = $req->term;
    	$data = Contract::where('contract_code','like','%'.$code.'%')->get()->toArray();
    	$data2 = array();
    	foreach ($data as $v) {
    		$data3 = $v['contract_code'];
            array_push($data2, $data3);

    	}
    	echo json_encode($data2);
    	
    	
    } 

     public function getTaxcode(Request $req){
          $code = $req->term;
          $data = Phonebook::where('tax_code','like','%'.$code.'%')->get()->toArray();
          $data2 = array();
          foreach ($data as $v) {
            $data3 = $v['tax_code'];
            array_push($data2, $data3);
        }
        echo json_encode($data2);

    } 

    public function get_fullname_contract(Request $req){
    	$code = $req->val;
    	$data = Contract::where('contract_code',$code)->get();

    	if(count($data)>0){
    		echo $data[0]['fullname'];
    	}
    	
    }  

    public function get_taxcode_contract(Request $req){
    	$code = $req->val;
    	$data = Contract::where('contract_code',$code)->get();

    	if(count($data)>0){
    		echo $data[0]['tax_code'];
    	}
    }

    public function get_propertycode_contract(Request $req){
    	$code = $req->val;
    	$data = Contract::where('contract_code',$code)->get();

    	if(count($data)>0){
    		echo $data[0]['property_code'];
    	}
    }

    public function export_tax(){
        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Danh sách hợp đồng kê khai thuế');
       
        $excel->getActiveSheet()->getStyle('A1:V1')->getFont()->setBold(true)->setSize(13)
                            ->getColor()->setRGB('6F6F5F');
     
        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã tài sản');
        $excel->getActiveSheet()->setCellValue('D1', 'Tên chủ nhà');
        $excel->getActiveSheet()->setCellValue('E1', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('F1', 'Kỳ kê khai (Quý)');
        $excel->getActiveSheet()->setCellValue('G1', 'Kỳ kê khai (Năm)');
        $excel->getActiveSheet()->setCellValue('H1', 'Kỳ kê khai (Từ ngày đến ngày)');
        $excel->getActiveSheet()->setCellValue('I1', 'Ngày nộp tờ khai');
        $excel->getActiveSheet()->setCellValue('J1', 'Hạn nộp tờ khai');
        $excel->getActiveSheet()->setCellValue('K1', 'Đăng ký');
        $excel->getActiveSheet()->setCellValue('L1', 'Kỳ chưa kê khai (Quý)');
        $excel->getActiveSheet()->setCellValue('M1', 'Kỳ chưa kê khai (Năm)');
        $excel->getActiveSheet()->setCellValue('N1', 'Tổng doanh thu hợp đồng chưa thuế (theo tháng)');
        $excel->getActiveSheet()->setCellValue('O1', 'Tổng thuế');
        $excel->getActiveSheet()->setCellValue('P1', 'Thuế giá trị gia tăng');
        $excel->getActiveSheet()->setCellValue('Q1', 'Thuế thu nhập cá nhân');
        $excel->getActiveSheet()->setCellValue('R1', 'Số tiền đã nộp');
        $excel->getActiveSheet()->setCellValue('S1', 'Số tiền đã nộp (VAT)');
        $excel->getActiveSheet()->setCellValue('T1', 'Số tiền đã nộp (TNCN)');
        $excel->getActiveSheet()->setCellValue('U1', 'Ngày nộp tiền');
        $excel->getActiveSheet()->setCellValue('V1', 'Nợ thuế');
        $numRow = 1;
        $stt = 0;
        $row = Tax::join('tax_declaration','tax.contract_code','=','tax_declaration.id_contractcode')->where('tax_declaration.declare',1)->orderBy('tax_declaration.updated_at','asc')->get()->toArray();
        foreach ($row as $v) {
            $stt+=1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A'.$numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B'.$numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('C'.$numRow, $v['property_code']);
            $excel->getActiveSheet()->setCellValue('D'.$numRow, $v['fullname']);
            $excel->getActiveSheet() ->setCellValue('E'.$numRow, $v['contract_code']);
            $excel->getActiveSheet() ->setCellValue('F'.$numRow, $v['precious']);
            $excel->getActiveSheet() ->setCellValue('G'.$numRow, $v['year']);
            $excel->getActiveSheet() ->setCellValue('H'.$numRow, $v['from_to']);
            $excel->getActiveSheet() ->setCellValue('I'.$numRow, date("d/m/Y",strtotime($v['submit_date'])));
            $excel->getActiveSheet() ->setCellValue('J'.$numRow, date("d/m/Y",strtotime($v['deadline'])));
            if($v['register']==1){
            $excel->getActiveSheet() ->setCellValue('K'.$numRow, 'Quý');
            }elseif($v['register']==2){
            $excel->getActiveSheet() ->setCellValue('K'.$numRow, 'Năm');
            }
            $excel->getActiveSheet() ->setCellValue('L'.$numRow, $v['precious_undeclare']);
            $excel->getActiveSheet() ->setCellValue('M'.$numRow, $v['year_undeclare']);
            $excel->getActiveSheet() ->setCellValue('N'.$numRow,number_format($v['price_contract']));
            $excel->getActiveSheet() ->setCellValue('O'.$numRow, number_format($v['total_tax']));
            $excel->getActiveSheet() ->setCellValue('P'.$numRow, number_format($v['total_tax']/2));
            $excel->getActiveSheet() ->setCellValue('Q'.$numRow, number_format($v['total_tax']/2));
            $excel->getActiveSheet() ->setCellValue('R'.$numRow, number_format($v['payed']));
            $excel->getActiveSheet() ->setCellValue('S'.$numRow, number_format($v['payed']/2));
            $excel->getActiveSheet() ->setCellValue('T'.$numRow, number_format($v['payed']/2));
            $excel->getActiveSheet() ->setCellValue('U'.$numRow, date("d/m/Y",strtotime($v['payed_date'])));
            $excel->getActiveSheet() ->setCellValue('V'.$numRow, number_format($v['difference']));
           
        }
        
       // PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('list');
        $objWriter = new PHPExcel_Writer_Excel2007($excel); 
        $objWriter->save('listtax.xlsx'); 
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="danh-sach-ke-khai-thue.xlsx"');
        readfile('listtax.xlsx');
    }


    public function export_search_tax(Request $req){


        $key = $req->keyword;
        $select = $req->select;
       
        if($select==1){
          $row =  Tax::join('tax_declaration','tax.contract_code','=','tax_declaration.id_contractcode')->where([['tax_declaration.declare',1],['tax.tax_code','like','%'.$key.'%']])->orderBy('tax_declaration.updated_at','asc')->get()->toArray();
        }elseif($select==2){
          $row =  Tax::join('tax_declaration','tax.contract_code','=','tax_declaration.id_contractcode')->where([['tax_declaration.declare',1],['tax.property_code','like','%'.$key.'%']])->orderBy('tax_declaration.updated_at','asc')->get()->toArray();
        }elseif($select==3){
          $row =  Tax::join('tax_declaration','tax.contract_code','=','tax_declaration.id_contractcode')->where([['tax_declaration.declare',1],['tax_declaration.id_contractcode','like','%'.$key.'%']])->orderBy('tax_declaration.updated_at','asc')->get()->toArray();
        }elseif($select==4){
          $row =  Tax::join('tax_declaration','tax.contract_code','=','tax_declaration.id_contractcode')->where([['tax_declaration.declare',1],['tax.fullname','like','%'.$key.'%']])->orderBy('tax_declaration.updated_at','asc')->get()->toArray();
        }
          
        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Danh sách hợp đồng kê khai thuế');
       
        $excel->getActiveSheet()->getStyle('A1:V1')->getFont()->setBold(true)->setSize(13)
                            ->getColor()->setRGB('6F6F5F');
     
        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã tài sản');
        $excel->getActiveSheet()->setCellValue('D1', 'Tên chủ nhà');
        $excel->getActiveSheet()->setCellValue('E1', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('F1', 'Kỳ kê khai (Quý)');
        $excel->getActiveSheet()->setCellValue('G1', 'Kỳ kê khai (Năm)');
        $excel->getActiveSheet()->setCellValue('H1', 'Kỳ kê khai (Từ ngày đến ngày)');
        $excel->getActiveSheet()->setCellValue('I1', 'Ngày nộp tờ khai');
        $excel->getActiveSheet()->setCellValue('J1', 'Hạn nộp tờ khai');
        $excel->getActiveSheet()->setCellValue('K1', 'Đăng ký');
        $excel->getActiveSheet()->setCellValue('L1', 'Kỳ chưa kê khai (Quý)');
        $excel->getActiveSheet()->setCellValue('M1', 'Kỳ chưa kê khai (Năm)');
        $excel->getActiveSheet()->setCellValue('N1', 'Tổng doanh thu hợp đồng chưa thuế (theo tháng)');
        $excel->getActiveSheet()->setCellValue('O1', 'Tổng thuế');
        $excel->getActiveSheet()->setCellValue('P1', 'Thuế giá trị gia tăng');
        $excel->getActiveSheet()->setCellValue('Q1', 'Thuế thu nhập cá nhân');
        $excel->getActiveSheet()->setCellValue('R1', 'Số tiền đã nộp');
        $excel->getActiveSheet()->setCellValue('S1', 'Số tiền đã nộp (VAT)');
        $excel->getActiveSheet()->setCellValue('T1', 'Số tiền đã nộp (TNCN)');
        $excel->getActiveSheet()->setCellValue('U1', 'Ngày nộp tiền');
        $excel->getActiveSheet()->setCellValue('V1', 'Nợ thuế');
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
            $excel->getActiveSheet() ->setCellValue('F'.$numRow, $v['precious']);
            $excel->getActiveSheet() ->setCellValue('G'.$numRow, $v['year']);
            $excel->getActiveSheet() ->setCellValue('H'.$numRow, $v['from_to']);
            $excel->getActiveSheet() ->setCellValue('I'.$numRow, date("d/m/Y",strtotime($v['submit_date'])));
            $excel->getActiveSheet() ->setCellValue('J'.$numRow, date("d/m/Y",strtotime($v['deadline'])));
            if($v['register']==1){
            $excel->getActiveSheet() ->setCellValue('K'.$numRow, 'Quý');
            }elseif($v['register']==2){
            $excel->getActiveSheet() ->setCellValue('K'.$numRow, 'Năm');
            }
            $excel->getActiveSheet() ->setCellValue('L'.$numRow, $v['precious_undeclare']);
            $excel->getActiveSheet() ->setCellValue('M'.$numRow, $v['year_undeclare']);
            $excel->getActiveSheet() ->setCellValue('N'.$numRow,number_format($v['price_contract']));
            $excel->getActiveSheet() ->setCellValue('O'.$numRow, number_format($v['total_tax']));
            $excel->getActiveSheet() ->setCellValue('P'.$numRow, number_format($v['total_tax']/2));
            $excel->getActiveSheet() ->setCellValue('Q'.$numRow, number_format($v['total_tax']/2));
            $excel->getActiveSheet() ->setCellValue('R'.$numRow, number_format($v['payed']));
            $excel->getActiveSheet() ->setCellValue('S'.$numRow, number_format($v['payed']/2));
            $excel->getActiveSheet() ->setCellValue('T'.$numRow, number_format($v['payed']/2));
            $excel->getActiveSheet() ->setCellValue('U'.$numRow, date("d/m/Y",strtotime($v['payed_date'])));
            $excel->getActiveSheet() ->setCellValue('V'.$numRow, number_format($v['difference']));
           
        }
        
        $objWriter = new PHPExcel_Writer_Excel2007($excel); 
        $objWriter->save('listtaxsearch.xlsx'); 
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Danh sách kết quả tìm kiếm.xlsx"');
        readfile('listtaxsearch.xlsx');
    }

    public function save_tax_declare(Request $req){
    	$mahopdong = $req->contractcode;
    	$kykekhai = $req->declare;
    	$sotiennop = $req->payed;
    	$ngaynop = $req->payeddate;
    	$data = TaxDeclaration::where('id',$kykekhai)->get();
    	$deadline =  date("d-m-Y", strtotime($data[0]['deadline']));
    	$register =  $data[0]['register'];
    	$tongthue =  $data[0]['total_tax'];
    	$d1=strtotime($deadline);
    	$d2=strtotime($ngaynop);
    	$ontime=ceil(($d1-$d2)/60/60/24);//tính xem quá hạn nộp tiền bn ngày
    	$data2 = TaxDeclaration::where([['declare',0],['id_contractcode',$mahopdong],['id','<>',$kykekhai]])->get()->toArray();
    	if($register==1){
	        $array = [];
	        for ($i=0; $i < count($data2) ; $i++) { 
	        	$precious = $data2[$i]['precious'];
	        	array_push($array,strval($precious));
	        }
	        $kykekhaiquy= implode(";",$array);
	        $kykekhainam= "";
	       
	    }elseif($register==2){
	  		$array = [];
	        for ($i=0; $i < count($data2) ; $i++) { 
	        	$year = $data2[$i]['year'];
	        	array_push($array,strval($year));
	        }
	        $kykekhainam= implode(";",$array);
	        $kykekhaiquy= "";
	        
	    }

	    TaxDeclaration::where('id',$kykekhai)->update([
	    	'precious_undeclare'=>$kykekhaiquy,'year_undeclare'=>$kykekhainam,'payed'=>$sotiennop,'payed_date'=> date("Y-m-d", strtotime($ngaynop)),
	    	'ontime'=>$ontime,'difference'=>$tongthue-$sotiennop,'declare'=>1
	    ]);
	    		return redirect()->back()->with('thanhcong','Đã Lưu');	 
    	
    }

    public function change_tax(Request $req){

        $mahopdong = $req->contractcode;
        $masothue = $req->taxcode;
        $tenchunha = $req->fullname;
        $mataisan = $req->propertycode;
        $dangky = $req->register;
        $ngaynop = $req->submit_date;
        $giahopdong = $req->price_contract;
        $check = TaxDeclaration::where([['id_contractcode',$mahopdong],['declare',1]])->get();
        if(count($check)>0){
            return redirect()->back()->with('loi','Hợp đồng cho tờ khai này đang được kê khai thuế. Bạn không thể cập nhật lại tờ khai này.');
        }else{
           
             TaxDeclaration::where('id_contractcode',$mahopdong)->delete();
             Tax::where('contract_code',$mahopdong)->delete();
            Contract::where('contract_code',$mahopdong)->update(['manager'=>1]);
            $data = Contract::where('contract_code',$mahopdong)->get();
            $start_time = $data[0]['from'];  
            $finish_time = $data[0]['to'];
            $payment = $data[0]['payment'];
            $price= $data[0]['total_cost'];
            if($payment==0){
                $tongthue = ($price/0.9)*12*0.05*2;
            }elseif($payment!=0){
                $tongthue = ($price/0.9)*$payment*0.05*2;
            }

            if($dangky==1){ //Nếu là  đăng ký kê khai theo quý
                $array = array();
                $array1 = array();
                $n = $payment;

                while (strtotime($start_time) < strtotime($finish_time)){
                    $quarter = ceil(date('m', strtotime($start_time))/3); // biến này cho biết start_time thuộc quý nào của năm nào
                    $quarter_str = " Q". $quarter . "/". date("Y", strtotime($start_time)); // biến này chỉ để in ra trong hàm echo
                    $deadline = date("d-m-Y", strtotime("01-" . $quarter*3 . "-". date("Y", strtotime($start_time)) . " + 2 months -1 days"));
                    $array2 = [strval($quarter_str),$deadline, $start_time . " -> " .date('d-m-Y', strtotime($start_time  . "+" . $n . " months" . " -1 days"))];

                    array_push($array, $array2);
                    array_push($array1, strval($quarter_str));
                    $start_time =  date('d-m-Y', strtotime($start_time  . "+" . $n . " months"));
                }
                $deadline = $array[0][1];
                $kykekhai = implode(";",$array1);
                //Tính xem ngày nộp tờ khai có đúng hạn không ?
                $d1=strtotime($deadline);
                $d2=strtotime($ngaynop);
                $d3=ceil(($d1-$d2)/60/60/24);
                //Lưu vào bảng tờ khai
                $tax = new Tax();
                $tax->tax_code = $masothue;
                $tax->fullname = $tenchunha;
                $tax->property_code = $mataisan;
                $tax->contract_code = $mahopdong;
                $tax->price_contract = $giahopdong;
                $tax->register = $dangky;
                $tax->precious_declare = $kykekhai;
                $tax->year_declare = "";
                $tax->submit_date = date("Y/m/d", strtotime($ngaynop));
                $tax->deadline = date("Y/m/d", strtotime($deadline));
                $tax->ontime = $d3;
                $tax->save();

                $count = count($array);
                for ($i=0; $i < $count; $i++) { 
                    $tax = new TaxDeclaration();
                    $tax->id_contractcode = $mahopdong;
                    $tax->deadline =  date("Y/m/d", strtotime($array[$i][1]));
                    $tax->from_to = $array[$i][2];
                    $tax->register = $dangky;
                    $tax->precious = $array[$i][0];
                    $tax->total_tax = $tongthue;
                    $tax->year = "";
                    $tax->payed = 0;
                    //$tax->payed_date = null;
                    //$tax->ontime = null;
                    //$tax->difference = 0;
                    $tax->declare = 0;
                    $tax->save();
                }
            }elseif($dangky==2){ //Nếu là  đăng ký kê khai theo năm
                $arre = array();
                $arr = array();
                $diff = abs(strtotime($finish_time) - strtotime($start_time));
                $years = floor($diff / (365*60*60*24));
                $arr = [];
                $arr2 = [];
                for ($i=1; $i <= $years ; $i++) { 
                    $date = "30-03-".date("Y", strtotime($start_time."+".$i."year"));
                    $arre = [$date];
                    array_push($arr, $arre);
                    array_push($arr2, strval($date));
                }
                $deadline = $arr[0][0];
                $kykekhai = implode(";",$arr2);
                $d1=strtotime($deadline);
                $d2=strtotime($ngaynop);
                $d3=ceil(($d1-$d2)/60/60/24);
                $tax = new Tax();
                $tax->tax_code = $masothue;
                $tax->fullname = $tenchunha;
                $tax->property_code = $mataisan;
                $tax->contract_code = $mahopdong;
                $tax->price_contract = $giahopdong;
                $tax->register = $dangky;
                $tax->precious_declare = "";
                $tax->year_declare = $kykekhai;
                $tax->submit_date = date("Y/m/d", strtotime($ngaynop));
                $tax->deadline = date("Y/m/d", strtotime($deadline));
                $tax->ontime = $d3;
                $tax->save();

                $count = count($arr);
                for ($i=0; $i < $count; $i++) { 
                    $tax = new TaxDeclaration();
                    $tax->id_contractcode = $mahopdong;
                    $tax->deadline =  date("Y/m/d", strtotime($arr[$i][0]));
                    $tax->total_tax = $tongthue;
                    $tax->register = $dangky;
                    $tax->from_to = $arr[$i][0];
                    $tax->precious ="";
                    $tax->year = $arr[$i][0];
                    $tax->payed = 0;
                    //$tax->payed_date = null;
                    //$tax->ontime = null;
                    //$tax->difference = 0;
                    $tax->declare = 0;
                    $tax->save();
                }

            }
            
            
            return redirect()->route('admin.create_tax');  
        }
    }    

    public function save_tax(Request $req){
    		$this->validate($req,[
            'contractcode'=>'unique:tax,contract_code'
        ],
        [
            'contractcode.unique'=>'Mã hợp đồng này đã được kê khai'
            
        ]);

    	$mahopdong = $req->contractcode;
    	$masothue = $req->taxcode;
    	$tenchunha = $req->fullname;
    	$mataisan = $req->propertycode;
    	$dangky = $req->register;
    	$ngaynop = $req->submit_date;
    	$giahopdong = $req->price_contract;
      
    	Contract::where('contract_code',$mahopdong)->update(['manager'=>1]);
    	$data = Contract::where('contract_code',$mahopdong)->get();
    	$start_time = $data[0]['from'];  
    	$finish_time = $data[0]['to'];
    	$payment = $data[0]['payment'];
    	$price= $data[0]['total_cost'];
    	if($payment==0){
    		$tongthue = ($price/0.9)*12*0.05*2;
    	}elseif($payment!=0){
    		$tongthue = ($price/0.9)*$payment*0.05*2;
    	}

    	if($dangky==1){ //Nếu là  đăng ký kê khai theo quý
    		$array = array();
    		$array1 = array();
    		$n = $payment;

    		while (strtotime($start_time) < strtotime($finish_time)){
				$quarter = ceil(date('m', strtotime($start_time))/3); // biến này cho biết start_time thuộc quý nào của năm nào
				$quarter_str = " Q". $quarter . "/". date("Y", strtotime($start_time)); // biến này chỉ để in ra trong hàm echo
				$deadline = date("d-m-Y", strtotime("01-" . $quarter*3 . "-". date("Y", strtotime($start_time)) . " + 2 months -1 days"));
				$array2 = [strval($quarter_str),$deadline, $start_time . " -> " .date('d-m-Y', strtotime($start_time  . "+" . $n . " months" . " -1 days"))];

				array_push($array, $array2);
				array_push($array1, strval($quarter_str));
				$start_time =  date('d-m-Y', strtotime($start_time  . "+" . $n . " months"));
			}
			$deadline = $array[0][1];
			$kykekhai = implode(";",$array1);
			//Tính xem ngày nộp tờ khai có đúng hạn không ?
			$d1=strtotime($deadline);
			$d2=strtotime($ngaynop);
			$d3=ceil(($d1-$d2)/60/60/24);
			//Lưu vào bảng tờ khai
			$tax = new Tax();
			$tax->tax_code = $masothue;
			$tax->fullname = $tenchunha;
			$tax->property_code = $mataisan;
			$tax->contract_code = $mahopdong;
			$tax->price_contract = $giahopdong;
			$tax->register = $dangky;
			$tax->precious_declare = $kykekhai;
			$tax->year_declare = "";
			$tax->submit_date = date("Y/m/d", strtotime($ngaynop));
			$tax->deadline = date("Y/m/d", strtotime($deadline));
			$tax->ontime = $d3;
			$tax->save();

			$count = count($array);
			for ($i=0; $i < $count; $i++) { 
				$tax = new TaxDeclaration();
				$tax->id_contractcode = $mahopdong;
				$tax->deadline =  date("Y/m/d", strtotime($array[$i][1]));
				$tax->from_to = $array[$i][2];
				$tax->register = $dangky;
				$tax->precious = $array[$i][0];
				$tax->total_tax = $tongthue;
				$tax->year = "";
				$tax->payed = 0;
				//$tax->payed_date = null;
				//$tax->ontime = null;
				//$tax->difference = 0;
				$tax->declare = 0;
				$tax->save();
			}
        }elseif($dangky==2){ //Nếu là  đăng ký kê khai theo năm
        	$arre = array();
    		$arr = array();
    		$diff = abs(strtotime($finish_time) - strtotime($start_time));
    		$years = floor($diff / (365*60*60*24));
    		$arr = [];
			$arr2 = [];
    		for ($i=1; $i <= $years ; $i++) { 
    			$date = "30-03-".date("Y", strtotime($start_time."+".$i."year"));
    			$arre = [$date];
    			array_push($arr, $arre);
    			array_push($arr2, strval($date));
    		}
    		$deadline = $arr[0][0];
    		$kykekhai = implode(";",$arr2);
    		$d1=strtotime($deadline);
			$d2=strtotime($ngaynop);
			$d3=ceil(($d1-$d2)/60/60/24);
			$tax = new Tax();
			$tax->tax_code = $masothue;
			$tax->fullname = $tenchunha;
			$tax->property_code = $mataisan;
			$tax->contract_code = $mahopdong;
			$tax->price_contract = $giahopdong;
			$tax->register = $dangky;
			$tax->precious_declare = "";
			$tax->year_declare = $kykekhai;
			$tax->submit_date = date("Y/m/d", strtotime($ngaynop));
			$tax->deadline = date("Y/m/d", strtotime($deadline));
			$tax->ontime = $d3;
			$tax->save();

			$count = count($arr);
			for ($i=0; $i < $count; $i++) { 
				$tax = new TaxDeclaration();
				$tax->id_contractcode = $mahopdong;
				$tax->deadline =  date("Y/m/d", strtotime($arr[$i][0]));
				$tax->total_tax = $tongthue;
				$tax->register = $dangky;
				$tax->from_to = $arr[$i][0];
				$tax->precious ="";
				$tax->year = $arr[$i][0];
				$tax->payed = 0;
				//$tax->payed_date = null;
				//$tax->ontime = null;
				//$tax->difference = 0;
				$tax->declare = 0;
				$tax->save();
			}

    	}
        
    	
		return redirect()->back()->with('thanhcong','Đã lưu tờ khai');	

    } 

    public function detail_tax(){
    	$data = Tax::join('tax_declaration','tax.contract_code','=','tax_declaration.id_contractcode')->where('tax_declaration.declare',1)->orderBy('tax_declaration.updated_at','asc')->paginate(30);
    	$dem = count($data);
    	return view('thue/detail',compact('data','dem'));
    }
}
