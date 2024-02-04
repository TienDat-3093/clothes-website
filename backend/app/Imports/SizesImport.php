<?php

namespace App\Imports;

use App\Models\Sizes;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SizesImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Sizes::create([
                'name' => $row[0],
            ]);
        }
    }
}
