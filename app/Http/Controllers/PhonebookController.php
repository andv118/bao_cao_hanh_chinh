<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Cell;
use App\Phonebook;
use App\Property;
use App\User;
use App\Streets;
use App\Diary;
use Hash;
use Session;
use Auth;



class PhonebookController extends Controller
{   
   public function import_phonebook(Request $req){
      $this->validate($req,[
            'select_file'=>'required|mimes:xls,xlsx'
        ],
        [
           
            
            'select_file.required'=>'Hãy nhập 1 file Excel',
            'select_file.mimes'=>'Hãy chọn đúng file đuôi xls hoặc xlsx'

        ]);
      $filename = $req->file('select_file')->getRealPath();

      $inputFileType = PHPExcel_IOFactory::identify($filename);
      $objReader = PHPExcel_IOFactory::createReader($inputFileType);

      $objReader->setReadDataOnly(true);

      $objPHPExcel = $objReader->load("$filename");

      $total_sheets=$objPHPExcel->getSheetCount();

      $allSheetName=$objPHPExcel->getSheetNames();
      $objWorksheet  = $objPHPExcel->setActiveSheetIndex(0);
      $highestRow    = $objWorksheet->getHighestRow();
      $highestColumn = $objWorksheet->getHighestColumn();
      $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
      $arraydata = array();
      for ($row = 2; $row <= $highestRow;++$row)
      {
        for ($col = 0; $col <$highestColumnIndex;++$col)
        {
          $value=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
          $arraydata[$row-2][$col]=$value;
        }
      }


      $count = count($arraydata);
      $macanbo = Session::get('usercode');
      $tencanbo = Session::get('username');
      for ($i=0; $i < $count; $i++) { 
         $phonebook = new Phonebook();
         $phonebook->tax_code = $arraydata[$i][0];
         $phonebook->id_number = $arraydata[$i][1];
         $phonebook->fullname = $arraydata[$i][2];
         $phonebook->email = $arraydata[$i][4];
         $phonebook->id_street = $arraydata[$i][6];
         $phonebook->phone = $arraydata[$i][3];
         $phonebook->address = $arraydata[$i][5];
         $phonebook->isok = $arraydata[$i][7];
         $phonebook->collect_channel = $arraydata[$i][8];
         $phonebook->manager_name = $tencanbo;
         $phonebook->manager_code = $macanbo;
         $phonebook->save();

          $macanbo = Session::get('usercode');
          $tencanbo = Session::get('username');
          $hanhdong = 'Đã lưu danh bạ chủ hộ '.$arraydata[$i][2].' mã số thuế '.$arraydata[$i][0];
          $diary = new Diary();
          $diary->code = $macanbo;
          $diary->name = $tencanbo;
          $diary->action = $hanhdong;
          $diary->save();
      }

      return redirect()->back()->with('thanhcong','Import danh bạ thành công');
    
     
   }

