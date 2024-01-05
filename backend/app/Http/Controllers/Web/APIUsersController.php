<?php

namespace App\Http\Controllers\Web;

use App\Models\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APIUsersController extends Controller
{
    public function testFunction()
    {
        return response()->json([
            'message' => "tested"
        ]);
    }
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
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
