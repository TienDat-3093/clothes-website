<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\ProductImages;
use App\Models\ProductDetails;
use App\Models\Colors;
use App\Models\Sizes;
use Illuminate\Http\Request;

class APIProductsController extends Controller
{
    public function index()
    {
        $listProduct = Products::where('status_id','=',1)->get();
        $processedProducts = [];
        foreach ($listProduct as $product) {
            $productID = $product->id;
            $productImage = ProductImages::where('products_id', $productID)->first();

            $processedProducts[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'star_avg'=> $product->star_avg,
                'url' => $productImage ? $productImage->url : null,
            ];
        }
        if (!empty($processedProducts)) {
            return response()->json([
                'success' => true,
                'data' => $processedProducts,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Không có sản phẩm',
        ]);
    }
    public function show($id)
    {
        $product = Products::find($id);

        $productDetails = ProductDetails::where('products_id', $id)->get();
        $productImage = ProductImages::where('products_id', $id)->get();
        $processedProducts = [];

        $processedDetail = [];
        if (!empty($productDetails)) {
            foreach ($productDetails as $detail) {
                $colors = Colors::where('id', $detail->colors_id)->get();
                $sizers = Sizes::where('id', $detail->sizes_id)->get();
                $processedDetail[] = [
                    'detailID' => $detail->id,
                    'quantity' => $detail->quantity,
                    'color' => $colors,
                    'size' => $sizers,
                ];
            };
        }
        $processedProducts[] = [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'star_avg' => $product->star_avg,
            'img' => $productImage,
            'detail' => $processedDetail,

        ];

        if (!empty($processedProducts)) {
            return response()->json([
                'success' => true,
                'data' => $processedProducts,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Không có sản phẩm',
        ]);
    }

    

   
}
