<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Product::factory()->count(10)->create();

        // $now = now();

        // DB::table('products')->insert([
        //     'name' => 'Product A',
        //     'price' => 100,
        //     'stock' => 50,
        //     'category_id' => 1,
        //     'brand_id' => 1,
        //     'created_at' => $now,
        //     'updated_at' => $now,
        //     ]);
    }
}
