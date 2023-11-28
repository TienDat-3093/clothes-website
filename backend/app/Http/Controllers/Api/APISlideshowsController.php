<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slideshows;
use Illuminate\Http\Request;

class APISlideshowsController extends Controller
{
    public function index()
    {
        $slideshows = Slideshows::get();
        if(empty($slideshows))
        {
            return response()->json([
                'success'=> false,
                'message' => "Không có slideshow",
            ]);
        }
        return response()->json([
            'success'=> true,
            'data' => $slideshows,
        ]);
    }
}
