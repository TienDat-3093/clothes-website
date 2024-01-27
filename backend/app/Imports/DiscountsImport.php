<?php

namespace App\Imports;

use App\Models\Discounts;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DiscountsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Discounts::create([
                'name' => $row[0],
                'amount_discounts' => $row[1],
                'type_discount' => $row[2],
                'start_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['3']),
                'end_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['4']),
            ]);
        }
    }
}
