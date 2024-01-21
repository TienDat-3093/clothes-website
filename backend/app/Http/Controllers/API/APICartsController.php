<?php

namespace App\Http\Controllers\Api;

use App\Models\Carts;
use App\Models\CartDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APICartsController extends Controller
{
    public function getUserCart($users_id){
        $usercart = Carts::join('status_carts', 'carts.status_carts_id', '=', 'status_carts.id')
        ->select('carts.*', 'status_carts.name as status')
        ->where('carts.users_id', $users_id)
        ->get();
        $usercartdetail = [];
        if(!empty($usercart))
        {
            $usercartdetail=CartDetails::where('carts_id',$usercart[0]->id)->with(['products', 'colors', 'sizes'])->get();
        }
        return response()->json([
            'success'=>true,
            'carts' => $usercart,
            'cart_details' => $usercartdetail,
        ]);
    }
    public function cancelCart($carts_id){
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
}