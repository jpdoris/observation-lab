<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(AnimalTypesTableSeeder::class);
        $this->call(AnimalSubtypesTableSeeder::class);
        $this->call(ConcernQualityTableSeeder::class);
        $this->call(ConcernQualityAnimalTypeTableSeeder::class);
        $this->call(ConcernLocationTableSeeder::class);
        $this->call(ConcernQualityLocationTableSeeder::class);
        $this->call(BuildingTableSeeder::class);
        $this->call(RoomTableSeeder::class);
        $this->call(OwnerTableSeeder::class);
        $this->call(StudyTableSeeder::class);
        $this->call(PatientTableSeeder::class);
        $this->call(ReporterTableSeeder::class);
        $this->call(ReportTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
    }
}
