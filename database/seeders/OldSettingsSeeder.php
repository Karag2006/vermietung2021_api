<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OldSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oldData = DB::connection('mysql_old')->table('settings')->get();
        foreach ($oldData as $oldEntry){

            $newEntry = [
                'id' => $oldEntry->id,
                'vat' => $this->rateToVatConversion($oldEntry->netto_brutto_rate),
                'offer_note' => $oldEntry->offer_note,
                'reservation_note' => $oldEntry->reservation_note,
                'contract_note' => $oldEntry->contract_note,
                'document_footer' => $oldEntry->document_footer,
                'contactdata' => $oldEntry->contactdata,
            ];
            DB::connection('mysql')->table('options')->where('id', 1)->delete();
            DB::connection('mysql')->table('options')->insert($newEntry);
        }
    }

    private function rateToVatConversion($rate){
        return $rate * 100 - 100;
    }
}
