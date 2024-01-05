<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProductDetails;
use App\Models\ProductTypes;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            StatusSeeder::class,
            StatusUsersSeeder::class,
            ProductTypesSeeder::class,
            CategoriesSeeder::class,
            UsersSeeder::class,
            AdminsSeeder::class,
            SuppliersSeeder::class,
            ProductsSeeder::class,
            ProductImagesSeeder::class,
            SizesSeeder::class,
            ColorsSeeder::class,
            ProductDetailsSeeder::class,
        ]);
    }
}

