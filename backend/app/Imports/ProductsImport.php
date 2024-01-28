<?php

namespace App\Imports;

use App\Models\Products;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Products::create([
                'name' => $row[0],
                'description' => $row[1],
                'price' => $row[2],
                'star_avg' => $row[3],
                'categories_id' => $row[4],
            ]);
        }
    }
}
