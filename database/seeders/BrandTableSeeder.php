<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        DB::table('brands')->insert([
            [
            'name' => 'Rexus',
            'created_at' => $now,
            'updated_at' => $now,
        ],
            [
            'name' => 'MSI',
            'created_at' => $now,
            'updated_at' => $now,
        ],
            [
            'name' => 'Asus',
            'created_at' => $now,
            'updated_at' => $now,
        ],
            [
            'name' => 'AKG',
            'created_at' => $now,
            'updated_at' => $now,
        ],
    ]);
    }
}
