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
        $listSize = ['S', 'M', 'L', 'X', 'XS', 'XL', '2XL'];
        foreach ($listSize as $size) {
            Sizes::create([
                'name' => $size,
            ]);
        }
    }
}
