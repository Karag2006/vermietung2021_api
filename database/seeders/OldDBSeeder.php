<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OldDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            OldTrailerSeeder::class,
            OldCustomerSeeder::class,
            // OldSettingsSeeder::class,
            OldUserSeeder::class,
            OldOfferSeeder::class,
        ]);
    }
}
