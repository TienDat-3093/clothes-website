<?php

namespace App\Exports;

use App\Models\Discounts;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DiscountsExport implements FromView
{
    public function view(): View
    {
        return view('discounts.export', [
            'discounts' => Discounts::all()
        ]);
    }
}
