<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipment')->insert([
            'name'              => 'Papiere',
            'details'           => 'Fahrzeugpapiere, Schlüssel und Anhängerschloß - Im Preis inbegriffen.',
            'defaultNumber'     => 1
        ]);
        DB::table('equipment')->insert([
            'name'              => '4-kant Schlüssel',
            'details'           => 'Schlüssel für das Rampenfach an Autotransportern - Im Preis inbegriffen',
            'defaultNumber'     => 1
        ]);
    }
}
