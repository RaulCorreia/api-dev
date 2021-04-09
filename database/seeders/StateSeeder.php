<?php

namespace Database\Seeders;

use App\Jobs\SeedStatesJob;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        dispatch(new SeedStatesJob());
    }
}
