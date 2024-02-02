<?php

namespace App\Exports;

use App\Models\Suppliers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SuppliersExport implements FromView
{
    public function view(): View
    {
        return view('supplier.export', [
            'suppliers' => Suppliers::all()
        ]);
    }
}
