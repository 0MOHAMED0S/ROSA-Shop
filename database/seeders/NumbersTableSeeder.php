<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NumbersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('numbers')->insert([
            [
                'face' => 2500,
                'insta' =>1000,
                'tik' => 3000,
                'orders' => 505,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
