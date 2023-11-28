<?php

namespace Database\Seeders;

use App\Models\ProductTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_types = ['Áo','Quần','Phụ kiện'];
        foreach ($product_types as $name) {
            ProductTypes::create(['name' => $name,'status_id'=>1]);
        }
    }
}
