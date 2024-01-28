<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoriesRequest;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\ProductTypes;
use App\Models\Status;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Imports\CategoriesImport;
use App\Exports\CategoriesExport;
use Maatwebsite\Excel\Facades\Excel;

class CategoriesController extends Controller
{
    public function Create()
    {
        $categories = Categories::all();
        $productTypes = ProductTypes::all();

        return view("categories.create", compact("categories", "productTypes"));
    }

    public function createHandler(CreateCategoriesRequest $re)
    {
        $categories = new Categories();

        $categories->name = $re->name;
        $categories->product_types_id = $re->product_types_id;
        $categories->status_id = 1;

        $categories->save();

        return redirect()->route('categories.index')->with('alert', 'Thêm danh mục loại sản phẩm thành công');
    }

    public function List()
    {
        $listCategories = Categories::all();
        return view("categories.index", compact("listCategories"));
    }

    public function Search(Request $re)
    {
        $keyword = $re->input('data');
        $listCategories = Categories::where('name', 'like', "%$keyword%")->get();

        return view('categories.search', compact('listCategories'));
    }

    public function Update($id)
    {
        $categories = Categories::find($id);
        $productTypes = ProductTypes::all();
        $status = Status::all();

        if (empty($categories)) {
            return redirect()->route('categories.index')->with("alert", "Danh mục loại sản phẩm không tồn tại");
        }

        return view('categories.update', compact('categories', 'productTypes', 'status'));
    }

    public function updateHandler(CreateCategoriesRequest $re, $id)
    {
        $categories = Categories::find($id);

        if (empty($categories)) {
            return redirect()->route('categories.index')->with("alert", "Danh mục loại sản phẩm không tồn tại");
        }

        $categories->name = $re->name;
        $categories->product_types_id = $re->product_types_id;
        $categories->status_id = $re->status_id;

        $categories->save();

        return redirect()->route('categories.index')->with('alert', 'Cập nhật danh mục loại sản phẩm thành công');
    }

    public function Delete($id)
    {
        $categories = Categories::find($id);

        if (empty($categories)) {
            return redirect()->route('categories.index')->with("alert", "Danh mục loại sản phẩm không tồn tại");
        }
        if ($categories->status_id == 2) {
            return redirect()->route('categories.index')->with('alert', 'Danh mục sản phẩm đã xóa trước đó rồi');
        }
        $categories->status_id = 2;
        $categories->save();

        return redirect()->route('categories.index')->with('alert', 'Xóa danh mục loại sản phẩm thành công');
    }

    public function ViewPDF()
    {
        $data = Categories::all();
        $pdf = PDF::loadView('categories.pdf',  compact('data'));
        return $pdf->stream('Categories.pdf');
    }

    public function ImportExcel(Request $re)
    {
        // $re->validate([
        //     'import_file' => ['require', 'file'],
        // ]);

        Excel::import(new CategoriesImport, $re->file('import_file'));

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

        $filename = "Categories-" . date('d-m-Y') . "." . $files;
        return Excel::download(new CategoriesExport, $filename, $format);
    }
}
