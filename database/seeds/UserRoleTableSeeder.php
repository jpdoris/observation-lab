<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::firstOrCreate([
            'role_id' => Role::ROLE_ADMINISTRATOR,
            'user_id' => User::USER_ADMIN,
        ]);
        UserRole::firstOrCreate([
            'role_id' => Role::ROLE_OWNER,
            'user_id' => User::USER_OWNER,
        ]);
        UserRole::firstOrCreate([
            'role_id' => Role::ROLE_REPORTER,
            'user_id' => User::USER_REPORTER,
        ]);
        UserRole::firstOrCreate([
            'role_id' => Role::ROLE_HEALTHTECH,
            'user_id' => User::USER_HEALTHTECH,
        ]);

    }
}
