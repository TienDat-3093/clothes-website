<?php

namespace Database\Seeders;

use App\Models\Colors;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listColor = ['Xanh','Đỏ','Nâu','Vàng','Xám','Đen','Trắng'];
        foreach($listColor as $color)
        {
            Colors::create([
                'name' => $color,
            ]);
        }
    }
}
