<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Streets;
use App\Models\UserPermission;
use Hash;
use DB;
use Auth;
use Mail;

class AccountController extends Controller
{
    /******************************* Người dùng ************************************/

    /**
     * Lấy toàn bộ account
     */
    public function getAllAccount()
    {
        $users = Users::join('user_permission', 'users.role', '=', 'user_permission.level')
            ->select('users.*', 'user_permission.name as cap_quan_ly')
            ->paginate(20);

        // dd($users);
        $role = UserPermission::all();

        $data2 = Streets::join('users', 'users.id_hanhchinh', '=', 'streets.id')->paginate(20);
        $data3 = Streets::all();
        return view('taikhoan/detail', compact('users', 'role', 'data2', 'data3'));
    }

    /**
     * Thêm mới người dùng
     * @param
     * @return
     */
    public function createUsers()
    {
        $role = UserPermission::all();
        return view('taikhoan/create', compact('role'));
    }

    /**
     * Đăng ký mới người dùng
     * @param
     * @return
     */
    public function registerUsers(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'password' => 'required',
                'repassword' => 'required',
                'dvquanly' => 'required',
            ],
            [
                'name.required' => 'Hãy nhập tên cán bộ',
                'phone.required' => 'Hãy nhập số điện thoại',
                'email.required' => 'Hãy nhập email',
                'password.required' => 'Hãy nhập mật khẩu',
                'repassword.required' => 'Hãy nhập lại mật khẩu',
                'dvquanly.required' => 'Hãy nhập đơn vị quản lý',
            ]
        );

        $error = array();
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $password = $request->password;
        $repassword = $request->repassword;
        $dvquanly = $request->dvquanly;
        $role = (int) $request->role;

        // check error
        if ($password != $repassword) {
            array_push($error, 'Nhập lại mật khẩu không đúng');
        }
        if ($role == 0) {
            array_push($error, 'Hãy chọn quyền hạn');
        }

        if (sizeof($error) > 0) {
            return redirect()->back()->with('error', $error);
        }

        $arrInsert = array(
            'name'     => $name,
            'phone'    => $phone,
            'email'    => $email,
            'password' => Hash::make($password),
            'don_vi_quan_ly' => $dvquanly,
            'role'     => $role,
            'token'     => 1,
        );

        // dd($arrInsert);

        Users::insert($arrInsert);

        return redirect()->back()->with('success', 'Thêm mới người dùng thành công');
    }

    /**
     * Cập nhật người dùng
     * @param request
     * @return
     */
    public function updateUser(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'dvquanly' => 'required',
            ],
            [
                'name.required' => 'Hãy nhập tên cán bộ',
                'phone.required' => 'Hãy nhập số điện thoại',
                'email.required' => 'Hãy nhập email',
                'dvquanly.required' => 'Hãy nhập đơn vị quản lý',
            ]
        );

        $id = $request->id;
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $dvquanly = $request->dvquanly;
        $role = (int) $request->role;
        if (trim($phone) == '') {
            $phone = null;
        }

        $arrUpdate = array(
            'name'     => $name,
            'phone'    => $phone,
            'email'    => $email,
            'don_vi_quan_ly' => $dvquanly,
            'role'     => $role,
        );
        // dd($arrUpdate);

        Users::where('id', $id)
        ->update($arrUpdate);
        return redirect()->back()->with('success', 'Cập nhật người dùng thành công');
    }

    /**
     * Xóa người dùng
     * @param request
     * @return
     */
    public function deleteUser(Request $request)
    {
        $id = $request->id;
        Users::where('id', $id)
            ->delete();

        return redirect()->back();
    }


    /******************************* Nhóm người dùng ************************************/
    /**
     * Lấy toàn bộ nhóm người dùng
     * @param
     * @return view
     */
    public function getAllGroupAccount()
    {
        $data = UserPermission::paginate(10);
        return view('taikhoan/list-user', compact('data'));
    }

    /**
     * Thêm mới nhóm người dùng
     * @param
     * @return
     */
    public function createGroupUsers()
    {
        $data = Streets::all();
        return view('taikhoan/create-list-user', compact('data'));
    }

    /**
     * Đăng ký mới nhóm người dùng
     * @param
     * @return
     */
    public function registerGroupUser(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'level' => 'required|unique:user_permission',
            ],
            [
                'name.required' => 'Hãy nhập tên tác nhân',
                'level.required' => 'Hãy chọn cấp quản lý',
                'level.unique'  => 'Cấp quản lý đã tồn tại',
            ]
        );

        $name = $request->name;
        $description = $request->description;
        if (trim($description) == '') {
            $description = null;
        }
        $level = $request->level;

        $arrInsert = array(
            'name' => $name,
            'description' => $description,
            'level' => (int) $level,
        );
        // dd($arrInsert);
        UserPermission::insert($arrInsert);

        return redirect()->back()->with('success', 'Thêm mới nhóm người dùng thành công');
    }

    /**
     * Xóa nhóm người dùng
     * @param request
     * @return
     */
    public function deleteGroupUser(Request $request)
    {
        $id = $request->id;
        UserPermission::where('id', $id)
            ->delete();

        return redirect()->back();
    }

    /**
     * Cập nhật nhóm người dùng
     * @param request
     * @return
     */
    public function updateGroupUser(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Hãy nhập tên tác nhân',
                'level.unique'  => 'Cấp quản lý đã tồn tại',
            ]
        );

        $id = $request->id;
        $name = $request->name;
        $description = $request->description;
        if (trim($description) == '') {
            $description = null;
        }
        $level = $request->level;

        $arrUpdate = array(
            'name' => $name,
            'description' => $description,
            'level' => (int) $level,
        );
        // dd($arrUpdate);

        $arrLevel = UserPermission::selectRaw('count(*) as count')
            ->where([
                ['id', '!=', $id],
                ['level', '=', $level]
            ])
            ->get();
        foreach ($arrLevel as $v) {
            if ($v->count == 0) {
                UserPermission::where('id', $id)
                    ->update($arrUpdate);
            } else {
                return redirect()->back()->with('loi', 'Cấp quản lý đã tồn tại');
            }
        }
        return redirect()->back()->with('success', 'Cập nhật nhóm người dùng thành công');
    }
}
