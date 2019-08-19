<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Seed the role table with the default roles.
         *
         * @return void
         */
        Role::firstOrCreate([
            'id' => Role::ROLE_ADMINISTRATOR,
            'name' => 'Administrator',
            'description' => "An account level that has universal access to content.",
        ]);

        Role::firstOrCreate([
            'id' => Role::ROLE_OWNER,
            'name' => 'Owner',
            'description' => "An account level that indicates report ownership.",
        ]);

        Role::firstOrCreate([
            'id' => Role::ROLE_HEALTHTECH,
            'name' => 'Health Care Provider',
            'description' => "An account level for users to select from for the Treated By field.",
        ]);

        Role::firstOrCreate([
            'id' => Role::ROLE_REPORTER,
            'name' => 'Reporter',
            'description' => "An account level for users to file concern reports.",
        ]);
    }
}
