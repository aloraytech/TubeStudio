<?php

namespace Database\Seeders;

use App\Models\Business\Adverts;
use Illuminate\Database\Seeder;

class AdvertsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Adverts::factory()->count(10)->create();
    }
}
