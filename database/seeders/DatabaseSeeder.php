<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ShippingTableSeeder::class,
            NumbersTableSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Mohammed Sayed',
            'email' => 'msa0back@gmail.com',
            'status' => 1,
            'google_id' => '102736598776507148394',
        ]);

        User::factory()->create([
            'name' => 'RosaAdmin',
            'email' => 'rosashop1234@gmail.com',
            'status' => 1,
            'google_id' => '111220643558512293372',
        ]);

    }
}
