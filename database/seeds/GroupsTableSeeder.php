<?php

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::firstOrCreate([
            'name' => 'Medicine',
        ]);
        Group::firstOrCreate([
            'name' => 'Operations',
        ]);
        Group::firstOrCreate([
            'name' => 'Veterinarian',
        ]);
        Group::firstOrCreate([
            'name' => 'Study Director',
        ]);
        Group::firstOrCreate([
            'name' => 'Principal Investigator',
        ]);
    }
}
