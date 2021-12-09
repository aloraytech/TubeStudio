<?php

namespace Database\Seeders;

use App\Models\System\Members;
use Illuminate\Database\Seeder;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Members::factory()->count(50)->create();
    }
}
