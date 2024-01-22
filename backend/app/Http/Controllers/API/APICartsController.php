<?php

namespace App\Http\Controllers\Api;

use App\Models\Carts;
use App\Models\CartDetails;
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
        $usercartdetail = [];
        if (!empty($usercart)) {
            $usercartdetail = CartDetails::where('carts_id', $usercart[0]->id)->with(['products', 'colors', 'sizes'])->get();
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
    // public function checkout(Request $request)
    // {
    //     $totalPrice = $request->session()->get('cart.total_price');

    //     $users_id = auth()->user()->id;

    //     $cart = new Carts();
    //     $cart->total_price = $totalPrice;
    //     $cart->users_id = $users_id;
    //     $cart->discounts_id = null;
    //     $cart->status_carts_id = 1;
    //     $cart->save();

    //     foreach ($request->session()->get('cart.items') as $item) {
    //         $cartDetail = new CartDetails();
    //         $cartDetail->quantity = $item['quantity'];
    //         $cartDetail->price = $item['price'];
    //         $cartDetail->carts_id = $cart->id;
    //         $cartDetail->products_id = $item['product_id'];
    //         $cartDetail->colors_id = $item['color_id'] ?? null;
    //         $cartDetail->sizes_id = $item['size_id'] ?? null;
    //         $cartDetail->status_id = 1;
    //         $cartDetail->save();
    //     }

    //     $request->session()->forget('cart');

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Bạn đã đặt hàng thành công',
    //     ]);
    // }

    public function checkout(Request $request)
    {
        $totalPrice = array_sum(array_column($request->input('cart'), 'price'));

        $users_id = auth()->user()->id;

        $cart = new Carts();
        $cart->total_price = $totalPrice;
        $cart->users_id = $users_id;
        $cart->discounts_id = null;
        $cart->status_carts_id = 1;
        $cart->save();

        foreach ($request->input('cart') as $item) {
            $cartDetail = new CartDetails();
            $cartDetail->quantity = $item['quantity'];
            $cartDetail->price = $item['price'];
            $cartDetail->carts_id = $cart->id;
            $cartDetail->products_id = $item['product_id'];
            $cartDetail->colors_id = $item['colors_id'] ?? null;
            $cartDetail->sizes_id = $item['sizes_id'] ?? null;
            $cartDetail->status_id = 1;
            $cartDetail->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Bạn đã đặt hàng thành công',
        ]);
    }
}
