<?php

namespace App\Http\Controllers\API;

use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APIUsersController extends Controller
{
    public function Edit(){
        $request = request(['id','username','fullname','email']);
        $keys = array_keys($request);
        $values = array_values($request);
        $user = Users::where('id',$request['id'])->first();
        if ($user) {
            $user->{$keys[1]} = $values[1];
            $user->save();
        }else{
            return response()->json(['error'=>'Unable to find user']);
        }
        return response()->json(['message'=>'Edited '.$keys[1]]);
    }
    public function getUser()
    {
        $user = Auth::user();
        if ($user->status_id === 2) {
            Auth::logout();
            return response()->json(['error' => 'Tài khoản đã bị khóa bởi admin!'], 401);
        }
        return response()->json(['user' => $user]);
    }
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Sai mật khẩu, email hoặc không có tài khoản này!'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
