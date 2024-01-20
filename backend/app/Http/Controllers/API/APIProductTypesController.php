<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductTypes;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class APIProductTypesController extends Controller
{
    public function index()
    {
        $listProductType = ProductTypes::where('status_id', '=', 1)->get();
        if (!empty($listProductType)) {
            return response()->json([
                'success' => true,
                'data' => $listProductType,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Không có loại sản phẩm",
        ]);
    }
    public function show($id)
    {
        $listCategories = Categories::where('product_types_id', '=', $id)->where('status_id', '=', 1)->get();
        $listProducts = [];
        if (!empty($listCategories)) {
            foreach ($listCategories as $category) {
                $product = Products::where('categories_id', '=', $category->id)->where('status_id', '=', 1)->get();
                $listProducts[] = [
                    'categoryID' => $category->id,
                    'categoryName' => $category->name,
                    'product' => $product
                ];
            }
        }
        if (!empty($listProducts)) {
            return response()->json([
                'success' => true,
                'data' => $listProducts,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Không có sản phẩm',
            ]);
        }
    }
}
