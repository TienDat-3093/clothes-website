<?php

namespace App\Exports;

use App\Models\ProductTypes;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductTypesExport implements FromView
{
    public function view(): View
    {
        return view('product_types.export', [
            'product_types' => ProductTypes::all()
        ]);
    }
}
