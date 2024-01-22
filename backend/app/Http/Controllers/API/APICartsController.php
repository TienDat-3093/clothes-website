<?php

namespace App\Http\Controllers\Api;

use App\Models\Carts;
use App\Models\CartDetails;
use App\Models\ProductDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APICartsController extends Controller
{
    public function getUserCart($users_id)
    {
        $usercart = Carts::join('status_carts', 'carts.status_carts_id', '=', 'status_carts.id')
            ->select('carts.*', 'status_carts.name as status')
            ->where('carts.users_id', $users_id)
            ->get();
        $usercartdetail = collect();
        foreach($usercart as $cart){
            if (isset($cart->id)) {
                $cartDetails = CartDetails::where('carts_id', $cart->id)->with(['products', 'colors', 'sizes'])->get();
                $usercartdetail = $usercartdetail->merge($cartDetails);
            }
        }
        return response()->json([
            'success' => true,
            'carts' => $usercart,
            'cart_details' => $usercartdetail,
        ]);
    }
    public function cancelCart($carts_id)
    {
        $usercart = Carts::where('id', $carts_id)->first();

        if ($usercart) {
            $usercart->status_carts_id = 3;
            $usercart->save();
            $usercartdetails = CartDetails::where('carts_id', $usercart->id)->get();
            foreach ($usercartdetails as $usercartdetail) {
                $usercartdetail->status_id = 2;
                $usercartdetail->save();
            }
            return response()->json([
                'success' => true,
                'message' => 'Hủy đơn hàng thành công',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Đơn hàng không tồn tại',
            ]);
        }
    }
    public function checkout()
    {
        $request = request(['users_id','usercart']);
        $totalPrice = array_sum(array_column($request['usercart'], 'price'));

        $users_id = auth()->user()->id;

        $cart = new Carts();
        $cart->total_price = $totalPrice;
        $cart->users_id = $users_id;
        $cart->discounts_id = null;
        $cart->status_carts_id = 1;
        $cart->save();

        foreach ($request['usercart'] as $item) {
            $cartDetail = new CartDetails();
            $cartDetail->quantity = $item['quantity'];
            $cartDetail->price = $item['price'];
            $cartDetail->carts_id = $cart->id;
            $cartDetail->products_id = $item['products_id'];
            $cartDetail->colors_id = $item['colors_id'] ?? null;
            $cartDetail->sizes_id = $item['sizes_id'] ?? null;
            $productDetails = ProductDetails::where('products_id',$cartDetail->products_id)->where('colors_id',$cartDetail->colors_id)->where('sizes_id',$cartDetail->sizes_id)->first();
            if(empty($productDetails))
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm không còn hàng!',
                ]);
            }else{
                $productDetails->quantity -= $cartDetail->quantity;
                $productDetails->save();
            }
            $cartDetail->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Bạn đã đặt hàng thành công',
        ]);
    }
}
