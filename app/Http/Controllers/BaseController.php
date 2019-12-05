<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Infomation;
use App\Models\Users;
use App\Models\Streets;
use Session;
use Hash;
use DB;
use Auth;
use Mail;

class BaseController extends Controller
{








  







    public function home()
    {
        $data = Infomation::all();
        $total = count($data);
        return view('trangchu', compact('total'));
    }

    public function userview(Request $request)
    {

        if (isset($request->param)) {
            $keyword = $request->param;
            $data = Infomation::where('TenTiengViet', 'like', '%' . $keyword . '%')->orWhere('TenTiengAnh', 'like', '%' . $keyword . '%')->get();
        } else {
            $data = Infomation::paginate(50);
        }
        return view('index', ['data' => $data]);
    }

    public function AjaxSearch(Request $request)
    {

        if (isset($request->data)) {
            $arr = [];
            $keyword = $request->data;
            $data = Infomation::where('TenTiengViet', 'like', '%' . $keyword . '%')
                ->orWhere('TenTiengAnh', 'like', '%' . $keyword . '%')->limit(20)->get()->toArray();
            foreach ($data as $val) {
                array_push($arr, $val['TenTiengViet']);
            }
            // return response()->json($data, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
            return $arr;
        }
    }

    public function config()
    {
        $data = Landcost::join('streets', 'land_cost.id_street', '=', 'streets.id')->paginate(10);
        $data2 = Streets::all();
        $data3 = Interest::all();
        $data4 = Currency::all();
        $data5 = Houseprices::join('type_house', 'type_house.id', '=', 'house_prices.id_house')->paginate(10);
        $data6 = Typehouse::all();
        $data7 = Signature::all()->toArray();
        return view('cauhinh/config', compact('data', 'data2', 'data3', 'data4', 'data5', 'data6', 'data7'));
    }


    public function update_signature(Request $req)
    {
        if (isset($req->id)) {
            Signature::where('id', $req->id)->update(['name' => $req->name]);
            return redirect()->back()->with('message', 'Cập nhật chữ ký người đại diện thành công');
        }

        return redirect()->back();
    }

    public function profile()
    {
        $id = Session::get('userid');
        $data = Users::join('streets', 'users.id_street', '=', 'streets.id')->where('users.id', $id)->get();
        $data2 = Streets::get();
        return view('profile/profile', compact('data', 'data2'));
    }

    public function history()
    {
        $data = Diary::paginate(30);
        return view('lichsu/history', compact('data'));
    }

    public function insert_landcost(Request $req)
    {
        $landcost = new Landcost();
        $landcost->name_street = $req->name;
        $landcost->from = $req->from;
        $landcost->to = $req->to;
        $landcost->id_street = $req->street;
        $landcost->VT1 = $req->vt1;
        $landcost->VT2 = $req->vt2;
        $landcost->VT3 = $req->vt3;
        $landcost->VT4 = $req->vt4;
        $landcost->save();
        return redirect()->back();
    }

    public function insert_houseprice(Request $req)
    {
        $house = new Houseprices();
        $house->id_house = $req->house;
        $house->price = $req->price;
        $house->floor_from = $req->floor_from;
        $house->floor_to = $req->floor_to;
        $house->save();
        return redirect()->back();
    }


    public function insert_currency(Request $req)
    {
        $currency = new Currency();
        $currency->name = $req->unit;
        $currency->price = $req->price;
        $currency->save();
        return redirect()->back();
    }

    public function update_landcost(Request $req)
    {
        $landcost = Landcost::where('id', $req->id)->update([
            'name_street' => $req->name, 'from' => $req->from, 'to' => $req->to,
            'id_street' => $req->street, 'VT1' => $req->vt1, 'VT2' => $req->vt2, 'VT3' => $req->vt3, 'VT4' => $req->vt4
        ]);
        return redirect()->back();
    }

    public function update_currency(Request $req)
    {
        $currency = Currency::where('id', $req->id)->update(['price' => $req->price]);
        return redirect()->back();
    }

    public function update_pricehouse(Request $req)
    {
        $price = Houseprices::where('id', $req->id)->update(['price' => $req->price]);
        return redirect()->back();
    }

    public function update_interest(Request $req)
    {
        $rate = Interest::where('id', $req->id)->update(['rate' => $req->rate / 100]);
        return redirect()->back();
    }

    public function users()
    {
        $data = Users::all();
        $data2 = Streets::join('users', 'users.id_street', '=', 'streets.id')->paginate(20);
        $data3 = Streets::all();
        return view('taikhoan/detail', compact('data', 'data2', 'data3'));
    }

    public function create_users()
    {
        $data = Streets::all();
        return view('taikhoan/create', compact('data'));
    }

    public function register(Request $req)
    {
        $this->validate(
            $req,
            [
                'email' => 'email|unique:users,email',
                'password' => 'required|min:6|max:20',
                'name' => 'required',
                'repassword' => 'required|same:password',
                'role' => 'required',
                'streets' => 'required'
            ],
            [
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã thuộc về 1 tài khoản',
                'name.required' => 'Hãy nhập tên cán bộ',
                'password.min' => 'Mật khẩu tối đa 6 ký tự',
                'password.max' => 'Mật khẩu không quá 20 ký tự',
                'password.required' => 'Mật khẩu không không được để trống',
                'repassword.same' => 'Mật khẩu không khớp',
                'repassword.required' => 'Hãy nhập lại mật khẩu',
                'streets.required' => 'Hãy chọn phường quản lý',
                'role.required' => 'Hãy chọn quyền'
            ]
        );


        $query =  Users::orderBy('base', 'desc')->take(1)->get();
        $base = $query[0]['base'] + 1;
        $key = array('TTHHN000', $base);
        $code = implode($key);
        $user = new Users();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->role = $req->role;
        $user->token = 1;
        $user->base = $base;
        $user->code = $code;
        $user->password = bcrypt($req->password);
        $user->id_street = $req->streets;
        $user->save();

        return redirect()->back()->with('thanhcong', 'Tạo tài khoản thành công');
    }
}
