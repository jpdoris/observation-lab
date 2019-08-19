<?php

use Illuminate\Database\Seeder;
use App\Models\ConcernLocation;

class ConcernLocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConcernLocation::firstOrCreate([
            'name' => 'Face',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Nose',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Neck',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Tail',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Leg RF',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Leg LF',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Leg RR',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Leg LR',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Foot/Hand RF',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Foot/Hand LF',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Foot/Hand RR',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Foot/Hand LR',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Right',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Left',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Chest',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Abdomen',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Back',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Rump',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Head',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Circling',
        ]);
        ConcernLocation::firstOrCreate([
            'name' => 'Head Tilt',
        ]);
    }
}
