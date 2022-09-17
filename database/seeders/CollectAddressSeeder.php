<?php

namespace Database\Seeders;

use App\Models\CollectAddress;
use Illuminate\Database\Seeder;

class CollectAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addresses = [
            [
                'name'              => 'Horhausen',
                'address'           => 'Industriepark 13 - 56593 Horhausen',
            ],
            [
                'name'              => 'Hennef',
                'address'           => 'Reisertstraße 9 - 53773 Hennef/Sieg',
            ],
            [
                'name'              => 'Knipp',
                'address'           => 'Meysstraße 8 - 53773 Hennef/Sieg',
            ],
        ];
        foreach ($addresses as $address) {
            CollectAddress::create($address);
        }
    }
}
