<?php

namespace App\Imports;

use App\Models\Admins;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AdminsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Admins::create([
                'username' => $row[0],
                'fullname' => $row[1],
                'email' => $row[2],
                'password' => $row[3],
                'phone_number' => $row[4],
            ]);
        }
    }
}
