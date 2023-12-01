<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
            $username = Auth::user()->name;
            return $username;
        }
    }
}
