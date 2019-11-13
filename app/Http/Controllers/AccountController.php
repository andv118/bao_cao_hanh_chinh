<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infomation;
use App\Models\Users;
use App\Models\Streets;
use Hash;
use DB;
use Auth;
use Mail;

class AccountController extends Controller
{   
    /**
     * Lấy toàn bộ account
     */
    public function getAllAccount(){
        $data = Users::all();
        $data2 = Streets::join('users','users.id_street','=','streets.id')->paginate(20);
        $data3 = Streets::all();
        return view('taikhoan/detail',compact('data','data2','data3'));
      }
}
