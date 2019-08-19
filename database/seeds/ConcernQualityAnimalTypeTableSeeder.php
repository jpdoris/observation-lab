<?php

use Illuminate\Database\Seeder;
use App\Models\AnimalType;
use App\Models\ConcernQuality;
use App\Models\ConcernQualityAnimalType;

class ConcernQualityAnimalTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_GENERAL_BODY_CONDITION,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WEIGHT_LOSS_GAIN,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_FOOD_CONSUMPTION,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BEHAVIOR,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_ACTIVITY_LEVEL,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_SKIN,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_VOMIT,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_FECES,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_URINE,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_EYE,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_EAR,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_LARGE,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_GENERAL_BODY_CONDITION,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WEIGHT_LOSS_GAIN,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_FOOD_CONSUMPTION,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BEHAVIOR,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_ACTIVITY_LEVEL,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_ORAL_CAVITY,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_SKIN,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_VOMIT,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_FECES,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_URINE,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_EYE,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);

        ConcernQualityAnimalType::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_EAR,
            'animal_type_id' => AnimalType::ANIMAL_TYPE_SMALL,
        ]);
    }
}
