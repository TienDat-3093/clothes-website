<?php

namespace App\Imports;

use App\Models\Suppliers;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SuppliersImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Suppliers::create([
                'name' => $row[0],
                'email' => $row[1],
                'phone_number' => $row[2],
                'address' => $row[3],
            ]);
        }
    }
}
