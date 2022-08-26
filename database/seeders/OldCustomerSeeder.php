<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OldCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oldData = DB::connection('mysql_old')->table('customers')->get();
        foreach ($oldData as $oldEntry){

            $newEntry = [
                'id' => $oldEntry->id,
                'pass_number' => $oldEntry->pass_number,
                'name1' => $oldEntry->f_name,
                'name2' => $oldEntry->name,
                'street' => $oldEntry->street,
                'plz' => $oldEntry->plz,
                'city' => $oldEntry->city,
                'birth_date' => $oldEntry->birth_data,
                'birth_city' => $oldEntry->birth_city,
                'phone' => $oldEntry->phone,
                'car_number' => $oldEntry->car_number,
                'email' => $oldEntry->email,
                'driving_license_no' => $oldEntry->driving_license_no,
                'driving_license_class' => $oldEntry->driving_license_class,
                'comment' => $oldEntry->comment,
            ];
            DB::connection('mysql')->table('customers')->insert($newEntry);
        }
    }
}
