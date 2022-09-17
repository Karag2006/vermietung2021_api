<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            NavSeeder::class,
            CustomerSeeder::class,
            TrailerSeeder::class,
            EquipmentSeeder::class,
            OptionSeeder::class,
            CollectAddressSeeder::class,
        ]);
    }
}
