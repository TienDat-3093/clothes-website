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
use Nette\Schema\Expect;

class ProductsController extends Controller
{
    public function index()
    {
        $listCategory = Categories::all();
        $listProduct = Products::paginate(10);
        $listColor = Colors::all();
        $listSize = Sizes::all();
        $productImage = ProductImages::all();
        $status = Status::all();
        return view('product/index', compact('listProduct', 'productImage', 'listCategory', 'listColor', 'listSize'));
    }
 
    public function search(Request $request)
    {
        $productImage = ProductImages::all();
        $status = Status::all();
        $keyword = $request->input('data');
        $listProduct = Products::where('name', 'like', "%$keyword%")->get();
        return view('product/results', compact('listProduct', 'productImage'));
    }
    public function detail($id)
    {
        $product = Products::find($id);
        $productDetails = ProductDetails::find($id);
        $listColor = ProductDetails::where('products_id', $id)->distinct()->get('colors_id');
        $listSize = ProductDetails::where('products_id', $id)->distinct()->get('sizes_id');

        return view('product/detail', compact('product', 'listColor', 'listSize', 'productDetails'));
    }
    public function quantity(Request $request, $id)
    {

        $product = Products::find($id);
        $listColor = Colors::all();
        $listSize = Sizes::all();
        $color = $request->input('color_id');
        $size = $request->input('size_id');

        $quantity = ProductDetails::where('colors_id', $color)->where('sizes_id', $size)->where('products_id', $id)->value('quantity');

        if ($quantity == null) {
            $quantity = 0;
            return response()->json(['quantity' => $quantity]);
        }
        return response()->json(['quantity' => $quantity]);
    }
    public function create(Request $request)
    {
        $product = new Products();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->categories_id = $request->categories_id;
        $product->save();

        if ($request->hasFile('images')) {

            $images = $request->file('images');

            foreach ($images as $image) {
                $file = new ProductImages();
                $imageName = $image->getClientOriginalName();
                $path = $image->storeAs('product_image', $imageName);
                $file->url = $path;
                $file->products_id = $product->id;
                $file->save();
            }
        }
        $productDetail = new ProductDetails();
        $productDetail->products_id = $product->id;
        $productDetail->quantity = 0;
        $productDetail->colors_id = $request->colors_id;
        $productDetail->sizes_id = $request->sizes_id;
        $productDetail->save();

        $listProduct = Products::paginate(10);
        return view('product/results', compact('listProduct'));
    }

    public function update($id)
    {
        $product = Products::find($id);
        $productImage = ProductImages::where('products_id', $id)->get();
        return response()->json(['data' => $product, 'data_image' => $productImage]);
    }
    public function deleteImage(Request $request)
    {
        $images = $request->input('imageIds');

        if (!empty($images)) {
            try {
                ProductImages::whereIn('id', $images)->delete();
                $images = [];
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error' + $e->getMessage()]);
            }
        } else {
            return response()->json(['message' => 'Sản phẩm không có hình']);
        }
    }

    public function updateHandle(Request $request, $id)
    {
        try {
            $product = Products::find($id);
            if (!empty($product)) {
                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->categories_id = $request->categories_id;
                $product->save();

                if ($request->hasFile('images')) {

                    $images = $request->file('images');

                    foreach ($images as $image) {
                        $file = new ProductImages();
                        $imageName = $image->getClientOriginalName();
                        $path = $image->storeAs('product_image', $imageName);
                        $file->url = $path;
                        $file->products_id = $product->id;
                        $file->save();
                    }
                }
                $productDetail = ProductDetails::where('products_id', $product->id)->first();
                if (!empty($productDetail)) {
                    $productDetail->quantity = 0;
                    $productDetail->save();
                } else {
                    $productDetail = new ProductDetails();
                    $productDetail->products_id = $product->id;
                    $productDetail->quantity = 0;
                    $productDetail->save();
                }
            }
            $productImage = ProductImages::all();
            $listProduct = Products::paginate(10);
            return view('product/results', compact('listProduct','productImage'));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error']);
        }
    }
    public function delete($id)
    {
        $product = Products::find($id);
        if(!empty($product)){
            if($product->status_id == 2)
            {
                return redirect()->route('product.index')->with('alert' ,'Sản phẩm không tồn tại');
            }
            $product->status_id = 2;
            $product->save();
            return redirect()->route('product.index')->with('alert' ,'Xóa thành công sản phẩm');
        }
        else{
            return redirect()->route('product.index')->with('alert' ,'Không có sản phẩm có id {$id}');
        }
    }
}
