<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Áo khoác', 'Áo thun', 'Áo sơ mi', 'Quần Jeans', 'Quần thun', 'Quần dài', 'Đồng hồ', 'Nhẫn'];
        foreach ($categories as $name) {
            if (strpos($name, 'Áo') !== false) {
                $productTypes = 1;
            } elseif (strpos($name, 'Quần') !== false) {
                $productTypes = 2;
            } else {
                $productTypes = 3;
            }
            Categories::create(['name' => $name, 'product_types_id' => $productTypes, 'status_id' => 1]);
        }
    }
}
