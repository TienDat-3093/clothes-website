<?php

namespace App\Exports;

use App\Models\Sizes;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SizesExport implements FromView
{
    public function view(): View
    {
        return view('size.export', [
            'sizes' => Sizes::all()
        ]);
    }
}
