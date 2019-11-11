<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Infomation;
use App\Models\Rename;
use App\Models\TotalCost;
use App\Models\Type;
use App\Models\CoQuan;
use App\Models\Joining;
use App\Models\Facilities;
use App\Models\OperatingExpenses;
use App\Models\Dissolution;
use App\Models\ForeignMembers;

class InfoController extends Controller
{

    public function create()
    {

        $data = Infomation::all();
        $type = Type::all();
        $coquan = CoQuan::all();
        return view('info/create', compact('data', 'type', 'coquan'));
    }


    public function thongTinChiTietHoi($MaHoi)
    {
        $detail_info = Infomation::where('MaHoi', $MaHoi)->get();
        return view('thongTinHoi', ['detail_info' => $detail_info]);
    }


    public function home()
    {

        return view('trangchu');
    }

    public function listMember()
    {
        return view('info/list-member');
    }

    public function listType()
    {
        return view('info/list-type');
    }

    public function list_info(Request $request)
    {   
        if(isset($request->keyword)){
            $keyword = $request->keyword;
            $list_info = Infomation::where('TenTiengViet', 'like', '%' . $keyword . '%')
                ->orWhere('TenTiengAnh', 'like', '%' . $keyword . '%')->paginate(50);
        } else {
            $list_info = Infomation::orderBy('MaHoi', 'ASC')->paginate(50);

        }
        return view('info/list', ['list_info' => $list_info]);
    }

    public function detail_info($id)
    {

        $detail_info = Infomation::where('MaHoi', $id)->take(1)->get();
        return view('info/detail', ['detail_info' => $detail_info]);
        // dd($detail_info);

    }
    public function get_info($id)
    {
        $data = Infomation::find($id)->toArray();
        $type = Type::all();
        $data2 = Infomation::where('id', '!=', $id)->get()->toArray();
        return view('info/edit', ['data' => $data, 'type' => $type, 'data2' => $data2]);
    }

    public function post_info(Request $request, $id)
    {
        $detail_info = Infomation::find($id);
    }

    public function ajaxRename()
    {
        return view('info/create');
    }

    public function ajaxRenamePost(Request $request)
    {

        $data = new Rename();
        $data->id_info = $request->id_info;
        $data->name = $request->name;
        $data->number_decision = $request->number_decision;
        $data->date_decision = $request->date_decision;
        $data->organ_decision = $request->organ_decision;
        $data->save();


        return response()->json(['success' => 'Lưu thành công']);
    }

    /**
     * Tìm kiếm hội trên input search
     * @param request
     * @return array data
     */
    public function post_search_list(Request $request)
    {
        if (isset($request->data)) {
            $arr = [];
            $keyword = $request->data;
            $data = Infomation::where('TenTiengViet', 'like', '%' . $keyword . '%')
                ->orWhere('TenTiengAnh', 'like', '%' . $keyword . '%')->limit(5)->get()->toArray();
            foreach ($data as $val) {
                array_push($arr, $val['TenTiengViet']);
            }
            // return response()->json($data, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
            return $arr;
        }
    }

    /**
     * Hiển thị kết quả tìm kiếm
     * @param request
     * @return array data
     */
    public function post_result_search(Request $request)
    {   
        // todo
        $search = $request->input('keyword');
        if(trim($search) != "") {
            $data = Infomation::where('TenTiengViet', 'like', '%' . trim($search) . '%')
            ->orWhere('TenTiengAnh', 'like', '%' . trim($search) . '%')->limit(5)->get()->pagination();
        }

        if (isset($request->data)) {
            $arr = [];
            $keyword = $request->data;
            
            foreach ($data as $val) {
                array_push($arr, $val['TenTiengViet']);
            }
            // return response()->json($data, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
            return $arr;
        }
    }

