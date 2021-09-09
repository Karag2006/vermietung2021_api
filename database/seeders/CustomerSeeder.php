<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Füge Customer in die Datenbank ein.
        DB::table('customers')->insert([
        ]);

        // // Erzeuge eine Rolle, zum Managen der Ressource oder hole Sie aus der Datenbank falls es sie schon gibt.
        // $manager = Bouncer::role()->firstOrCreate([
        //     'name' => 'customerManager',
        //     'title' => 'Kunden Manager',
        // ]);

        // // Gebe der Manager Rolle alle rechte auf der Ressource
        // Bouncer::allow($manager)->to('view', Customer::class);
        // Bouncer::allow($manager)->to('create', Customer::class);
        // Bouncer::allow($manager)->to('update', Customer::class);
        // Bouncer::allow($manager)->to('destroy', Customer::class);
        // // Gebe der allgemeinen Benutzer Rolle das 'view' Recht auf der Ressource
        // Bouncer::allow('user')->to('view', Customer::class);
    }
}
