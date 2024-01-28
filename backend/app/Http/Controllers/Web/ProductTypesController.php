<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductTypes;
use App\Models\Status;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use App\Http\Requests\CreateProductTypesRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Imports\ProductTypesImport;
use App\Exports\ProductTypesExport;
use Maatwebsite\Excel\Facades\Excel;


class ProductTypesController extends Controller
{
    public function Create()
    {
        $PDT = ProductTypes::all();
        return view('product_types.create', compact('PDT'));
    }

    public function createHandler(CreateProductTypesRequest $re)
    {
        $PDT = new ProductTypes();

        $PDT->name = $re->name;

        $PDT->save();

        return redirect()->route('product-types.index')->with('alert', 'Thêm loại sản phẩm thành công');
    }

    public function List()
    {
        $listProductTypes = ProductTypes::all();
        return view('product_types.index', compact('listProductTypes'));
    }
    public function Search(Request $re)
    {
        $keyword = $re->input('data');
        $listProductTypes = ProductTypes::where('name', 'like', "%$keyword%")->get();

        return view('product_types.search', compact('listProductTypes'));
    }
    public function Update($id)
    {
        $PDT = ProductTypes::find($id);
        $STT = Status::all();

        if (empty($PDT)) {
            return redirect()->route('product-types.index')->with("alert", "Loại sản phẩm không tồn tại");
        }
        return view('product_types.update', compact('PDT', 'STT'));
    }

    public function updateHandler(CreateProductTypesRequest $re, $id)
    {
        $PDT = ProductTypes::find($id);

        if (empty($PDT)) {
            return redirect()->route('product-types.index')->with("alert", "Loại sản phẩm không tồn tại");
        }

        $PDT->name = $re->name;
        $PDT->status_id = $re->status_id;
        $PDT->save();

        return redirect()->route('product-types.index')->with('alert', 'Cập nhật loại sản phẩm thành công');
    }

    public function Delete($id)
    {
        $PDT = ProductTypes::find($id);

        if (empty($PDT)) {
            return redirect()->route('product-types.index')->with('alert', "Loại sản phẩm không tồn tại");
        }

        if ($PDT->status_id == 2) {
            return redirect()->route('product-types.index')->with('alert', 'Loại sản phẩm đã xóa trước đó rồi');
        }
        $PDT->status_id = 2;
        $PDT->save();

        return redirect()->route('product-types.index')->with('alert', 'Xóa loại sản phẩm thành công');
    }

    public function ViewPDF()
    {
        $data = ProductTypes::all();
        $pdf = PDF::loadView('product_types.pdf',  compact('data'));
        return $pdf->stream('Product Types.pdf');
    }
    public function ImportExcel(Request $re)
    {
        // $re->validate([
        //     'import_file' => ['require', 'file'],
        // ]);

        Excel::import(new ProductTypesImport, $re->file('import_file'));

        return redirect()->back()->with('alert', "Import successfully");
    }
    public function ExportExcel(Request $re)
    {
        if ($re->type == 'xlsx') {

            $files = 'xlsx';
            $format = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($re->type == 'csv') {

            $files = 'csv';
            $format = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($re->type == 'xls') {

            $files = 'xls';
            $format = \Maatwebsite\Excel\Excel::XLS;
        } elseif ($re->type == 'html') {

            $files = 'html';
            $format = \Maatwebsite\Excel\Excel::HTML;
        } else {

            $files = 'xlsx';
            $format = \Maatwebsite\Excel\Excel::XLSX;
        }

        $filename = "ProductTypes-" . date('d-m-Y') . "." . $files;
        return Excel::download(new ProductTypesExport, $filename, $format);
    }
}
