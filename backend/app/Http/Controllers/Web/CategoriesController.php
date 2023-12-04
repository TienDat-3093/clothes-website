<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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

    public function createHandler(Request $re)
    {
        $categories = new Categories();

        $categories->name = $re->name;
        $categories->product_types_id = $re->product_types_id;
        $categories->status_id = 1;

        $categories->save();

        return redirect()->route('categories.index')->with('alert', 'Add Categories successfully');
    }

    public function List()
    {
        $categories = Categories::all();
        $status = Status::all();
        return view("categories.index", compact("categories", "status"));
    }

    public function Update($id)
    {
        $categories = Categories::find($id);
        $productTypes = ProductTypes::all();
        $status = Status::all();

        if (empty($categories)) {
            return "Categories doesn't exist!!!";
        }

        return view('categories.update', compact('categories', 'productTypes', 'status'));
    }

    public function updateHandler(Request $re, $id)
    {
        $categories = Categories::find($id);

        if (empty($Ccategoriesat)) {
            return "Categories doesn't exist!!!";
        }

        $categories->name = $re->name;
        $categories->product_types_id = $re->product_types_id;
        $categories->status_id = $re->status_id;

        $categories->save();

        return redirect()->route('categories.index')->with('alert', 'Update Categories successfully');
    }

    public function Delete($id)
    {
        $categories = Categories::find($id);

        if (empty($categories)) {
            return "Categories doesn't exist!!!";
        }
        if ($categories->status_id == 2) {
            return redirect()->route('categories.index')->with('alert', 'Categories already deleted');
        }
        $categories->status_id = 2;
        $categories->save();

        return redirect()->route('categories.index')->with('alert', 'Delete Categories successfully');
    }
}