    public function saveInfo(Request $request)
    {

        $data = new Infomation();
        $data->TenTiengViet = $request->TenTiengViet;
        $data->TenTiengAnh = $request->TenTiengAnh;
        $data->TenGiaoDichTiengAnh = $request->TenGiaoDichTiengAnh;
        $data->SoQDThanhLap = $request->SoQDThanhLap;
        $data->SoQDPheDuyetDieuLe = $request->SoQDPheDuyetDieuLe;
        $data->MaCoQuanQuanLy = $request->MaCoQuanQuanLy;
        $data->LoaiHoi = $request->LoaiHoi;
        $data->DiaChi = $request->DiaChi;
        $data->SoDienThoai = $request->SoDienThoai;
        $data->Fax = $request->Fax;
        $data->Website = $request->Website;
        $data->Email = $request->Email;
        $data->DienTichTruSo = $request->DienTichTruSo;
        $data->TuCo = $request->TuCo;
        $data->NhaNuocCap = $request->NhaNuocCap;
        $data->state_level = $request->state_level;
        $data->arena = $request->arena;
        $data->field_active = $request->field_active;
        $data->field_other = $request->field_other;
        $data->term = $request->term;
        $data->number_term = $request->number_term;
        $data->term_current = $request->term_current;
        $data->is_systematical = $request->is_systematical;
        $data->note = $request->note;
        $data->save();

        return redirect()->back()->with('success', 'Thêm mới thành công');
    }


    public function saveRename(Request $request)
    {

        $data = new Rename();
        $data->name  = $request->name;
        $data->number_decision  = $request->number_decision;
        $data->date_decision  = $request->date_decision;
        $data->organ_decision  = $request->organ_decision;
        $data->id_info  = $request->id_info;
        $data->save();

        return redirect()->back()->with('success', 'Thêm mới thành công');
    }


    public function saveJoining(Request $request)
    {

        $data = new Rename();
        $data->name  = $request->name;
        $data->number_decision  = $request->number_decision;
        $data->date_decision  = $request->date_decision;
        $data->organ_decision  = $request->organ_decision;
        $data->id_info  = $request->id_info;
        $data->save();

        return redirect()->back()->with('success', 'Thêm mới thành công');
    }


    public function saveDissolution(Request $request)
    {

        $data = new Dissolution();
        $data->name  = $request->name;
        $data->number_decision  = $request->number_decision;
        $data->date_decision  = $request->date_decision;
        $data->organ_decision  = $request->organ_decision;
        $data->id_info  = $request->id_info;
        $data->year  = $request->year;
        $data->save();

        return redirect()->back()->with('success', 'Thêm mới thành công');
    }

    public function saveExpense(Request $request)
    {

        $data = new OperatingExpenses();
        $data->name  = $request->name;
        $data->id_info  = $request->id_info;
        $data->expense1  = $request->expense1;
        $data->expense2  = $request->expense2;
        $data->expense3  = $request->expense3;
        $data->expense4  = $request->expense4;
        $data->expense5  = $request->expense5;
        $data->expense6  = $request->expense6;
        $data->save();

        return redirect()->back()->with('success', 'Thêm mới thành công');
    }


    public function saveTotalCost(Request $request)
    {

        $data = new TotalCost();
        $data->name  = $request->name;
        $data->id_info  = $request->id_info;
        $data->cost1  = $request->cost1;
        $data->cost2  = $request->cost2;
        $data->cost3  = $request->cost3;
        $data->cost4  = $request->cost4;
        $data->cost5  = $request->cost5;
        $data->cost6  = $request->cost6;
        $data->save();

        return redirect()->back()->with('success', 'Thêm mới thành công');
    }

    public function saveFacility(Request $request)
    {

        $data = new Facilities();
        $data->name  = $request->name;
        $data->id_info  = $request->id_info;
        $data->number  = $request->number;
        $data->total_money  = $request->total_money;
        $data->status  = $request->status;
        $data->source1  = $request->source1;
        $data->source2  = $request->source2;
        $data->value_current  = $request->value_current;
        $data->save();

        return redirect()->back()->with('success', 'Thêm mới thành công');
    }
}
