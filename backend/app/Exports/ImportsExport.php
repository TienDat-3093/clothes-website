<?php

namespace App\Exports;

use App\Models\Imports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ImportsExport implements FromView
{
    public function view(): View
    {
        return view('import.export', [
            'imports' => Imports::all()
        ]);
    }
}
