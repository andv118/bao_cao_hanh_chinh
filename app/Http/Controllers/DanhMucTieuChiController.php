<?php

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
use Illuminate\Pagination\Paginator;

class DanhMucTieuChiController extends Controller
{
    public function index() {
        $listDanhMuc = DanhMuc::get()->toArray();
        $danhMuc = new DanhMuc();
        $listDanhMuc = $danhMuc->getTreeData($listDanhMuc, 0, null);

        $listTieuChi = TieuChi::get()->toArray();
        $tieuChi = new TieuChi();
        $listTieuChi = $tieuChi->getTreeData($listTieuChi, 0, null);

        $listTieuChi = $tieuChi->mergerTieuChi($listDanhMuc, $listTieuChi);
        // dd($listTieuChi);

        $danhMuc = DanhMuc::select('id', 'title')
                ->where([
                    ['id', '!=', '1'],
                    ['id', '!=', '2']
                    ])
                ->get();
        // dd($danhMuc);        

        return view('danhmuctieuchi/danh-muc-tieu-chi', compact('listDanhMuc', 'listTieuChi'));
    
    }

    /**
     * Xóa danh mục và tiêu chí
     * @param request
     * @return
     */
    public function delete(Request $request)
    {   
        $type = $request->type;
        $id = $request->id;
        // type: danhmuc-0; tieuchi-1
        if($type == 0) {
            DanhMuc::where('id', $id)
            ->delete();
        } elseif($type == 1) {
            TieuChi::where('id', $id)
            ->delete();
        }
        return redirect()->back();
    }


    /**
     * Get view update danh mục và tiêu chí
     * @param request
     * @return
     */
    public function getViewUpdate(Request $request)
    {   
        if ($request->ajax()) {
            $result = [];
            $type = $request->get('type');
            $id   = $request->get('id');
            $parentId   = $request->get('parentId');

            // type: danhmuc-0; tieuchi-1
            if($type == 0) {
                $listDanhMuc = DanhMuc::select('id', 'title')
                ->where('id', '!=', $id)
                ->get()
                ->toArray();
                $danhMuc = new DanhMuc();
                $listDanhMuc = $danhMuc->getTreeData($listDanhMuc, 0, null);
            } elseif($type == 1) {

            }
            
            // echo 'type: ' . $type . "<br>" . 'id: ' . $id;
            // return view('view.admin.cap_nhat_thu_cong.data_huyen')->with(['data' => $data])->render();
        }
    }
 
}
