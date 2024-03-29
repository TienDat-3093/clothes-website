<?php

namespace App\Exports;

use App\Models\Products;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductsExport implements FromView
{
    public function view(): View
    {
        return view('product.export', [
            'products' => Products::all()
        ]);
    }
}
