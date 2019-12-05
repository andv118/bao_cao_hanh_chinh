<?php

/**
 * Class quản lý các báo cáo
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Cell;
use App\Users;
use App\Models\Streets;
use App\Phonebook;
use App\Landcost;
use App\Tax;
use App\TaxDeclaration;
use App\Property;
use App\Contract;
use App\Models\DanhMuc;
use App\Models\MauBaoCao;
use App\Models\TieuChi;
use DB;

class ReportController extends Controller
{

    /**
     * Get mẫu báo cáo
     * @param
     * @return
     */
    public function getModelReport()
    {
        $arrMauBaoCao = array();
        $mauBaoCao = MauBaoCao::all();
        // dd($mauBaoCao);
        foreach ($mauBaoCao as $value) {
            $capBaoCao = null;
            if ($value->level == 1) {
                $capBaoCao = 'Quận, Huyện, Thị Xã';
            } elseif ($value->level == 2) {
                $capBaoCao = 'Sở và các cơ quan ngang Sở';
            } elseif ($value->level == 3) {
                $capBaoCao = 'Xã, Phường, Thị Trấn';
            } elseif ($value->level == 4) {
                $capBaoCao = 'Ban, Ngành';
            }

            $maubaocao = null;
            if ($value->type == 'baocao') {
                $maubaocao = 'Mẫu báo cáo';
                $type = 1;
            } elseif ($value->type == 'tonghop') {
                $maubaocao = 'Mẫu tổng hợp';
                $type = 2;
            }

            $arrMauBaoCao[] = (object) [
                'id'           => $value->id,
                'type'         => $type,
                'kieubaocao'   => $maubaocao,
                'level'        => $value->level,
                'capBaoCao'    => $capBaoCao,
                'code'         => $value->code,
                'name_phuluc'  => $value->name_phuluc,
                'name_baocao'  => $value->name_baocao,
                'name_ghichu'  => $value->name_ghichu,
                'quarter_year' => $value->quarter_year,
                'year'         => $value->year,
            ];
        }
        // dd($arrMauBaoCao);
        $data2 = Streets::join('users', 'users.role', '=', 'streets.id')->paginate(20);
        $data3 = Streets::all();
        // return view('baocao/mau-bao-cao', compact('arrMauBaoCao', 'data', 'data2', 'data3'));
        return view('baocao/mau-bao-cao')->with('mauBaoCao', $arrMauBaoCao)
            ->with('data2', $data2)
            ->with('data3', $data3);
    }

    /**
     * Lấy chi tiết mẫu báo cáo
     * @param
     * @return
     */
    public function getDetailModelReport($idMauBaoCao)
    {
        $data = Users::all();
        $data2 = Streets::join('users', 'users.role', '=', 'streets.id')->paginate(20);
        $data3 = Streets::all();
        $mauBaoCao = MauBaoCao::select('name_phuluc', 'name_baocao', 'name_ghichu')
            ->where('id', $idMauBaoCao)
            ->first();

        $listDanhMuc = DanhMuc::get()->toArray();
        $danhMuc = new DanhMuc();
        $listDanhMuc = $danhMuc->getTreeData($listDanhMuc, 0, null);

        $listTieuChi = TieuChi::get()->toArray();
        $tieuChi = new TieuChi();
        $listTieuChi = $tieuChi->getTreeData($listTieuChi, 0, null);

        $listTieuChi = $tieuChi->mergerTieuChi($listDanhMuc, $listTieuChi);
        // dd($listTieuChi);

        return view('baocao/chi-tiet-mau-bao-cao', compact('mauBaoCao', 'listDanhMuc', 'listTieuChi', 'data', 'data2', 'data3'));
    }

    /**
     * Kết hợp tiêu chí vào danh mục
     * @param array $listDanhMuc
     * @param array $listTieuChi
     * @return array $result
     */
    public function mergerTieuChi($listDanhMuc, $listTieuChi) {
        $result = array();

        foreach($listDanhMuc as $danhMuc) {
            $arrTieuChi = array();
            foreach($listTieuChi as $keyTC=>$tieuChi) {
                if($tieuChi['danh_muc'] == $danhMuc['id']) {
                    $arrTieuChi[] = $tieuChi;
                    unset($listTieuChi[$keyTC]);
                }
            }

            if(sizeOf($arrTieuChi) == 0) {
                $arrTieuChi = null;
            }
            $danhMuc['tieuchi'] = $arrTieuChi;
            $result[] = $danhMuc;
        }
        return $result;
    }


    /**
     * Thêm mẫu báo cáo
     * @param
     * @return view
     */
    public function createModelReport()
    {
        $data = Users::all();
        $data2 = Streets::join('users', 'users.role', '=', 'streets.id')->paginate(20);
        $data3 = Streets::all();
        return view('baocao/them-mau-bao-cao', compact('data', 'data2', 'data3'));
    }

    /**
     * Tạo mới mẫu báo cáo
     * @param request
     * @return
     */
    public function registerModelReport(Request $request)
    {
        $this->validate(
            $request,
            [
                'code' => 'required',
                'baocao' => 'required',
                'quy' => 'integer',
                'year' => 'required|integer',
            ],
            [
                'code.required' => 'Hãy nhập mã báo cáo',
                'baocao.required' => 'Hãy nhập tên báo cáo',
                'year.required' => 'Hãy nhập năm báo cáo',
                'quy.integer' => 'Qúy nhập vào là số',
                'year.integer' => 'Năm nhập vào là số',
            ]
        );
        $error = array();
        $code   = $request->code;
        $type   = $request->type;
        $kieuBaoCao = null;
        $phuLuc = $request->phuluc;
        $baoCao = $request->baocao;
        $ghiChu = $request->ghichu;
        $quy    = $request->quy;
        $year   = $request->year;
        $level  = $request->level;

        // check error
        if ($type == 0) {
            $error[] = 'Hãy chọn kiểu báo cáo';
        }
        if ($level == 0) {
            $error[] = 'Hãy chọn cấp báo cáo';
        }

        if ($request->type == 1) {
            $kieuBaoCao = 'baocao';
        } elseif ($request->type == 2) {
            $kieuBaoCao = 'tonghop';
        }

        // dd($error);

        if (sizeof($error) > 0) {
            return redirect()->back()->with('error', $error);
        }

        $arrInsert = array(
            'code'         => $code,
            'type'         => $kieuBaoCao,
            'level'        => $level,
            'name_phuluc'  => $phuLuc,
            'name_baocao'  => $baoCao,
            'name_ghichu'  => $ghiChu,
            'quarter_year' => $quy,
            'year'         => $year,
        );

        // dd($arrInsert);
        MauBaoCao::insert($arrInsert);

        return redirect()->back()->with('success', 'Thêm mới mẫu báo cáo thành công');
    }

    /**
     * Cập nhật mẫu báo cáo
     * @param request
     * @return
     */
    public function updateModelReport(Request $request)
    {
        $this->validate(
            $request,
            [
                'code' => 'required',
                'baocao' => 'required',
                'quy' => 'integer',
                'year' => 'required|integer',
            ],
            [
                'code.required' => 'Hãy nhập mã báo cáo',
                'baocao.required' => 'Hãy nhập tên báo cáo',
                'year.required' => 'Hãy nhập năm báo cáo',
                'quy.integer' => 'Qúy nhập vào là số',
                'year.integer' => 'Năm nhập vào là số',
            ]
        );

        $id = $request->id;
        $code   = $request->code;
        $type   = $request->type;
        $phuLuc = $request->phuluc;
        $baoCao = $request->baocao;
        $ghiChu = $request->ghichu;
        $quy    = $request->quy;
        $year   = $request->year;
        $level  = $request->level;

        if ($request->type == 1) {
            $type = 'baocao';
        } elseif ($request->type == 2) {
            $type = 'tonghop';
        }

        $arrUpdate = array(
            'code'         => $code,
            'type'         => $type,
            'level'        => $level,
            'name_phuluc'  => $phuLuc,
            'name_baocao'  => $baoCao,
            'name_ghichu'  => $ghiChu,
            'quarter_year' => $quy,
            'year'         => $year,
        );
        // dd($arrUpdate);

        MauBaoCao::where('id', $id)
            ->update($arrUpdate);
        return redirect()->back()->with('success', 'Cập nhật mẫu báo cáo thành công');
    }

    /**
     * Xóa mẫu báo cáo
     * @param request
     * @return
     */
    public function deleteModelReport(Request $request)
    {
        $id = $request->id;
        MauBaoCao::where('id', $id)
            ->delete();

        return redirect()->back();
    }





    public function report_total()
    {
        $data = TaxDeclaration::join('contract', 'contract.contract_code', '=', 'tax_declaration.id_contractcode')->join('phonebook', 'phonebook.tax_code', '=', 'contract.tax_code')->where('tax_declaration.declare', 0)->get();
        $baocaophainop = count($data);
        $data2 = DB::select('SELECT tax_declaration.id_contractcode, SUM(tax_declaration.difference) as debt,SUM(tax_declaration.payed) as total FROM `tax_declaration`  GROUP BY tax_declaration.id_contractcode');
        $baocaonothue = count($data2);

        $data4 = TaxDeclaration::join('contract', 'contract.contract_code', '=', 'tax_declaration.id_contractcode')->join('phonebook', 'phonebook.tax_code', '=', 'contract.tax_code')->where('tax_declaration.declare', 0)->get();
        $baocaokythue = count($data4);

        $data7 = Tax::where('ontime', '>=', 0)->get();
        $baocaodunghan = count($data7);
        $data8 = Tax::where('ontime', '<', 0)->get();
        $baocaoquahan = count($data8);
        $data9 = Contract::where('payment_year', '>', 100000000)->get();
        $baocaophainop2 = count($data9);
        $data10 = TaxDeclaration::join('tax', 'tax.contract_code', '=', 'tax_declaration.id_contractcode')->where('tax_declaration.declare', 1)->get();
        $baocaodakekhai = count($data10);
        $data11 = TaxDeclaration::where('ontime', '>=', 0)->get();
        $baocaokekhaidunghan = count($data11);
        $data12 = TaxDeclaration::where('ontime', '<', 0)->get();
        $baocaokekhaiquahan = count($data12);

        $dt1 = Property::where([['real_value', '>', '100000000'], ['manager', '<>', '1']])->get();
        $err1 = count($dt1);
        $dt2 = Property::whereRaw('property.real_value < property.total_value')->get();
        $err2 = count($dt2);
        $dt3 = Property::whereRaw('property.real_price_contract < property.real_value')->get();
        $err3 = count($dt3);
        $dt4 = Contract::where([['payment_year', '>', 100000000], ['manager', '<>', 1]])->get();
        $err4 = count($dt4);
        $dt5 = Tax::join('contract', 'contract.contract_code', '=', 'tax.contract_code')->where([['contract.total_cost', '<>', 'tax.price_contract'], ['contract.manager', 1]])->get();
        $err5 = count($dt5);

        return view('baocao/total', compact(
            'baocaophainop',
            'baocaonothue',
            'baocaokythue',
            'baocaodunghan',
            'baocaoquahan',
            'baocaophainop2',
            'baocaodakekhai',
            'baocaokekhaidunghan',
            'baocaokekhaiquahan',
            'err1',
            'err2',
            'err3',
            'err4',
            'err5'
        ));
    }

    public function report_submit()
    {
        $data = TaxDeclaration::join('contract', 'contract.contract_code', '=', 'tax_declaration.id_contractcode')->join('phonebook', 'phonebook.tax_code', '=', 'contract.tax_code')->where('tax_declaration.declare', 0)->get();
        return view('baocao/submit', compact('data'));
    }

    public function export_submit()
    {

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Báo cáo dự kiến');

        $excel->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(true)->setSize(12)
            ->getColor()->setRGB('6F6F5F');

        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Tên người nộp thuế');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã số thuế người nộp');
        $excel->getActiveSheet()->setCellValue('D1', 'Địa chỉ liên hệ người nộp');
        $excel->getActiveSheet()->setCellValue('E1', 'Tên tổ chức khai thay (nếu có)');
        $excel->getActiveSheet()->setCellValue('F1', 'Mã số thuế tổ chức khai thay (nếu có)');
        $excel->getActiveSheet()->setCellValue('G1', 'Địa chỉ liên hệ tổ chức khai thay (nếu có)');
        $excel->getActiveSheet()->setCellValue('H1', 'Mã hợp đồng kê khai thuế');
        $excel->getActiveSheet()->setCellValue('I1', 'Kỳ kê khai thuế (Quý/Năm)');
        $excel->getActiveSheet()->setCellValue('J1', 'Số lượng hợp đồng dự kiến phải khai thuế');
        $excel->getActiveSheet()->setCellValue('K1', 'Hạn nộp hồ sơ khai thuế (Quý/Năm)');
        $excel->getActiveSheet()->setCellValue('L1', 'Số thuế GTGT dự kiến');
        $excel->getActiveSheet()->setCellValue('M1', 'Số thuế TNCN dự kiến');
        $numRow = 1;
        $stt = 0;
        $row =  TaxDeclaration::join('contract', 'contract.contract_code', '=', 'tax_declaration.id_contractcode')->join('phonebook', 'phonebook.tax_code', '=', 'contract.tax_code')->where('tax_declaration.declare', 0)->get()->toArray();
        foreach ($row as $v) {
            $stt += 1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $v['fullname']);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('D' . $numRow, $v['address']);
            $excel->getActiveSheet()->setCellValue('E' . $numRow, '');
            $excel->getActiveSheet()->setCellValue('F' . $numRow, '');
            $excel->getActiveSheet()->setCellValue('G' . $numRow, '');
            $excel->getActiveSheet()->setCellValue('H' . $numRow, $v['contract_code']);
            if ($v['register'] == 1) {
                $excel->getActiveSheet()->setCellValue('I' . $numRow, $v['precious']);
            } elseif ($v['register'] == 2) {
                $excel->getActiveSheet()->setCellValue('I' . $numRow, date("d/m/Y", strtotime($v['year'])));
            }
            $excel->getActiveSheet()->setCellValue('J' . $numRow, '1');
            $excel->getActiveSheet()->setCellValue('K' . $numRow, date("d/m/Y", strtotime($v['deadline'])));
            $excel->getActiveSheet()->setCellValue('L' . $numRow, number_format($v['total_tax'] / 2));
            $excel->getActiveSheet()->setCellValue('M' . $numRow, number_format($v['total_tax'] / 2));
        }

        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('report_submit.xlsx');
        header('Content-Disposition: attachment; filename="bao-cao-du-kien.xlsx"');
        readfile('report_submit.xlsx');
    }



    public function tax_debt()
    {
        $data = DB::select('SELECT tax_declaration.id_contractcode, SUM(tax_declaration.difference) as debt,SUM(tax_declaration.payed) as total FROM `tax_declaration`  GROUP BY tax_declaration.id_contractcode');

        return view('baocao/tax_debt', compact('data'));
    }

    public function export_tax_debt()
    {

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Hợp đồng còn nợ thuế');

        $excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true)->setSize(12)
            ->getColor()->setRGB('6F6F5F');

        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('C1', 'Tổng thuê đã đóng');
        $excel->getActiveSheet()->setCellValue('D1', 'Tổng thuế còn nợ');

        $numRow = 1;
        $stt = 0;
        $row = DB::select('SELECT tax_declaration.id_contractcode, SUM(tax_declaration.difference) as debt,SUM(tax_declaration.payed) as total FROM `tax_declaration`  GROUP BY tax_declaration.id_contractcode');
        foreach ($row as $v) {
            $stt += 1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $v->id_contractcode);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, number_format($v->total / 2));
            $excel->getActiveSheet()->setCellValue('D' . $numRow, number_format($v->debt / 2));
        }

        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('report_tax_debt.xlsx');
        header('Content-Disposition: attachment; filename="hop-dong-con-no-thue.xlsx"');
        readfile('report_tax_debt.xlsx');
    }


    public function report_error()
    {
        $data = Contract::join('tax', 'tax.contract_code', '=', 'contract.contract_code')->where('tax.ontime', '<', 0)->get();

        return view('baocao/error', compact('data'));
    }

    public function export_error()
    {

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Báo cáo rủi ro');

        $excel->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(true)->setSize(12)
            ->getColor()->setRGB('6F6F5F');

        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Tên cá nhân cho thuê tài sản');
        $excel->getActiveSheet()->setCellValue('C1', 'MST cá nhân cho thuê tài sản');
        $excel->getActiveSheet()->setCellValue('D1', 'Mã số thuế bên thuê tài sản (nếu có)');
        $excel->getActiveSheet()->setCellValue('E1', 'Loại tài sản (Bất động sản/ Động sản)');
        $excel->getActiveSheet()->setCellValue('F1', 'Địa chỉ tài sản cho thuê/ kinh doanh');
        $excel->getActiveSheet()->setCellValue('G1', 'Mã số quản lý hợp đồng');
        $excel->getActiveSheet()->setCellValue('H1', ' Kỳ tính thuế');
        $excel->getActiveSheet()->setCellValue('I1', 'Hạn nộp');
        $excel->getActiveSheet()->setCellValue('J1', 'Số ngày quá hạn');
        $excel->getActiveSheet()->setCellValue('K1', 'Doanh thu năm');
        $excel->getActiveSheet()->setCellValue('L1', 'Mục đích sử dụng tài sản thuê');
        $excel->getActiveSheet()->setCellValue('M1', 'Bên thuê có đầu tư xây dựng cơ bản');
        $excel->getActiveSheet()->setCellValue('N1', 'Diện tích sàn cho thuê');
        $excel->getActiveSheet()->setCellValue('O1', 'Giá cho thuê 1 tháng đã bao gồm thuế (VNĐ)');
        $excel->getActiveSheet()->setCellValue('P1', 'Ghi chú');
        $numRow = 1;
        $stt = 0;
        $row =  Contract::join('tax', 'tax.contract_code', '=', 'contract.contract_code')->where('tax.ontime', '<', 0)->get()->toArray();
        foreach ($row as $v) {
            $stt += 1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $v['fullname']);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('D' . $numRow, '');
            $excel->getActiveSheet()->setCellValue('E' . $numRow, 'Bất động sản');
            $excel->getActiveSheet()->setCellValue('F' . $numRow, '');
            $excel->getActiveSheet()->setCellValue('G' . $numRow, $v['contract_code']);
            if ($v['register'] == 1) {
                $excel->getActiveSheet()->setCellValue('H' . $numRow, $v['precious_declare']);
            } elseif ($v['register'] == 2) {
                $excel->getActiveSheet()->setCellValue('H' . $numRow, $v['year_declare']);
            }
            $excel->getActiveSheet()->setCellValue('I' . $numRow, date("d/m/Y", strtotime($v['deadline'])));
            $excel->getActiveSheet()->setCellValue('J' . $numRow, -$v['ontime']);
            $excel->getActiveSheet()->setCellValue('K' . $numRow, $v['payment_year']);
            $excel->getActiveSheet()->setCellValue('L' . $numRow, $v['method']);
            $excel->getActiveSheet()->setCellValue('M' . $numRow, 'Có');
            $excel->getActiveSheet()->setCellValue('N' . $numRow, $v['area']);
            $excel->getActiveSheet()->setCellValue('O' . $numRow, number_format($v['cost_month']));
            $excel->getActiveSheet()->setCellValue('P' . $numRow, '');
        }

        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('report_error.xlsx');
        header('Content-Disposition: attachment; filename="bao-cao-rui-ro.xlsx"');
        readfile('report_error.xlsx');
    }


    public function period()
    {
        $data = TaxDeclaration::join('contract', 'contract.contract_code', '=', 'tax_declaration.id_contractcode')->join('phonebook', 'phonebook.tax_code', '=', 'contract.tax_code')->where('tax_declaration.declare', 0)->get();
        return view('baocao/period', compact('data'));
    }

    public function export_period()
    {

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Kỳ kê khai thuế cần nộp');

        $excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true)->setSize(12)
            ->getColor()->setRGB('6F6F5F');

        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Tên người nộp thuế');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã số thuế người nộp thuế');
        $excel->getActiveSheet()->setCellValue('D1', 'Địa chỉ liên hệ');
        $excel->getActiveSheet()->setCellValue('E1', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('F1', 'Kỳ khai thuế (Quý/Năm)');
        $excel->getActiveSheet()->setCellValue('G1', 'Hạn nộp hồ sơ khai thuế (Quý/Năm)');
        $excel->getActiveSheet()->setCellValue('H1', 'Số thuế GTGT dự kiến');
        $excel->getActiveSheet()->setCellValue('I1', 'Số thuế TNCN dự kiến');

        $numRow = 1;
        $stt = 0;
        $row = TaxDeclaration::join('contract', 'contract.contract_code', '=', 'tax_declaration.id_contractcode')->join('phonebook', 'phonebook.tax_code', '=', 'contract.tax_code')->where('tax_declaration.declare', 0)->get()->toArray();
        foreach ($row as $v) {
            $stt += 1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $v['fullname']);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('D' . $numRow, $v['address']);
            $excel->getActiveSheet()->setCellValue('E' . $numRow, $v['contract_code']);
            if ($v['register'] == 1) {
                $excel->getActiveSheet()->setCellValue('F' . $numRow, $v['precious']);
            } elseif ($v['register'] == 2) {
                $excel->getActiveSheet()->setCellValue('F' . $numRow, $v['year']);
            }
            $excel->getActiveSheet()->setCellValue('G' . $numRow, date("d/m/Y", strtotime($v['deadline'])));
            $excel->getActiveSheet()->setCellValue('H' . $numRow, number_format($v['total_tax'] / 2));
            $excel->getActiveSheet()->setCellValue('I' . $numRow, number_format($v['total_tax'] / 2));
        }

        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('report_period.xlsx');
        header('Content-Disposition: attachment; filename="hop-dong-co-ky-khai-thue-can-nop.xlsx"');
        readfile('report_period.xlsx');
    }

    public function report_force()
    {
        $data = TaxDeclaration::join('contract', 'contract.contract_code', '=', 'tax_declaration.id_contractcode')->join('phonebook', 'phonebook.tax_code', '=', 'contract.tax_code')->where('tax_declaration.declare', 0)->get();
        return view('baocao/force', compact('data'));
    }

    public function export_force()
    {

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Báo cáo đôn đốc kê khai');

        $excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true)->setSize(12)
            ->getColor()->setRGB('6F6F5F');

        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Tên người nộp thuế');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('D1', 'Địa chỉ liên');
        $excel->getActiveSheet()->setCellValue('E1', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('F1', 'Kỳ khai thuế (Quý/Năm)');
        $excel->getActiveSheet()->setCellValue('G1', 'Hạn nộp HSKT (Quý/Năm)');
        $excel->getActiveSheet()->setCellValue('H1', 'Số thuế GTGT dự kiến');
        $excel->getActiveSheet()->setCellValue('I1', 'Số thuế TNCN dự kiến');
        $excel->getActiveSheet()->setCellValue('J1', 'Biện pháp (Trước hạn nộp HSKT)');
        $excel->getActiveSheet()->setCellValue('K1', 'Số lần (Trước hạn nộp HSKT)');
        $excel->getActiveSheet()->setCellValue('L1', 'Biện pháp (Trước hạn nộp HSKT)');
        $excel->getActiveSheet()->setCellValue('M1', 'Số lần (Trước hạn nộp HSKT)');
        $excel->getActiveSheet()->setCellValue('N1', 'Kết quả đôn đốc');
        $excel->getActiveSheet()->setCellValue('O1', 'Chuyển xác minh thực tế');
        $numRow = 1;
        $stt = 0;
        $row =  TaxDeclaration::join('contract', 'contract.contract_code', '=', 'tax_declaration.id_contractcode')->join('phonebook', 'phonebook.tax_code', '=', 'contract.tax_code')->where('tax_declaration.declare', 0)->get()->toArray();
        foreach ($row as $v) {
            $stt += 1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $v['fullname']);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('D' . $numRow, $v['address']);
            $excel->getActiveSheet()->setCellValue('E' . $numRow, $v['contract_code']);
            if ($v['register'] == 1) {
                $excel->getActiveSheet()->setCellValue('F' . $numRow, $v['precious']);
            } elseif ($v['register'] == 2) {
                $excel->getActiveSheet()->setCellValue('F' . $numRow, date("d/m/Y", strtotime($v['year'])));
            }
            $excel->getActiveSheet()->setCellValue('G' . $numRow, date("d/m/Y", strtotime($v['deadline'])));
            $excel->getActiveSheet()->setCellValue('H' . $numRow, number_format($v['total_tax'] / 2));
            $excel->getActiveSheet()->setCellValue('I' . $numRow, number_format($v['total_tax'] / 2));
            $excel->getActiveSheet()->setCellValue('J' . $numRow, 'Thông báo');
            $excel->getActiveSheet()->setCellValue('K' . $numRow, '1');
            $excel->getActiveSheet()->setCellValue('L' . $numRow, 'Thông báo');
            $excel->getActiveSheet()->setCellValue('M' . $numRow, '1');
            $excel->getActiveSheet()->setCellValue('N' . $numRow, '');
            $excel->getActiveSheet()->setCellValue('O' . $numRow, 'Chi cục thuế tây hồ');
        }

        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('report_force.xlsx');
        header('Content-Disposition: attachment; filename="bao-cao-don-doc-ke-khai.xlsx"');
        readfile('report_force.xlsx');
    }



    public function report_record()
    {
        $data = TaxDeclaration::join('tax', 'tax.contract_code', '=', 'tax_declaration.id_contractcode')->join('phonebook', 'phonebook.tax_code', '=', 'tax.tax_code')->get();

        return view('baocao/record', compact('data'));
    }

    public function export_record()
    {

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Báo cáo ghi thu');

        $excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true)->setSize(12)
            ->getColor()->setRGB('6F6F5F');

        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('C1', 'Họ và tên');
        $excel->getActiveSheet()->setCellValue('D1', 'Địa chỉ');
        $excel->getActiveSheet()->setCellValue('E1', 'Kỳ kê khai');
        $excel->getActiveSheet()->setCellValue('F1', 'Từ ngày đến ngày');
        $excel->getActiveSheet()->setCellValue('G1', 'Tổng thuế');
        $excel->getActiveSheet()->setCellValue('H1', 'Thuế GTGT');
        $excel->getActiveSheet()->setCellValue('I1', 'Thuế TNCN');
        $excel->getActiveSheet()->setCellValue('J1', 'Phí và Lệ Phí MB');
        $excel->getActiveSheet()->setCellValue('K1', 'Ghi chú');
        $numRow = 1;
        $stt = 0;
        $row =  TaxDeclaration::join('tax', 'tax.contract_code', '=', 'tax_declaration.id_contractcode')->join('phonebook', 'phonebook.tax_code', '=', 'tax.tax_code')->get()->toArray();
        foreach ($row as $v) {
            $stt += 1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $v['fullname']);
            $excel->getActiveSheet()->setCellValue('D' . $numRow, $v['address']);
            if ($v['register'] == 1) {
                $excel->getActiveSheet()->setCellValue('E' . $numRow, $v['precious']);
            } elseif ($v['register'] == 2) {
                $excel->getActiveSheet()->setCellValue('E' . $numRow, $v['year']);
            }
            $excel->getActiveSheet()->setCellValue('F' . $numRow, $v['from_to']);
            $excel->getActiveSheet()->setCellValue('G' . $numRow, number_format($v['total_tax']));
            $excel->getActiveSheet()->setCellValue('H' . $numRow, number_format($v['total_tax'] / 2));
            $excel->getActiveSheet()->setCellValue('I' . $numRow, number_format($v['total_tax'] / 2));
            $excel->getActiveSheet()->setCellValue('J' . $numRow, '300,000');
            $excel->getActiveSheet()->setCellValue('K' . $numRow, 'Chi cục thuế tây hồ');
        }

        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('report_record.xlsx');
        header('Content-Disposition: attachment; filename="bao-cao-ghi-thu.xlsx"');
        readfile('report_record.xlsx');
    }

    public function declare_ontime()
    {
        $data = Tax::where('ontime', '>=', 0)->get();
        return view('baocao/declare_ontime', compact('data'));
    }

    public function export_declare_ontime()
    {

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Hợp đồng kê khai đúng hạn');

        $excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true)->setSize(12)
            ->getColor()->setRGB('6F6F5F');

        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Tên chủ hộ');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('D1', 'Mã tài sản');
        $excel->getActiveSheet()->setCellValue('E1', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('F1', 'Ngày nộp tờ khai');
        $excel->getActiveSheet()->setCellValue('G1', 'Hạn nộp tờ khai');

        $numRow = 1;
        $stt = 0;
        $row = Tax::where('ontime', '>=', 0)->get()->toArray();
        foreach ($row as $v) {
            $stt += 1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $v['fullname']);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('D' . $numRow, $v['property_code']);
            $excel->getActiveSheet()->setCellValue('E' . $numRow, $v['contract_code']);
            $excel->getActiveSheet()->setCellValue('F' . $numRow, date("d/m/Y", strtotime($v['submit_date'])));
            $excel->getActiveSheet()->setCellValue('G' . $numRow, date("d/m/Y", strtotime($v['deadline'])));
        }

        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('report_declare_ontime.xlsx');
        header('Content-Disposition: attachment; filename="hop-dong-ke-khai-dung-han.xlsx"');
        readfile('report_declare_ontime.xlsx');
    }



    public function declare_outtime()
    {
        $data = Tax::where('ontime', '<', 0)->get();
        return view('baocao/declare_outtime', compact('data'));
    }

    public function export_declare_outtime()
    {

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Hợp đồng kê khai quá hạn');

        $excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true)->setSize(12)
            ->getColor()->setRGB('6F6F5F');

        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Tên chủ hộ');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('D1', 'Mã tài sản');
        $excel->getActiveSheet()->setCellValue('E1', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('F1', 'Ngày nộp tờ khai');
        $excel->getActiveSheet()->setCellValue('G1', 'Hạn nộp tờ khai');

        $numRow = 1;
        $stt = 0;
        $row = Tax::where('ontime', '<', 0)->get()->toArray();
        foreach ($row as $v) {
            $stt += 1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $v['fullname']);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('D' . $numRow, $v['property_code']);
            $excel->getActiveSheet()->setCellValue('E' . $numRow, $v['contract_code']);
            $excel->getActiveSheet()->setCellValue('F' . $numRow, date("d/m/Y", strtotime($v['submit_date'])));
            $excel->getActiveSheet()->setCellValue('G' . $numRow, date("d/m/Y", strtotime($v['deadline'])));
        }

        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('report_declare_outtime.xlsx');
        header('Content-Disposition: attachment; filename="hop-dong-ke-khai-qua-han.xlsx"');
        readfile('report_declare_outtime.xlsx');
    }



    public function

    declare()
    {
        $data = Contract::where('payment_year', '>', 100000000)->get();
        return view('baocao/declare', compact('data'));
    }

    public function export_declare()
    {

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Hợp đồng phải nộp thuế');

        $excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true)->setSize(12)
            ->getColor()->setRGB('6F6F5F');

        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Tên chủ hộ');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('D1', 'Mã tài sản');
        $excel->getActiveSheet()->setCellValue('E1', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('F1', 'Giá hợp đồng theo tháng');
        $excel->getActiveSheet()->setCellValue('G1', 'Giá hợp đồng theo năm');

        $numRow = 1;
        $stt = 0;
        $row = Contract::where('payment_year', '>', 100000000)->get()->toArray();
        foreach ($row as $v) {
            $stt += 1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $v['fullname']);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('D' . $numRow, $v['property_code']);
            $excel->getActiveSheet()->setCellValue('E' . $numRow, $v['contract_code']);
            $excel->getActiveSheet()->setCellValue('F' . $numRow, number_format($v['total_cost']));
            $excel->getActiveSheet()->setCellValue('G' . $numRow, number_format($v['payment_year']));
        }

        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('report_declare.xlsx');
        header('Content-Disposition: attachment; filename="hop-dong-phai-nop-thue.xlsx"');
        readfile('report_declare.xlsx');
    }


    public function declared()
    {
        $data = TaxDeclaration::join('tax', 'tax.contract_code', '=', 'tax_declaration.id_contractcode')->where('tax_declaration.declare', 1)->get();

        return view('baocao/declared', compact('data'));
    }

    public function export_declared()
    {

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Hợp đồng đã nộp thuế');

        $excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true)->setSize(12)
            ->getColor()->setRGB('6F6F5F');

        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Tên chủ hộ');
        $excel->getActiveSheet()->setCellValue('C1', 'Mã số thuế');
        $excel->getActiveSheet()->setCellValue('D1', 'Mã tài sản');
        $excel->getActiveSheet()->setCellValue('E1', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('F1', 'Quý/Năm');
        $excel->getActiveSheet()->setCellValue('G1', 'Ngày nộp tiền');
        $excel->getActiveSheet()->setCellValue('H1', 'Số tiền nộp');
        $excel->getActiveSheet()->setCellValue('I1', 'Nợ');

        $numRow = 1;
        $stt = 0;
        $row = TaxDeclaration::join('tax', 'tax.contract_code', '=', 'tax_declaration.id_contractcode')->where('tax_declaration.declare', 1)->get()->toArray();
        foreach ($row as $v) {
            $stt += 1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $v['fullname']);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $v['tax_code']);
            $excel->getActiveSheet()->setCellValue('D' . $numRow, $v['property_code']);
            $excel->getActiveSheet()->setCellValue('E' . $numRow, $v['contract_code']);
            if ($v['register'] == 1) {
                $excel->getActiveSheet()->setCellValue('F' . $numRow, $v['precious']);
            } elseif ($v['register'] == 2) {
                $excel->getActiveSheet()->setCellValue('F' . $numRow, $v['year']);
            }
            $excel->getActiveSheet()->setCellValue('G' . $numRow, date("d/m/Y", strtotime($v['payed_date'])));
            $excel->getActiveSheet()->setCellValue('H' . $numRow, number_format($v['payed']));
            $excel->getActiveSheet()->setCellValue('I' . $numRow, number_format($v['difference']));
        }

        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('report_declared.xlsx');
        header('Content-Disposition: attachment; filename="hop-dong-da-nop-thue.xlsx"');
        readfile('report_declared.xlsx');
    }



    public function submit_ontime()
    {
        $data = TaxDeclaration::where('ontime', '>=', 0)->get();
        return view('baocao/submit_ontime', compact('data'));
    }


    public function export_submit_ontime()
    {

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Hợp đồng kê khai thuế đúng hạn');

        $excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true)->setSize(12)
            ->getColor()->setRGB('6F6F5F');

        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('C1', 'Kỳ kê khai thuế');
        $excel->getActiveSheet()->setCellValue('D1', 'Từ ngày đến ngày');
        $excel->getActiveSheet()->setCellValue('E1', 'Hạn kê khai thuế');
        $excel->getActiveSheet()->setCellValue('F1', 'Ngày nộp tờ khai');

        $numRow = 1;
        $stt = 0;
        $row = TaxDeclaration::where('ontime', '>=', 0)->get()->toArray();
        foreach ($row as $v) {
            $stt += 1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $v['id_contractcode']);
            if ($v['register'] == 1) {
                $excel->getActiveSheet()->setCellValue('C' . $numRow, $v['precious']);
            } elseif ($v['register'] == 2) {
                $excel->getActiveSheet()->setCellValue('C' . $numRow, $v['year']);
            }
            $excel->getActiveSheet()->setCellValue('D' . $numRow, $v['from_to']);
            $excel->getActiveSheet()->setCellValue('E' . $numRow, date("d/m/Y", strtotime($v['deadline'])));
            $excel->getActiveSheet()->setCellValue('F' . $numRow, date("d/m/Y", strtotime($v['payed_date'])));
        }

        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('report_submit_ontime.xlsx');
        header('Content-Disposition: attachment; filename="hop-dong-ke-khai-thue-dung-han.xlsx"');
        readfile('report_submit_ontime.xlsx');
    }

    public function submit_outtime()
    {
        $data = TaxDeclaration::where('ontime', '<', 0)->get();
        return view('baocao/submit_outtime', compact('data'));
    }

    public function export_submit_outtime()
    {

        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0);
        //Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle('Hợp đồng kê khai thuế qúa hạn');

        $excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true)->setSize(12)
            ->getColor()->setRGB('6F6F5F');

        $excel->getActiveSheet()->setCellValue('A1', 'STT');
        $excel->getActiveSheet()->setCellValue('B1', 'Mã hợp đồng');
        $excel->getActiveSheet()->setCellValue('C1', 'Kỳ kê khai thuế');
        $excel->getActiveSheet()->setCellValue('D1', 'Từ ngày đến ngày');
        $excel->getActiveSheet()->setCellValue('E1', 'Hạn kê khai thuế');
        $excel->getActiveSheet()->setCellValue('F1', 'Ngày nộp tờ khai');

        $numRow = 1;
        $stt = 0;
        $row = TaxDeclaration::where('ontime', '<', 0)->get()->toArray();
        foreach ($row as $v) {
            $stt += 1;
            $numRow++;
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $stt);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $v['id_contractcode']);
            if ($v['register'] == 1) {
                $excel->getActiveSheet()->setCellValue('C' . $numRow, $v['precious']);
            } elseif ($v['register'] == 2) {
                $excel->getActiveSheet()->setCellValue('C' . $numRow, $v['year']);
            }
            $excel->getActiveSheet()->setCellValue('D' . $numRow, $v['from_to']);
            $excel->getActiveSheet()->setCellValue('E' . $numRow, date("d/m/Y", strtotime($v['deadline'])));
            $excel->getActiveSheet()->setCellValue('F' . $numRow, date("d/m/Y", strtotime($v['payed_date'])));
        }

        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('report_submit_outtime.xlsx');
        header('Content-Disposition: attachment; filename="hop-dong-ke-khai-thue-qua-han.xlsx"');
        readfile('report_submit_outtime.xlsx');
    }
}
