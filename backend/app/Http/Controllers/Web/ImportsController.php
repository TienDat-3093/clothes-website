<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Imports;
use App\Models\ImportDetails;
use App\Models\ProductDetails;
use App\Models\Suppliers;
use App\Models\Products;
use App\Models\Colors;
use App\Models\Sizes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImportsController extends Controller
{
    public function List()
    {
        $listImport = Imports::all();
        return view('import/index', compact('listImport'));
    }
    public function Search(Request $request)
    {
        $keyword = $request->input('data');
        $supplierId = Suppliers::where('name', 'like', "%$keyword%")->pluck('id');
        $listImport = Imports::where('supplier_id', $supplierId)->get();
        return view('import/results', compact('listImport'));
    }
    public function Delete($id)
    {
        $import = Imports::where('id', $id)->get();
        $import[0]->status_id = 2;
        $import[0]->save();
        return redirect()->route('import.index')->with('alert', 'Xóa hóa đơn nhập thành công!');
    }
    public function Verify($id)
    {
        $importDetails = ImportDetails::where('imports_id', $id)->get();
        foreach ($importDetails as $detail) {
            $productDetails = ProductDetails::where('products_id', $detail->products_id)->where('colors_id', $detail->colors_id)->where('sizes_id', $detail->sizes_id)->get();
            if ($productDetails->isEmpty()) {
                $productdetail = new ProductDetails();
                $productdetail->quantity = $detail->quantity;
                $productdetail->products_id = $detail->products_id;
                $productdetail->colors_id = $detail->colors_id;
                $productdetail->sizes_id = $detail->sizes_id;
                $productdetail->save();
            } else {
                $productDetails[0]->quantity += $detail->quantity;
                $productDetails[0]->save();
            }
        }
        $import = Imports::where('id', $id)->get();
        $import[0]->status_id = 2;
        $import[0]->save();
        return redirect()->route('import.index')->with('alert', 'Duyệt hóa đơn nhập thành công!');
    }
    public function Detail($id)
    {
        $listImportDetails = ImportDetails::where('imports_id', $id)->get();
        return view('import/details', compact('listImportDetails'));
    }
    public function Create()
    {
        $listSuppliers = Suppliers::all();
        $listProducts = Products::all();
        $listColors = Colors::all();
        $listSizes = Sizes::all();
        return view('import/create', compact('listSuppliers', 'listProducts', 'listColors', 'listSizes'));
    }
    public function createHandle(Request $request)
    {
        $i = 0;
        $total = 0;
        foreach ($request->totalprice as $totalprice) {
            $total += $totalprice;
        }
        $import = new Imports();
        $import->total_price = $total;
        $import->suppliers_id = $request->supplier_id;
        $import->admins_id = Auth::user()->id;
        $import->save();
        foreach ($request->product_id as $abc) {
            $importDetail = new ImportDetails();
            $importDetail->quantity = $request->quantity[$i];
            $importDetail->price = $request->price[$i];
            $importDetail->colors_id = $request->color[$i];
            $importDetail->sizes_id = $request->size[$i];
            $importDetail->imports_id = $import->id;
            $importDetail->products_id = $request->product_id[$i];
            $importDetail->save();
            $i++;
        }
        return redirect()->route('import.index');
    }
}
