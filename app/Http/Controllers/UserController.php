<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Users;
use App\Models\Streets;
use Hash;
use Session;
use Auth;

class UserController extends Controller
{
   public function getLogin(){
      return view('login');
   }

   public function khaosat(){
      return view('khaosat');
   }

   public function updateProfile(Request $req){
    $id = $req->id;

   $data = Users::where('users.code',$id)->update(['users.name'=>$req->fullname,'users.email'=>$req->email,'users.phone'=>$req->phone]);
   return redirect()->back()->with("success","Cập nhật thông tin cá nhân thành công !");
   }

   public function update_account(Request $req){
    Users::where('users.code',$req->id)->update(['users.id_street'=>$req->street,'users.role'=>$req->role]);
    return redirect()->back();
  }

   public function changePass(Request $request){
      

          if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
              // The passwords matches
              return redirect()->back()->with("error","Mật khẩu nhập không khớp với mật khẩu cũ.Xin nhập lại !");
          }
          if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
              //Current password and new password are same
              return redirect()->back()->with("error","Mật khẩu mới không thể trùng với mật khẩu cũ. Hãy nhập lại mật khẩu khác !");
          }
          $validatedData = $request->validate([
              'current-password' => 'required',
              'new-password' => 'required|string|min:6|confirmed',
          ]);
          //Change Password
          $user = Auth::user();
          $user->password = bcrypt($request->get('new-password'));
          $user->save();
          return redirect()->back()->with("success","Đổi mật khẩu thành công !");
      
   }

    public function login(Request $request){
      $this->validate($request,[
            'email'=>'required',
            'password'=>'required|min:5|max:20'
        ],
        [
           
            'password.min'=>'Mật khẩu tối đa 5 ký tự',
            'password.max'=>'Mật khẩu không quá 20 ký tự'
        ]);

        $check = array('email'=>$request->email,'password'=>$request->password);
        $check2 = array('code'=>$request->email,'password'=>$request->password);

        if(Auth::attempt($check)||Auth::attempt($check2)){
         //   $data = users::where('email',$request->email)->first();
             Session::put('userid',Auth::user()->id);
             Session::put('username',Auth::user()->name);
             Session::put('usercode',Auth::user()->code);
             Session::put('userrole',Auth::user()->role);
            if(Auth::user()->role==2){

                return redirect()->route('userview');
            }else{
              
               return redirect()->route('admin.home');
            }
           

        }else{

           return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập thất bại. Sai tài khoản hoặc mật khẩu']);

        }   
    }

    public function SearchUser(Request $req){
        $key = $req->get('keyword');
        $filter = $req->get('filter');
        $data3 = Streets::all();
        if(isset($key)){
            $type = 1;
            $keyword = $key;
            if($req->select==1){
              $data = Users::where('code','like','%'.$key.'%')->join('streets','users.id_street','=','streets.id')->get();
              $select = $req->select;
            }elseif($req->select==2){
              $data = Users::where('name','like','%'.$key.'%')->join('streets','users.id_street','=','streets.id')->get();
               $select = $req->select;
            }elseif($req->select==3){
              $data = Users::where('email','like','%'.$key.'%')->join('streets','users.id_street','=','streets.id')->get();
               $select = $req->select;
            }elseif($req->select==4){
              $data = Users::where('phone','like','%'.$key.'%')->join('streets','users.id_street','=','streets.id')->get();
               $select = $req->select;
            }

        }elseif(isset($filter)){
            $data = Users::where('id_street',$filter)->join('streets','users.id_street','=','streets.id')->get();
            $type = 2;
            $select = $filter;
            $keyword = null;
        }
      
        return view('taikhoan/search',compact('data','data3','type','select','keyword'));
    }

    public function DeleteUser(Request $req){
        $id = $req->id;
        $data = Users::where('id',$id)->delete();
        return redirect()->back();
    }

    public function logout(){
      Auth::logout();
      Session::forget('userid');
      Session::forget('username');
      Session::forget('usercode');
      return redirect()->route('loginn');
    }
}
