<?php

use Illuminate\Database\Seeder;
use App\Models\AnimalType;
use App\Models\AnimalSubtype;

class AnimalSubtypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AnimalSubtype::firstOrCreate([
            'name' => 'Rat',
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        AnimalSubtype::firstOrCreate([
            'name' => 'Mouse',
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);
        AnimalSubtype::firstOrCreate([
            'name' => 'Canine',
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        AnimalSubtype::firstOrCreate([
            'name' => 'NHP',
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);
    }
}
