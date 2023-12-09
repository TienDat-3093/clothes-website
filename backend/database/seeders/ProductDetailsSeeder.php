<?php

namespace Database\Seeders;

use App\Models\ProductDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            for ($j = 1; $j <= rand(1, 5); $j++) {
                ProductDetails::create([
                    'quantity' => rand(1,50),
                    'products_id' => $i,
                    'colors_id' => rand(1,7),
                    'sizes_id' => rand(1,5),
                ]);
            }
        }
        
    }
}
