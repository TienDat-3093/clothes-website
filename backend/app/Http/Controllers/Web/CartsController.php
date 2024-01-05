<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\CartDetails;
use App\Models\ProductDetails;
use App\Models\Users;
use App\Models\Products;
use App\Models\Colors;
use App\Models\Sizes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    public function List()
    {
        $listCart=Carts::all();
        return view('cart/index',compact('listCart'));
    }
    public function Search(Request $request)
    {
        $keyword = $request->input('data');
        $userId = Users::where('username', 'like', "%$keyword%")->pluck('id');
        $listCart = Carts::where('user_id', $userId)->get();
        return view('cart/results', compact('listCart'));
    }
    public function Verify($id)
    {
        $cart = Carts::where('id', $id)->get();
        $cart[0]->status_id = 2;
        $cart[0]->save();
        return redirect()->route('cart.index')->with('alert','Duyệt hóa đơn thành công!');
    }
    public function Delete($id)
    {
        $cartDetails = CartDetails::where('carts_id', $id)->get();
        foreach($cartDetails as $detail){
        $productDetails = ProductDetails::where('products_id',$detail->products_id)->where('colors_id',$detail->colors_id)->where('sizes_id',$detail->sizes_id)->get();
        if($productDetails->isEmpty())
        {
            return redirect()->route('cart.index')->with('alert','Sản phẩm trong hóa đơn không còn hàng!');
        }else{
            $productDetails[0]->quantity += $detail->quantity;
            $productDetails[0]->save();
        }
        }
        $cart = Carts::where('id', $id)->get();
        $cart[0]->status_id = 2;
        $cart[0]->save();
        return redirect()->route('cart.index')->with('alert','Xóa hóa đơn thành công!');
    }
    public function Detail($id){
        $listCartDetails = CartDetails::where('carts_id',$id)->get();
        return view('cart/details', compact('listCartDetails'));
    }
}
