<?php

namespace App\Exports;

use App\Models\Carts;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CartsExport implements FromView
{
    public function view(): View
    {
        return view('cart.export', [
            'carts' => Carts::all()
        ]);
    }
}
