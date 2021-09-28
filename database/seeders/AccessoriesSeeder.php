<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accessories')->insert([
            'id'                => 1,
            'name'              => 'Papiere',
            'details'           => 'Fahrzeugpapiere, Schlüssel und Anhängerschloß - Im Preis inbegriffen.',
            'defaultNumber'     => 1
        ]);
        DB::table('accessories')->insert([
            'id'                => 2,
            'name'              => '4-kant Schlüssel',
            'details'           => 'Schlüssel für das Rampenfach an Autotransportern - Im Preis inbegriffen',
            'defaultNumber'     => 1
        ]);
    }
}
