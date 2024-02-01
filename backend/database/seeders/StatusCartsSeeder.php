<?php

namespace Database\Seeders;

use App\Models\StatusCarts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusCartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = ['Chờ duyệt','Đã duyệt','Đã hủy','Đang giao','Đã giao'];
        foreach ($status as $name) {
            StatusCarts::create(['name' => $name]);
        }
    }
}
