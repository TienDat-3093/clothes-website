<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdminRequest;
use App\Models\Admins;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    public function login()
    {
        return view('login');
    }
    public function loginHandle(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->with('alert', 'Access denied!');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
    public function getLoginUser()
    {
        if (Auth::check()) {
            $username = Auth::user()->username;
            return $username;
        }
    }
    public function index()
    {
        $listAdmin=Admins::all();
        return view('admin/index',compact('listAdmin'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('data');
        $listAdmin = Admins::where('username', 'like', "%$keyword%")->get();
        return view('admin/results', compact('listAdmin'));
    }
    public function create()
    {
        return view('admin/create');
    }
    public function createHandle(CreateAdminRequest $request)
    {
        $admin = new Admins();
        $admin->username = $request->username;
        $admin->fullname = $request->fullname;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->phone_number = $request->phone_number;
        $admin->save();
        return redirect()->route('admin.index')->with('alert', 'Thêm tài khoản admin thành công');
    }
    public function update($id)
    {
        $admin = Admins::find($id);
        return view('admin/update', compact('admin'));
    }
    public function updateHandle(CreateAdminRequest $request, $id)
    {
        $admin = Admins::find($id);
        if (empty($admin)) {
            return redirect()->route('admin.index')->with('alert', 'Tài khoản admin không tồn tại');
        }
        $admin->username = $request->username;
        $admin->fullname = $request->fullname;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->phone_number = $request->phone_number;
        $admin->save();

        return redirect()->route('admin.index')->with('alert', 'Cập nhật tài khoản admin thành công');
    }
    public function delete($id)
    {
        $admin = Admins::find($id);
        if($admin->status_id == 2)
        {
            return redirect()->route('admin.index')->with('alert', 'Tài khoản admin đã được khóa rồi');
        }
        $admin->status_id = 2;
        $admin->save();
        return redirect()->route('admin.index')->with('alert', 'Khóa tài khoản admin thành công');
    }
}
