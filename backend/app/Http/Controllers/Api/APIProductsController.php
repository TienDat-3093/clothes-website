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
        $listProduct = Products::where('status_id', '=', 1)->get();
        $processedProducts = [];
        foreach ($listProduct as $product) {
            $productID = $product->id;
            $productImage = ProductImages::where('products_id', $productID)->first();

            $processedProducts[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'star_avg' => $product->star_avg,
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
    public function search($keyword)
    {
        if (!empty($keyword)) {
            $listProduct = Products::where('name', 'like', "%$keyword%")->where('status_id', '=', 1)->get();
            $processedProducts = [];
            foreach ($listProduct as $product) {
                $productImage = ProductImages::where('products_id', $product->id)->first();
                $processedProducts[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'star_avg' => $product->star_avg,
                    'url' => $productImage ? $productImage->url : null,
                ];
            }
        }

        if (!empty($processedProducts)) {
            return response()->json([
                'success' => true,
                'data' => $processedProducts,
            ]);
        }
        return response()->json([
            'success' => false,
            'data' => "Không có sản phẩm nào",
        ]);
    }
    public function filter($sort, $price)
    {
        $query = Products::query();
        if (!empty($sort)) {
            switch ($sort) {
                case 1:
                    $query->orderBy('price', 'asc');
                    break;
                case 2:
                    $query->orderBy('price', 'desc');
                    break;
                case 3:
                    $query->orderBy('star_avg', 'desc');
                    break;
                case 4:
                    $query->orderBy('created_ad', 'desc');
                    break;
                case 5:
                    $query->orderBy('created_ad', 'desc');
                    break;
            }
        }
        if (!empty($price)) {
            switch ($price) {
                case 1:
                    $query->whereBetween('price', [0.00, 50.00]);
                    break;
                case 2:
                    $query->whereBetween('price', [50.00, 100.00]);
                    break;
                case 3:
                    $query->whereBetween('price', [100.00, 150.00]);
                    break;
                case 4:
                    $query->whereBetween('price', [150.00, 200.00]);
                    break;
                case 5:
                    $query->where('price', '>', 200.00);
                    break;
                case 6:
                    $query->where('price', '>', 0);
                    break;
            }
        }

        $listProduct = $query->get();
        if (!empty($listProduct)) {
            $processedProducts = [];
            foreach ($listProduct as $product) {
                $productImage = ProductImages::where('products_id', $product->id)->first();
                $processedProducts[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'star_avg' => $product->star_avg,
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
                'data' => "Không có sản phẩm nào",
            ]);
        }
    }
}
