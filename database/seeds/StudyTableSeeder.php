<?php

use Illuminate\Database\Seeder;
use App\Models\Study;

class StudyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Study::firstOrCreate([
            'name' => 'L725R',
        ]);

        Study::firstOrCreate([
            'name' => 'G121P',
        ]);

        Study::firstOrCreate([
            'name' => 'R912X',
        ]);
    }
}
