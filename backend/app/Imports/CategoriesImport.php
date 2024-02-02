<?php

namespace App\Imports;

use App\Models\Categories;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CategoriesImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Categories::create([
                'name' => $row[0],
                'product_types_id' => $row[1],
            ]);
        }
    }
}
