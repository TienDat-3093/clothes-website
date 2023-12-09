<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSuppliersRequest;
use App\Models\Suppliers;
use App\Models\Status;
use App\Models\StatusUsers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index()
    {
        $listSupplier = Suppliers::all();
        $status = StatusUsers::all();
        return view('supplier/index', compact('listSupplier', 'status'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('data');
        $listSupplier = Suppliers::where('name', 'like', "%$keyword%")->get();
        return view('supplier/results', compact('listSupplier'));
    }
    public function create()
    {
        return view('supplier/create');
    }
    public function createHandle(CreateSuppliersRequest $request)
    {
        $supplier = new Suppliers();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone_number = $request->phone_number;
        $supplier->address = $request->address;
        $supplier->save();
        return redirect()->route('supplier.index')->with('alert', 'Thêm nhà cung cấp thành công');
    }
    public function update($id)
    {
        $supplier = Suppliers::find($id);
        return view('supplier/update', compact('supplier'));
    }
    public function updateHandle(CreateSuppliersRequest $request, $id)
    {
        $supplier = Suppliers::find($id);
        if (empty($supplier)) {
            return redirect()->route('supplier.index')->with('alert', 'Nhà cung cấp không tồn tại');
        }
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone_number = $request->phone_number;
        $supplier->address = $request->address;
        $supplier->save();

        return redirect()->route('supplier.index')->with('alert', 'Cập nhật nhà cung cấp thành công');
    }
    public function delete($id)
    {
        $supplier = Suppliers::find($id);
        if($supplier->status_id == 2)
        {
            return redirect()->route('supplier.index')->with('alert', 'Nhà cung cấp không tồn tại');
        }
        $supplier->status_id = 2;
        $supplier->save();
        return redirect()->route('supplier.index')->with('alert', 'Xóa nhà cung cấp thành công');
    }
}
