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
                'totalWeight' => $this->cleanupWeights($oldEntry->gesamtgewicht),
                'usableWeight' => $this->cleanupWeights($oldEntry->nutzlast),
                'loadingSize' => $this->cleanupSize($oldEntry->lademasse),
                'tuev' => $oldEntry->license_expiration_date,
                'comment' => $oldEntry->comment
            ];
            DB::connection('mysql')->table('trailers')->insert($newEntry);
        }
    }

    // some weight entrys in the old data have a unit attached to the actual number string
    // remove any such units and save only the number String
    private function cleanupWeights($weight){
        $array = explode(" ", $weight);
        if (is_numeric($array[0])){
            return $array[0];
        }
        return NULL;
    }

    // some Size entrys in the old data are malformed
    // remove any units attached and fix formats to L x W or  L x W x H
    private function cleanupSize($size){
        $resultArray = array();
        $array = explode("x", $size);
        foreach($array as $key => $value){
            if (is_numeric(trim($value))){
                $resultArray[$key] = trim($value);
            }
            else {
                // there is a unit attached to the number string that needs to be removed
                $temp = explode(" ", trim($value));
                if (is_numeric(trim($temp[0]))){
                   $resultArray[$key] = trim($temp[0]);
                }
            }
        }
        if(sizeof($resultArray) == 2 || sizeof($resultArray) == 3){
            return implode(" x ", $resultArray);
        }
        return NULL;
    }
}
