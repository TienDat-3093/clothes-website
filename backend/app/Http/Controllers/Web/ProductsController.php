<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Colors;
use App\Models\ProductDetails;
use App\Models\ProductImages;
use App\Models\Products;
use App\Models\Sizes;
use App\Models\Status;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $listProduct = Products::all();
        $productImage = ProductImages::all();
        $status = Status::all();
        return view('product/index',compact('listProduct','productImage','status'));
    }
    public function search(Request $request)
    {
        $productImage = ProductImages::all();
        $status = Status::all();
        $keyword = $request->input('data');
        $listProduct = Products::where('name', 'like', "%$keyword%")->get();
        return view('product/results', compact('listProduct','productImage'));
    }
    public function detail($id)
    {
        $product = Products::find($id);
        $productDetails = ProductDetails::find($id);
        $listColor = ProductDetails::where('products_id',$id)->distinct()->get('colors_id');
        $listSize = ProductDetails::where('products_id',$id)->distinct()->get('sizes_id');
        
        return view('product/detail',compact('product','listColor','listSize','productDetails'));
    }
    public function quantity(Request $request,$id)
    {   
        $product = Products::find($id);
        $listColor = Colors::all();
        $listSize = Sizes::all();
        $color = $request->input('color_id');
        $size = $request->input('size_id');
        $quantity = ProductDetails::where('colors_id',$color)->where('sizes_id',$size)->where('products_id',$id)->value('quantity');
        if($quantity == null)
        {
             $quantity = 0;
             return response()->json(['quantity' => $quantity]);
        }
        return response()->json(['quantity' => $quantity]);
    }
}
