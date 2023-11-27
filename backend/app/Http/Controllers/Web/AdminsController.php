<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }
    public function login()
    {
        return view('login');
    }
    public function loginHandle(Request $request)
    {
        
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect()->route('admin.dashboard');
            
        }
        return redirect()->route('admin.login')->with('thong-bao','Sai thong tin!');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
