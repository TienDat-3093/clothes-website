<?php

namespace Database\Seeders;

use App\Models\ProductImages;
use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productImages = ['product_image/product-01.jpg','product_image/product-02.jpg','product_image/product-03.jpg','product_image/product-04.jpg','product_image/product-05.jpg','product_image/product-06.jpg','product_image/product-07.jpg','product_image/product-08.jpg','product_image/product-09.jpg','product_image/product-10.jpg','product_image/product-11.jpg','product_image/product-12.jpg','product_image/product-13.jpg','product_image/product-14.jpg','product_image/product-15.jpg','product_image/product-16.jpg'];
        
         
        
        for($i=1;$i<=30;$i++)
        {
            $randomCount =rand(1,5);
            
            for($j=1;$j<=$randomCount;$j++)
            {
                $randomImage = rand(0,15);
                ProductImages::create([
                    'url'=> $productImages[$randomImage],
                    'products_id' => $i,
                ]);
            }
        }

    }
}
