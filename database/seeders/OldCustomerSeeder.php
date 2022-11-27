<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OldCustomerSeeder extends Seeder
{

    private function setDriversLicense($oldClass){
        if(!$oldClass) return null;
        switch ($oldClass) {
            case 'b':
                return "B";
            case 'be':
                return "BE";
            case 'b96':
                return "B96";
            default:
                return "Klasse 3";
        }
    }

    private function createNameField($oldName, $oldFirstName){
        if(count(explode(' ', $oldName)) > 1){
            return $oldName;
        }
        else return ($oldFirstName . ' ' . $oldName);
    }

    private function createName2Field($oldName, $oldFirstName){
        if(count(explode(' ', $oldName)) > 1){
            return $oldFirstName;
        }
        else return '';
    }

    public function run()
    {
        $oldData = DB::connection('mysql_old')->table('customers')->get();
        foreach ($oldData as $oldEntry){

            $newEntry = [
                'id' => $oldEntry->id,
                'pass_number' => $oldEntry->pass_number,
                'name1' => $this->createNameField($oldEntry->name, $oldEntry->f_name),
                'name2' => $this->createName2Field($oldEntry->name, $oldEntry->f_name),
                'street' => $oldEntry->street,
                'plz' => $oldEntry->plz,
                'city' => $oldEntry->city,
                'birth_date' => $oldEntry->birth_data,
                'birth_city' => $oldEntry->birth_city,
                'phone' => $oldEntry->phone,
                'car_number' => $oldEntry->car_number,
                'email' => $oldEntry->email,
                'driving_license_no' => $oldEntry->driving_license_no,
                'driving_license_class' => $this->setDriversLicense($oldEntry->driving_license_class),
                'comment' => $oldEntry->comment,
            ];
            DB::connection('mysql')->table('customers')->insert($newEntry);
        }
    }
}
