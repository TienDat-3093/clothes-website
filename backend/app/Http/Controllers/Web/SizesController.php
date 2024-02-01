<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Sizes;
use Illuminate\Http\Request;

class SizesController extends Controller
{
    public function index()
    {
        $listSizes = Sizes::all();
        return view('size/index', compact('listSizes'));
    }
    public function create(Request $request)
    {
        $size = new Sizes();
        $size->name = $request->name;
        $size->save();
        $listSizes = Sizes::all();
        return view('size/results', compact('listSizes'));
    }
    public function update($id)
    {
        $size = Sizes::find($id);
        return response()->json(['data' => $size]);
    }
    public function updateHandle(Request $request, $id)
    {
        $size = Sizes::find($id);
        if (!empty($size)) {
            $size->name = $request->name;
            $size->save();
        }
        $listSizes = Sizes::all();
        return view('size/results', compact('listSizes'));
    }
}
