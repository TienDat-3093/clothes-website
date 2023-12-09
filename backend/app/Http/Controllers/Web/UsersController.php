<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function List()
    {
        $listUser=Users::all();
        return view('user/index',compact('listUser'));
    }
    public function Search(Request $request)
    {
        $keyword = $request->input('data');
        $listUser = Users::where('username', 'like', "%$keyword%")->get();
        return view('user/results', compact('listUser'));
    }
    public function Delete($id)
    {
        $user = Users::find($id);
        if($user->status_id == 2)
        {
            $user->status_id = 1;
            $user->save();
            return redirect()->route('user.index')->with('alert', 'Mở khóa tài khoản user thành công');
        }
        $user->status_id = 2;
        $user->save();
        return redirect()->route('user.index')->with('alert', 'Khóa tài khoản user thành công');
    }
}
