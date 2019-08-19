<?php

use Illuminate\Database\Seeder;
use App\Models\ConcernQuality;

class ConcernQualityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConcernQuality::firstOrCreate([
            'name' => 'General Body Condition',
        ]);

        ConcernQuality::firstOrCreate([
            'name' => 'Weight Loss/Gain',
        ]);

        ConcernQuality::firstOrCreate([
            'name' => 'Food Consumption',
        ]);

        ConcernQuality::firstOrCreate([
            'name' => 'Behavior',
        ]);

        ConcernQuality::firstOrCreate([
            'name' => 'Activity Level',
        ]);

        ConcernQuality::firstOrCreate([
            'name' => 'Haircoat/Loss',
        ]);

        ConcernQuality::firstOrCreate([
            'name' => 'Skin',
        ]);

        ConcernQuality::firstOrCreate([
            'name' => 'Bruising',
        ]);

        ConcernQuality::firstOrCreate([
            'name' => 'Vomit',
        ]);

        ConcernQuality::firstOrCreate([
            'name' => 'Feces',

        ]);

        ConcernQuality::firstOrCreate([
            'name' => 'Urine',
        ]);

        ConcernQuality::firstOrCreate([
            'name' => 'Wound',
        ]);

        ConcernQuality::firstOrCreate([
            'name' => 'Eye',
        ]);

        ConcernQuality::firstOrCreate([
            'name' => 'Ear',
        ]);

        ConcernQuality::firstOrCreate([
            'name' => 'Oral Cavity',
        ]);
    }
}
