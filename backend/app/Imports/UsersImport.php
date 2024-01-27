<?php

namespace App\Imports;

use App\Models\Users;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Users::create([
                'username' => $row[0],
                'fullname' => $row[1],
                'email' => $row[2],
                'address' => $row[3],
                'password' => $row[4],
                'phone_number' => $row[5],
                'login_at' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['6']),
            ]);
        }
    }
}
