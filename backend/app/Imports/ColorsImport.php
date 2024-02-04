<?php

namespace App\Imports;

use App\Models\Colors;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ColorsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Colors::create([
                'name' => $row[0],
            ]);
        }
    }
}
