<?php

namespace App\Http\Controllers\API;

use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class APIUsersController extends Controller
{
    public function Edit(){
        $request = request(['id','username','fullname','email','password','current_password','phone_number']);
        $keys = array_keys($request);
        $values = array_values($request);
        $user = Users::where('id',$request['id'])->first();
        if ($user) {
            if($keys[1] == 'password')
            {
                if (password_verify($values[2], $user->password))
                    if($values[2] == $values[1])
                        return response()->json(['message'=>'New password is the same as current password']);
                    else
                        $user->{$keys[1]} = Hash::make($values[1]);
                else
                    return response()->json(['message'=>'Current password is not correct']);
            }
            else
            {
                if($values[1] == $user->{$keys[1]})
                    return response()->json(['message'=>'New '.$keys[1].' is the same as current '.$keys[1]]);
                $user->{$keys[1]} = $values[1];
            }
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
            return response()->json(['message' => 'Tài khoản đã bị khóa bởi admin!'], 401);
        }
        return response()->json(['user' => $user]);
    }
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['message' => 'Sai mật khẩu, email hoặc không có tài khoản này!'], 401);
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
