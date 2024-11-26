<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        DB::table('categories')->insert([
            [
            'name' => 'Keyboard',
            'created_at' => $now,
            'updated_at' => $now,
        ],
            [
            'name' => 'Monitor',
            'created_at' => $now,
            'updated_at' => $now,
        ],
            [
            'name' => 'Laptop',
            'created_at' => $now,
            'updated_at' => $now,
        ],
            [
            'name' => 'Headset',
            'created_at' => $now,
            'updated_at' => $now,
        ],
    ]);
    }
}
