<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Discounts;
use App\Models\Products;
use App\Models\Status;
use App\Http\Requests\CreateDiscountsRequest;
use Illuminate\Http\Request;

class DiscountsController extends Controller
{
    public function Create()
    {
        $discounts = Discounts::all();

        return view("discounts.create", compact("discounts"));
    }

    public function createHandler(CreateDiscountsRequest $re)
    {
        $discounts = new Discounts();

        $discounts->name = $re->name;
        $discounts->amount_discounts = $re->amount_discounts;
        $discounts->type_discount = $re->type_discount;
        $discounts->start_date = $re->start_date;
        $discounts->end_date = $re->end_date;

        $discounts->save();

        return redirect()->route("discounts.index")->with("alert", "Thêm mã giảm giá thành công");
    }

    public function List()
    {
        $listDiscounts = Discounts::all();
        $status = Status::all();

        return view("discounts/index", compact('listDiscounts', 'status'));
    }

    public function Search(Request $re)
    {
        $keyword = $re->input("data");
        $listDiscounts = Discounts::where('name', 'like', "%$keyword%")->get();

        return view("discounts.search", compact('listDiscounts'));
    }

    public function Update($id)
    {
        $discounts = Discounts::find($id);
        $status = Status::all();

        if (empty($discounts)) {
            return redirect()->route("discounts.index")->with("alert", "Mã giảm giá không tồn tại");
        }

        return view("discounts.index", compact("discounts,status"));
    }

    public function updateHandler(CreateDiscountsRequest $re, $id)
    {
        $discounts = Discounts::find($id);

        if (empty($discounts)) {
            return redirect()->route("discounts.index")->with("alert", "Mã giảm giá không tồn tại");
        }

        $discounts->name = $re->name;
        $discounts->amount_discounts = $re->amount_discounts;
        $discounts->type_discount = $re->type_discount;
        $discounts->start_date = $re->start_date;
        $discounts->end_date = $re->end_date;

        $discounts->save();

        return redirect()->route("discounts.index")->with("alert", "Cập nhật mã giảm giá thành công");
    }

    public function Delete($id)
    {
        $discounts = Discounts::find($id);

        if (empty($discounts)) {
            return redirect()->route("discounts.index")->with("alert", "Mã giảm giá không tồn tại");
        }

        if ($discounts->status_id == 2) {
            return redirect()->route('discounts.index')->with('alert', 'Mã giảm giá đã xóa trước đó rồi');
        }

        $discounts->status_id = 2;
        $discounts->save();

        return redirect()->route('discounts.index')->with('alert', 'Xóa mã giảm giá sản phẩm thành công');
    }
}
