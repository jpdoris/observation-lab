<?php

use Illuminate\Database\Seeder;
use App\Models\Reporter;

class ReporterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reporter::firstOrCreate([
            'name' => 'Frank L. Reporter',
        ]);
        Reporter::firstOrCreate([
            'name' => 'Jane Doe',
        ]);
        Reporter::firstOrCreate([
            'name' => 'Dana Scully',
        ]);
    }
}
