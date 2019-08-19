<?php

use Illuminate\Database\Seeder;
use App\Models\Building;

class BuildingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Building::firstOrCreate([
            'name' => 'Building 11',
        ]);
        Building::firstOrCreate([
            'name' => 'Building 2 Level 2',
        ]);
        Building::firstOrCreate([
            'name' => 'Building 2 Level 3',
        ]);
        Building::firstOrCreate([
            'name' => 'Building 7',
        ]);
        Building::firstOrCreate([
            'name' => 'Building 8',
        ]);
        Building::firstOrCreate([
            'name' => 'Building 9',
        ]);
    }
}
