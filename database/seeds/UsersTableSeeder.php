<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Group;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => env('SU_EMAIL', 'admin@example.com'),
            'status' => User::STATUS_ACTIVE,
            'password' => bcrypt(env('SU_PASSWORD', 'secret')),
            'group_id' => Group::GROUP_OPERATIONS,
            'first_name' => 'John',
            'last_name' => 'Administrator',
        ]);

        $owner = factory(User::class)->create([
            'email' => 'admin+owner@example.com',
            'status' => User::STATUS_ACTIVE,
            'password' => bcrypt(env('SU_PASSWORD', 'secret')),
            'group_id' => Group::GROUP_OPERATIONS,
            'first_name' => 'Wilma',
            'last_name' => 'Owner',
        ]);

        $reporter = factory(User::class)->create([
            'email' => 'admin+reporter@example.com',
            'status' => User::STATUS_ACTIVE,
            'password' => bcrypt(env('SU_PASSWORD', 'secret')),
            'group_id' => Group::GROUP_MEDICINE,
            'first_name' => 'Fred',
            'last_name' => 'Reporter',
        ]);

        $healthtech = factory(User::class)->create([
            'email' => 'admin+healthtechnician@example.com',
            'status' => User::STATUS_ACTIVE,
            'password' => bcrypt(env('SU_PASSWORD', 'secret')),
            'group_id' => Group::GROUP_VETERINARIAN,
            'first_name' => 'Nancy',
            'last_name' => 'Health Technician',
        ]);


        $smith = factory(User::class)->create([
            'email' => 'janet.smith@example.com',
            'status' => User::STATUS_ACTIVE,
            'password' => bcrypt('Password1'),
            'group_id' => Group::GROUP_OPERATIONS,
            'first_name' => 'Timothy',
            'last_name' => 'Armold',
        ]);

        $corrigan = factory(User::class)->create([
            'email' => 'michael.corrigan@example.com',
            'status' => User::STATUS_ACTIVE,
            'password' => bcrypt('Password1'),
            'group_id' => Group::GROUP_VETERINARIAN,
            'first_name' => 'Gerald',
            'last_name' => 'Corrigan',
        ]);

        $anderson = factory(User::class)->create([
            'email' => 'allen.anderson@example.com',
            'status' => User::STATUS_ACTIVE,
            'password' => bcrypt('Password1'),
            'group_id' => Group::GROUP_OPERATIONS,
            'first_name' => 'Allen',
            'last_name' => 'Bemus',
        ]);
    }
}
