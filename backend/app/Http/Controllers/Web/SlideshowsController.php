<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Slideshows;
use Illuminate\Http\Request;

class SlideshowsController extends Controller
{
    public function index()
    {
        
        return view('',compact(''));
    }

    public function create()
    {
        $slideshows = Slideshows::all();
    }
}
