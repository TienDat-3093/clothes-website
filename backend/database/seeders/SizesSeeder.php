<?php

namespace Database\Seeders;

use App\Models\Sizes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listSize = ['S', 'M', 'X',  'L', 'XL', '2S', '2X', '2L', '2XL'];
        foreach ($listSize as $size) {
            Sizes::create([
                'name' => $size,
            ]);
        }
    }
}
