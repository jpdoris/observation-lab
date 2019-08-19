<?php

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::firstOrCreate([
            'name' => 'Reported',
        ]);
        Status::firstOrCreate([
            'name' => 'Reviewed',
        ]);
        Status::firstOrCreate([
            'name' => 'Treatment',
        ]);
        Status::firstOrCreate([
            'name' => 'Closed',
        ]);
    }
}
