<?php

namespace App\Http\Controllers\API;

use App\Models\Users;
use App\Models\Carts;
use App\Models\CartDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APICartController extends Controller
{
    public function checkout(Request $re)
    {
        try {
            $cartData = $re->input('cart');
            $total = $re->input('total');

            // Lưu thông tin giỏ hàng vào bảng cart
            $cart = Carts::create([
                'total_price' => $total,
                'users_id' => auth()->id(), // Thay đổi tùy thuộc vào cách xác định người dùng
                'discounts_id' => null, // Bạn có thể thêm mã giảm giá ở đây
                'status_id' => 'pending', // Trạng thái đơn hàng
            ]);

            // Lưu thông tin chi tiết giỏ hàng vào bảng cart_detail
            foreach ($cartData as $item) {
                CartDetails::create([
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'carts_id' => $cart->id,
                    'products_id' => $item['product_id'], // Thay đổi tùy thuộc vào cách xác định sản phẩm
                    'colors_id' => $item['color_id'], // Thay đổi tùy thuộc vào cách xác định màu
                    'sizes_id' => $item['size_id'], // Thay đổi tùy thuộc vào cách xác định kích thước
                    'status_id' => 'pending', // Trạng thái đơn hàng
                ]);
            }

            return response()->json(['message' => 'Checkout successful'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
}
