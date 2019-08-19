<?php

use Illuminate\Database\Seeder;
use App\Models\AnimalType;

class AnimalTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AnimalType::firstOrCreate([
            'name' => 'Small',
        ]);

        AnimalType::firstOrCreate([
            'name' => 'Large ',
        ]);
    }
}
