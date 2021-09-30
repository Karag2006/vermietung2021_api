<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            'id'                => 1,
            'vat'               => 19,
            'offer_note'        => '<b>Hinweistext Angebot</b>',
            'reservation_note'  => '<b>Hinweistext Reservierung</b>',
            'contract_note'     => '<b>Hinweistext Mietvertrag</b>',
            'document_footer'   => '<b>Dokumenten Fußzeile</b>',
            'contactdata'       => 'Address Daten',
        ]);
    }
}
