<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use App\Models\ProductImages;
use Illuminate\Http\Request;

class APICategoriesController extends Controller
{
    public function index()
    {
        $listCategories = Categories::where('status_id','=',1)->get();
        if(!empty($listCategories))
        {
            return response()->json([
                'success' => true,
                'data' => $listCategories
            ]);
        }
        return response()->json([
            'success' => false,
            'massage' => "Không có loại sản phẩm"
        ]);
    }
    public function show($id){
        $listProducts = Products::where('status_id','=',1)->where('categories_id','=',$id)->get();
        $processedProducts = [];
        foreach($listProducts as $product)
        {
            $productImage = ProductImages:: where('products_id','=',$product->id)->first();
            $processedProducts[]=[
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'star_avg'=> $product->star_avg,
                'url' => $productImage ? $productImage->url : null,
            ];
        }
        
        if(!empty($processedProducts))
        {
            return response()->json([
                'success' => true,
                'data' => $processedProducts
            ]);
        }
        return response()->json([
            'success' => false,
            'massage' => "Không có loại sản phẩm"
        ]);

    }
}
