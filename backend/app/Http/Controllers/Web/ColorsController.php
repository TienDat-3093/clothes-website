<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Colors;
use Illuminate\Http\Request;

class ColorsController extends Controller
{
    public function index()
    {
        $listColors = Colors::all();
        return view('color/index', compact('listColors'));
    }
    public function create(Request $request)
    {
        $color = new Colors();
        $color->name = $request->name;
        $color->save();
        $listColors = Colors::all();
        return view('color/results', compact('listColors'));
    }
    public function update($id)
    {
        $color = Colors::find($id);
        return response()->json(['data' => $color]);
    }
    public function updateHandle(Request $request, $id)
    {
        $color = Colors::find($id);
        if (!empty($color)) {
            $color->name = $request->name;
            $color->save();
        }
        $listColors = Colors::all();
        return view('color/results', compact('listColors'));
    }
}
