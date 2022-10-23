<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OldUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oldData = DB::connection('mysql_old')->table('users')->get();
        foreach ($oldData as $oldEntry){

            if(isset($oldEntry->username) && $oldEntry->username != 'admin')
            {

                $newEntry = [
                    'id' => $oldEntry->id,
                    'name' => $oldEntry->name,
                    'username' => $oldEntry->username,
                    'email' => $oldEntry->email,
                    'password' => $oldEntry->password,
                ];
                DB::connection('mysql')->table('users')->insert($newEntry);
            }
        }
    }
}
