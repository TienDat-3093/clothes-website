<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Imports;
use App\Models\ImportDetails;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class ImportsController extends Controller
{
    public function List()
    {
        $listImport=Imports::all();
        return view('import/index',compact('listImport'));
    }
    public function Search(Request $request)
    {
        $keyword = $request->input('data');
        $supplierId = Supplier::where('name', 'like', "%$keyword%")->pluck('id');
        $listImport = Imports::whereIn('supplier_id', $supplierId)->get();
        return view('import/results', compact('listImport'));
    }
    public function Delete($id)
    {
        // $import = Imports::find($id);
        // if($import->status_id == 2)
        // {
        //     $import->status_id = 1;
        //     $import->save();
        //     return redirect()->route('import.index')->with('alert', 'Mở khóa tài khoản import thành công');
        // }
        // $import->status_id = 2;
        // $import->save();
        return redirect()->route('import.index');
    }
    public function Detail($id){
        $listImportDetails = ImportDetails::where('imports_id',$id)->get();
        return view('import/details', compact('listImportDetails'));
    }
}
