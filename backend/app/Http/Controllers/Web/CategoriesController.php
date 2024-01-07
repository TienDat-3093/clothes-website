<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoriesRequest;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\ProductTypes;
use App\Models\Status;

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
        $status = Status::all();
        return view("categories.index", compact("listCategories", "status"));
    }

    public function Search(Request $re){
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
}
