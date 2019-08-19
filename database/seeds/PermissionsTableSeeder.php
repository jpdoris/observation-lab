<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::find(Role::ROLE_ADMINISTRATOR);
        $owner = Role::find(Role::ROLE_OWNER);
        $reporter = Role::find(Role::ROLE_REPORTER);
        $healthtech = Role::find(Role::ROLE_HEALTHTECH);

        // User permissions.
        $role_createuser = Permission::firstOrCreate([
            "name" => "create_user",
            "description" => "Permission to create and manage users accounts and roles.",
        ]);
        $role_viewdashboard = Permission::firstOrCreate([
            "name" => "view_dashboard",
            "description" => "Permission to view dashboard.",
        ]);
        $role_report = Permission::firstOrCreate([
            "name" => "report",
            "description" => "Permission to submit report.",
        ]);
        $role_ownreport = Permission::firstOrCreate([
            "name" => "own_report",
            "description" => "Permission to take ownership of a report record.",
        ]);
        $role_treatment = Permission::firstOrCreate([
            "name" => "enter_treatment",
            "description" => "Permission to enter treatment on a report record.",
        ]);

        // Award permissions to Admin role.
        $role_createuser->award($admin);
        $role_viewdashboard->award($admin);
        $role_report->award($admin);
        $role_treatment->award($admin);

        // Award permissions to reporter role
        $role_viewdashboard->award($reporter);
        $role_report->award($reporter);

        // Award permission to owner role
        $role_ownreport->award($owner);

        // Award permission to healthtech role
        $role_treatment->award($healthtech);
    }
}
