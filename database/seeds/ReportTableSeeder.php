<?php

use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Report::class)->create([
            'status_id' => 1,
            'assigned_to' => null,
            'patient_id' => 1,
            'animal_type_id' => 1,
            'animal_subtype_id' => 1,
            'building_id' => 1,
            'room_id' => 1,
            'owner_id' => 1,
            'study_id' => 1,
            'concern_quality_id' => 12,
            'concern_location_id' => 5,
            'reporter_id' => 1,
        ]);
        factory(Report::class)->create([
            'status_id' => 1,
            'assigned_to' => null,
            'patient_id' => 2,
            'animal_type_id' => 2,
            'animal_subtype_id' => 3,
            'building_id' => 2,
            'room_id' => 4,
            'owner_id' => 2,
            'study_id' => 3,
            'concern_quality_id' => 4,
            'concern_location_id' => 21,
            'reporter_id' => 2,
        ]);
        factory(Report::class)->create([
            'status_id' => 1,
            'assigned_to' => null,
            'patient_id' => 3,
            'animal_type_id' => 1,
            'animal_subtype_id' => 2,
            'building_id' => 3,
            'room_id' => 7,
            'owner_id' => 3,
            'study_id' => 2,
            'concern_quality_id' => 1,
            'concern_location_id' => null,
            'reporter_id' => 3,
        ]);
    }
}
