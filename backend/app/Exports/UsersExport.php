<?php

namespace App\Exports;

use App\Models\Users;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    public function view(): View
    {
        return view('user.export', [
            'users' => Users::all()
        ]);
    }
}
