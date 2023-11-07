<?php
namespace Database\Seeders;

use App\Models\trailer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrailerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        trailer::factory()->count(10)->create();
    }
}
