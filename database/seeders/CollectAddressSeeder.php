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
                'name'              => 'Hennef',
                'address'           => 'Reisertstraße 9 - 53773 Hennef/Sieg',
            ],
            [
                'name'              => 'Horhausen',
                'address'           => 'Industriepark 13 - 56593 Horhausen',
            ],
        ];
        foreach ($addresses as $address) {
            CollectAddress::create($address);
        }
    }
}
