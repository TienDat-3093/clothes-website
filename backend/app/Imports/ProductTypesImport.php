<?php

namespace App\Imports;

use App\Models\ProductTypes;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductTypesImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            ProductTypes::create([
                'name' => $row[0],
            ]);
        }
    }
}
