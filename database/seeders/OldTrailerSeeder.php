<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OldTrailerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oldData = DB::connection('mysql_old')->table('vehicles')->get();
        foreach ($oldData as $oldEntry){
            $newEntry = [
                'id' => $oldEntry->id,
                'title' => $oldEntry->title,
                'plateNumber' => $oldEntry->vehicle_plate_number,
                'chassisNumber' => $oldEntry->fahrzeugidentnummer,
                'totalWeight' => $oldEntry->gesamtgewicht,
                'usableWeight' => $oldEntry->nutzlast,
                'loadingSize' => $oldEntry->lademasse,
                'tuev' => $oldEntry->license_expiration_date,
            ];
            DB::connection('mysql')->table('trailers')->insert($newEntry);
        }
    }
}