   public function export_users(){
        $excel = new PHPExcel();
        //Chọn trang cần ghi (là số từ 0->n)
        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Danh sách cán bộ');
       
        $excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true)->setSize(12)
                            ->getColor()->setRGB('6F6F5F');
     
        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Tên');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã cán bộ');
        $excel->getActiveSheet()->setCellValue('D1', 'Email');
        $excel->getActiveSheet()->setCellValue('E1', 'SĐT');
        $excel->getActiveSheet()->setCellValue('F1', 'Phường quản lý');
        $numRow = 1;
        $stt = 0;
        $row = User::join('streets','users.id_street','=','streets.id')->get()->toArray();
        foreach ($row as $v) {
            $stt+=1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A'.$numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B'.$numRow, $v['name']);
            $excel->getActiveSheet()->setCellValue('C'.$numRow, $v['code']);
            $excel->getActiveSheet()->setCellValue('D'.$numRow, $v['email']);
            $excel->getActiveSheet() ->setCellValue('E'.$numRow, $v['phone']);
            $excel->getActiveSheet() ->setCellValue('F'.$numRow, $v['street_name']);

        }
      
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('listusers.xlsx');

        header('Content-Disposition: attachment; filename="danh-sach-can-bo.xlsx"');
        readfile('listusers.xlsx');

          
         //return Excel::download(new UsersExport, 'danhsachcanbo.xlsx');
  }

   public function export_search_users(Request $req){
        if($req->type==1){
          if($req->select==1){
              $row = User::where('code','like','%'.$req->keyword.'%')->join('streets','users.id_street','=','streets.id')->get()->toArray();
             
            }elseif($req->select==2){
              $row = User::where('name','like','%'.$req->keyword.'%')->join('streets','users.id_street','=','streets.id')->get()->toArray();
              
            }elseif($req->select==3){
              $row = User::where('email','like','%'.$req->keyword.'%')->join('streets','users.id_street','=','streets.id')->get()->toArray();
              
            }elseif($req->select==4){
              $row = User::where('phone','like','%'.$req->keyword.'%')->join('streets','users.id_street','=','streets.id')->get()->toArray();
              
            }
        }elseif($req->type==2){
            $row = User::where('id_street',$req->select)->join('streets','users.id_street','=','streets.id')->get()->toArray();
        }

        $excel = new PHPExcel();
        //Chọn trang cần ghi (là số từ 0->n)
        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Danh sách cán bộ');
       
        $excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true)->setSize(12)
                            ->getColor()->setRGB('6F6F5F');
     
        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Tên');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã cán bộ');
        $excel->getActiveSheet()->setCellValue('D1', 'Email');
        $excel->getActiveSheet()->setCellValue('E1', 'SĐT');
        $excel->getActiveSheet()->setCellValue('F1', 'Phường quản lý');
        $numRow = 1;
        $stt = 0;
        foreach ($row as $v) {
            $stt+=1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A'.$numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B'.$numRow, $v['name']);
            $excel->getActiveSheet()->setCellValue('C'.$numRow, $v['code']);
            $excel->getActiveSheet()->setCellValue('D'.$numRow, $v['email']);
            $excel->getActiveSheet() ->setCellValue('E'.$numRow, $v['phone']);
            $excel->getActiveSheet() ->setCellValue('F'.$numRow, $v['street_name']);

        }
      
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('listusers.xlsx');

        header('Content-Disposition: attachment; filename="danh-sach-can-bo.xlsx"');
        readfile('listusers.xlsx');

          
         //return Excel::download(new UsersExport, 'danhsachcanbo.xlsx');
  }

  public function export_phonebook(){

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Danh sách chủ hộ');
       
        $excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true)->setSize(12)
                            ->getColor()->setRGB('6F6F5F');
     
        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('C1', 'CMT/CMND');
        $excel->getActiveSheet()->setCellValue('D1', 'Họ và tên');
        $excel->getActiveSheet()->setCellValue('E1', 'Điện thoại');
        $excel->getActiveSheet()->setCellValue('F1', 'Email');
        $excel->getActiveSheet()->setCellValue('G1', 'Địa chỉ nhà thuê');
        $excel->getActiveSheet()->setCellValue('H1', 'Phường');
        $excel->getActiveSheet()->setCellValue('I1', 'Hợp đồng (có hoặc không)');
        $numRow = 1;
        $stt = 0;
        $row = Phonebook::all()->toArray();
        foreach ($row as $v) {
            $stt+=1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A'.$numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B'.$numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('C'.$numRow, $v['id_number']);
            $excel->getActiveSheet()->setCellValue('D'.$numRow, $v['fullname']);
            $excel->getActiveSheet() ->setCellValue('E'.$numRow, $v['phone']);
            $excel->getActiveSheet() ->setCellValue('F'.$numRow, $v['email']);
            $excel->getActiveSheet() ->setCellValue('G'.$numRow, $v['address']);
            $excel->getActiveSheet() ->setCellValue('H'.$numRow, $v['id_street']);
            $excel->getActiveSheet() ->setCellValue('I'.$numRow, $v['isok']);

        }
       // header('Content-type: application/vnd.ms-excel');
       
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('listphonebook.xlsx');
        header('Content-Disposition: attachment; filename="danh-ba.xlsx"');
        readfile('listphonebook.xlsx');

         //return Excel::download(new UsersExport, 'danhsachcanbo.xlsx');
  }

   public function export_excel_phonebook(){

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Danh sách chủ hộ');
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(18);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
       
        $excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true)->setSize(12)
                            ->getColor()->setRGB('000000');
        $excel->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setHorizontal('center');
     
        $excel->getActiveSheet()->setCellValue('A1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('B1', 'CMT/CMND');
        $excel->getActiveSheet()->setCellValue('C1', 'Họ và tên');
        $excel->getActiveSheet()->setCellValue('D1', 'Điện thoại');
        $excel->getActiveSheet()->setCellValue('E1', 'Email');
        $excel->getActiveSheet()->setCellValue('F1', 'Địa chỉ nhà thuê');
        $excel->getActiveSheet()->setCellValue('G1', 'Phường');
        $excel->getActiveSheet()->setCellValue('H1', 'Hợp đồng (có hoặc không)');
        $excel->getActiveSheet()->setCellValue('I1', 'Kênh thu thập thông tin');
        
      
       // header('Content-type: application/vnd.ms-excel');
       
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('listphonebookexcel.xlsx');
        header('Content-Disposition: attachment; filename="mau-nhap-danh-ba.xlsx"');
        readfile('listphonebookexcel.xlsx');

         //return Excel::download(new UsersExport, 'danhsachcanbo.xlsx');
  }

   public function export_search_phonebook(Request $req){
        if($req->type==1){
          if($req->select==1){
              $row =Phonebook::join('streets','streets.id','=','phonebook.id_street')->where('tax_code','like','%'.$req->keyword.'%')->get()->toArray();
             
            }elseif($req->select==2){
              $row = Phonebook::join('streets','streets.id','=','phonebook.id_street')->where('id_number','like','%'.$req->keyword.'%')->get()->toArray();
              
            }elseif($req->select==3){
              $row = Phonebook::join('streets','streets.id','=','phonebook.id_street')->where('fullname','like','%'.$req->keyword.'%')->get()->toArray();
              
            }elseif($req->select==4){
              $row = Phonebook::join('streets','streets.id','=','phonebook.id_street')->where('phone','like','%'.$key.'%')->get()->toArray();
              
            }elseif($req->select==5){
              $row = Phonebook::join('streets','streets.id','=','phonebook.id_street')->where('email','like','%'.$req->keyword.'%')->get()->toArray();
              
            }
        }elseif($req->type==2){
            $row = Phonebook::join('streets','streets.id','=','phonebook.id_street')->where('id_street',$req->select)->get();
        }

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Danh sách chủ hộ');
       
        $excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true)->setSize(12)
                            ->getColor()->setRGB('6F6F5F');
     
        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('C1', 'CMT/CMND');
        $excel->getActiveSheet()->setCellValue('D1', 'Họ và tên');
        $excel->getActiveSheet()->setCellValue('E1', 'Điện thoại');
        $excel->getActiveSheet()->setCellValue('F1', 'Email');
        $excel->getActiveSheet()->setCellValue('G1', 'Địa chỉ nhà thuê');
        $excel->getActiveSheet()->setCellValue('H1', 'Phường');
        $excel->getActiveSheet()->setCellValue('I1', 'Hợp đồng (có hoặc không)');
        $numRow = 1;
        $stt = 0;
        foreach ($row as $v) {
            $stt+=1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A'.$numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B'.$numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('C'.$numRow, $v['id_number']);
            $excel->getActiveSheet()->setCellValue('D'.$numRow, $v['fullname']);
            $excel->getActiveSheet() ->setCellValue('E'.$numRow, $v['phone']);
            $excel->getActiveSheet() ->setCellValue('F'.$numRow, $v['email']);
            $excel->getActiveSheet() ->setCellValue('G'.$numRow, $v['address']);
            $excel->getActiveSheet() ->setCellValue('H'.$numRow, $v['id_street']);
            $excel->getActiveSheet() ->setCellValue('I'.$numRow, $v['isok']);

        }
       // header('Content-type: application/vnd.ms-excel');
       
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('listphonebooksearch.xlsx');
        header('Content-Disposition: attachment; filename="ket-qua-danh-ba.xlsx"');
        readfile('listphonebooksearch.xlsx');

         //return Excel::download(new UsersExport, 'danhsachcanbo.xlsx');
  }

  public function search_phonebook(Request $req){
        $key = $req->get('keyword');
        $filter = $req->get('filter');
        $data3 = Streets::all();
        
        if(isset($key)){
            $type = 1;
            $keyword = $key;
            if($req->select==1){
              $data = Phonebook::join('streets','streets.id','=','phonebook.id_street')->where('tax_code','like','%'.$key.'%')->get();
              $select = $req->select;
            }elseif($req->select==2){
              $data = Phonebook::join('streets','streets.id','=','phonebook.id_street')->where('id_number','like','%'.$key.'%')->get();
              $select = $req->select;
            }elseif($req->select==3){
              $data = Phonebook::join('streets','streets.id','=','phonebook.id_street')->where('fullname','like','%'.$key.'%')->get();
              $select = $req->select;
            }elseif($req->select==4){
              $data = Phonebook::join('streets','streets.id','=','phonebook.id_street')->where('phone','like','%'.$key.'%')->get();
              $select = $req->select;
            }elseif($req->select==5){
             $data = Phonebook::join('streets','streets.id','=','phonebook.id_street')->where('email','like','%'.$key.'%')->get();
              $select = $req->select;
            }

        }elseif(isset($filter)){
            $data = Phonebook::join('streets','streets.id','=','phonebook.id_street')->where('id_street',$filter)->get();
            $type = 2;
            $select = $filter;
            $keyword = null;
        }
        return view('danhba/search',compact('data','data3','type','select','keyword'));
  }

   public function save_phonebook(Request $req){
        if($req->idnumber!=null && $req->taxcode!=null){
         $this->validate($req,[
            'idnumber'=>'unique:phonebook,id_number',
            'taxcode'=>'unique:phonebook,tax_code'
        
        ],
        [
            'idnumber.unique'=>'Số CMT/CCCD đã thuộc về 1 người khác',
            'taxcode.unique'=>'Mã số thuế đã thuộc về 1 người khác'

        ]);
        }

   	    $phonebook = new phonebook();
        $phonebook->tax_code = $req->taxcode;
        $phonebook->id_number = $req->idnumber;
        $phonebook->fullname = $req->fullname;
        $phonebook->email = $req->email;
        $phonebook->id_street = $req->street;
        $phonebook->phone = $req->phone;
        $phonebook->address = $req->address;
        $phonebook->isok = $req->isok;
        $phonebook->collect_channel = $req->channel;
        $phonebook->manager_name = $req->manager_name;
        $phonebook->manager_code = $req->manager_code;
        $phonebook->save();

        $macanbo = Session::get('usercode');
        $tencanbo = Session::get('username');
        $hanhdong = 'Đã lưu danh bạ chủ hộ '.$req->fullname.' mã số thuế '.$req->taxcode;
        $diary = new Diary();
        $diary->code = $macanbo;
        $diary->name = $tencanbo;
        $diary->action = $hanhdong;
        $diary->save();
        return redirect()->back()->with('thanhcong','Lưu danh bạ thành công');
   }

   public function check_taxcode(Request $req){

        $data = Phonebook::where('tax_code',$req->taxcode)->get();
        if(count($data)>0){
            echo '<span style="color: green;"><b>Mã số thuế hợp lệ</b></span>';
        }else{
            echo '<span style="color: red;"><b>Mã số thuế này không tồn tại hoặc chưa kê khai. <br>Hãy nhập đúng mã số thuế hợp lệ!</b></span>';
        }
   }
   public function get_fullname(Request $req){

        $data = Phonebook::where('tax_code',$req->taxcode)->get();
        if(count($data)>0){
            echo $data[0]['fullname'];
        }
   } 

   public function getTaxcode(Request $req){
      $key = $req->term;
      $data = Phonebook::where('tax_code','like','%'.$key.'%')->get()->toArray();
      $data2 = array();
      foreach ($data as $v) {
        $data3 = $v['tax_code'];
        array_push($data2, $data3);
      }
      echo json_encode($data2);

  } 

   public function edit_phonebook(Request $req){
       $id = $req->id;
       $data = Phonebook::where('id_phonebook',$id)->get()->toArray();
       $code = $data[0]['manager_code'];
       $code_user = Auth::user()->code;
       if($code == $code_user){
          $data = Phonebook::where('phonebook.id_phonebook',$req->id)->join('streets','phonebook.id_street','=','streets.id')->get()->toArray();
          $id_street = $data[0]['id_street'];
          $row = Streets::where('id',$id_street)->get()->toArray();
          $street_name = $row[0]['street_name'];
          $data2 = Streets::where('id','!=',$id_street)->get();
          return view('danhba/edit',compact('data','data2','id_street','street_name'));
      }else{
          return redirect()->back()->with('loi','Bạn không được quyền cập nhật danh bạ này');
      }
   }


   public function update_phonebook(Request $req){
     $id = $req->id;
     $data = Phonebook::where('id_phonebook',$id)->get()->toArray();
     $code = $data[0]['manager_code'];
     $code_user = Auth::user()->code;
     if($code == $code_user){
       $tax_code = $req->taxcode;
       $id_number = $req->idnumber;
       $fullname = $req->fullname;
       $email = $req->email;
       $phone = $req->phone;
       $street= $req->street;
       $address = $req->address;
       $isok = $req->isok;
       $collect_channel = $req->channel;
       $manager_name = $req->manager_name;
       $manager_code = $req->manager_code;

       $data = Phonebook::where('id_phonebook',$id)->update(['tax_code'=>$tax_code,'id_number'=>$id_number,'fullname'=>$fullname,
         'email'=>$email,'phone'=>$phone,'address'=>$address,'isok'=>$isok,'collect_channel'=>$collect_channel,'manager_name'=>$manager_name,'manager_code'=>$manager_code,'id_street'=>$street]);
       return  redirect()->route('admin.detail_phonebook');
     }else{
       return redirect()->back()->with('loi','Bạn không được quyền cập nhật danh bạ này');
     }
    
  }

}
