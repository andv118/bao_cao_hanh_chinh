<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonViHanhChinh;
use App\Models\DonViTieuChi;

class DanhMucController extends Controller
{

    public function getHanhChinh()
    {
        $listDvHanhChinh = DonViHanhChinh::where('role', 0)->get()->toArray();
        $dvHanhChinh = new DonViHanhChinh();
        $listDvHanhChinh = $dvHanhChinh->getTreeData($listDvHanhChinh, 0, null);
        // dd($listDvHanhChinh);

        return view('danhmuc/hanh-chinh', compact('listDvHanhChinh'));
    }

    /**
     * Lọc data theo hành chính hoặc chuyên môn
     * @param Request
     * @return respone json
     */
    public function filterData(Request $request)
    {
        if ($request->ajax()) {
            // choose 0: hanh chinh, 1: chuyen mon
            $choose = $request->get('choose');
            $keyword = $request->get('keyword');

            // loc
            if ($keyword == null) {
                if ($choose == 0) {
                    $listDvHanhChinh = DonViHanhChinh::where('role', 0)->get()->toArray();
                } else {
                    $listDvHanhChinh = DonViHanhChinh::where('role', 1)->get()->toArray();
                }
            }
            // submit tim kiem
            else {
                if ($choose == 0) {
                    $listDvHanhChinh = DonViHanhChinh::where([
                        ['role', 0],
                        ['name', 'like', '%' . $keyword . '%']
                    ])->get();
                } else {
                    $listDvHanhChinh = DonViHanhChinh::where([
                        ['role', 1],
                        ['name', 'like', '%' . $keyword . '%']
                    ])->get();
                }
            }

            $dvHanhChinh = new DonViHanhChinh();
            $listDvHanhChinh = $dvHanhChinh->getTreeData($listDvHanhChinh, 0, null);
            return response()->json($listDvHanhChinh, 200);
        }
        return "not found";
    }

    /**
     * Tìm kiếm đơn vị hành chính
     * @param Request
     * @return respone json
     */
    public function searchData(Request $request)
    {
        if ($request->ajax()) {
            // choose 0: hanh chinh, 1: chuyen mon
            $choose = $request->get('choose');
            $keyword = $request->get('keyword');

            if ($choose == 0) {
                $listDvHanhChinh = DonViHanhChinh::where([
                    ['role', 0],
                    ['name', 'like', '%' . $keyword . '%']
                ])
                    ->limit(5)
                    ->get();
            } else {
                $listDvHanhChinh = DonViHanhChinh::where([
                    ['role', 1],
                    ['name', 'like', '%' . $keyword . '%']
                ])
                    ->limit(5)
                    ->get();
            }
            return response()->json($listDvHanhChinh, 200);
        }
        return "not found";
    }

    /************************************* ĐƠN VỊ TÍNH *********************/

    public function getDonViTinh()
    {
        $listDonViTieuChi = DonViTieuChi::get();
        // dd($listDonViTieuChi);

        return view('danhmuc/don-vi-tinh', compact('listDonViTieuChi'));
    }

   
    public function deleteDonViTinh(Request $request)
    {
        $id = $request->id;
        DonViTieuChi::where('id', $id)
            ->delete();
        return redirect()->back();
    }

    public function updateDonViTinh(Request $request)
    {   
        $this->validate(
            $request,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Hãy nhập đơn vị tiêu chí',
            ]
        );

        $id = $request->id;
        $name = $request->name;

        $arrUpdate = array(
            'name' => $name,
        );

        DonViTieuChi::where('id', $id)
        ->update($arrUpdate);
        return redirect()->back()->with('success', 'Cập nhật đơn vị tiêu chí thành công');
    }

    public function addDonViTinh(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Hãy nhập đơn vị tiêu chí',
            ]
        );
        $name = $request->name;
        $arrInsert = array(
            'name'     => $name,
        );
        DonViTieuChi::insert($arrInsert);
        return redirect()->back()->with('success', 'Thêm mới đơn vị tiêu chí thành công');
    }

}
