<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sideshows;
use Illuminate\Http\Request;

class APISlideshowsController extends Controller
{
    public function index()
    {
        $sideshows = Sideshows::get();
        if(empty($sideshows))
        {
            return response()->json([
                'success'=> false,
                'message' => "Không có slideshow",
            ]);
        }
        return response()->json([
            'success'=> true,
            'data' => $sideshows,
        ]);
    }
}
