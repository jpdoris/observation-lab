<?php

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::firstOrCreate([
            'name' => 'Trixie',
        ]);
        Patient::firstOrCreate([
            'name' => 'Pinky',
        ]);
        Patient::firstOrCreate([
            'name' => 'Bear',
        ]);
        Patient::firstOrCreate([
            'name' => 'Ulysses',
        ]);
    }
}
