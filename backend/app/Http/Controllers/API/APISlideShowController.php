<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Slideshows;
use Illuminate\Http\Request;

class APISlideShowController extends Controller
{
    public function index()
    {
        $listSliders = Slideshows::where('status_id','=',1)->get();
        if(!empty($listSliders)){
            return response()->json([
                'success' => true,
                'data' => $listSliders,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Không có slideshow",
        ]);
    }
}
