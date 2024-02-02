<?php

namespace App\Exports;

use App\Models\Admins;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AdminsExport implements FromView
{
    public function view(): View
    {
        return view('admin.export', [
            'admins' => Admins::all()
        ]);
    }
}
