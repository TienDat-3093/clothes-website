<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admins;
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
    public function loginHandle(Request $request)
    {
        
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect()->route('admin.dashboard');
            
        }
        return redirect()->route('admin.login')->with('alert','Access denied!');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
    public function Index()
    {
        $listAdmin=Admins::all();
        // dd($listAdmin);
        return view('admin/index',compact('listAdmin'));
    }
}
