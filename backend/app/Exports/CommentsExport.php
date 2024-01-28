<?php

namespace App\Exports;

use App\Models\Comments;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CommentsExport implements FromView
{
    public function view(): View
    {
        return view('comment.export', [
            'comments' => Comments::all()
        ]);
    }
}
