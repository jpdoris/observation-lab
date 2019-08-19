<?php

use Illuminate\Database\Seeder;
use App\Models\Owner;

class OwnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Owner::firstOrCreate([
            'name' => 'Joe Owner',
        ]);
        Owner::firstOrCreate([
            'name' => 'Amanda Owner',
        ]);
        Owner::firstOrCreate([
            'name' => 'Zack Owner',
        ]);
    }
}
