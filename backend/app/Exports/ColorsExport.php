<?php

namespace App\Exports;

use App\Models\Colors;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ColorsExport implements FromView
{
    public function view(): View
    {
        return view('color.export', [
            'colors' => Colors::all()
        ]);
    }
}
