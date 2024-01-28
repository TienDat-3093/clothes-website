<?php

namespace App\Exports;

use App\Models\Categories;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CategoriesExport implements FromView //FromCollection, WithHeadings
{

    public function view(): View
    {
        return view('categories.export', [
            'categories' => Categories::all()
        ]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Categories::select('id', 'name', 'product_types_id')->get();
    // }
    // public function headings(): array
    // {
    //     return [
    //         'ID',
    //         'Name',
    //         'Product Types',
    //     ];
    // }

}
