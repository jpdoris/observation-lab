<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AnimalSubtype;
use App\Models\AnimalType;
use App\Models\Building;
use App\Models\ConcernLocation;
use App\Models\ConcernQuality;
use App\Models\ConcernQualityAnimalType;
use App\Models\Owner;
use App\Models\Patient;
use App\Models\Permission;
use App\Models\Report;
use App\Models\Reporter;
use App\Models\Role;
use App\Models\Room;
use App\Models\Study;
use App\Models\User;


$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'id' => NULL,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'group_id' => $faker->numberBetween(1,3),
        'remember_token' => str_random(10),
        'status' => User::STATUS_ACTIVE,
    ];
});


$factory->define(Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->sentence,
    ];
});

$factory->define(Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->sentence,
    ];
});

$factory->define(AnimalType::class, function (Faker\Generator $faker) {
    return [
        'id' => NULL,
        'name' => $faker->word,
    ];
});

$factory->define(AnimalSubtype::class, function (Faker\Generator $faker) {
    return [
        'id' => NULL,
        'name' => $faker->word,
    ];
});

$factory->define(ConcernQuality::class, function (Faker\Generator $faker) {
    return [
        'id' => NULL,
        'name' => $faker->sentence(2),
    ];
});

$factory->define(ConcernQualityAnimalType::class, function (Faker\Generator $faker) {
    return [
        'id' => NULL,
        'concern_quality_id' => $faker->numberBetween(1,10),
        'animal_type_id' => $faker->numberBetween(1,2),
    ];
});

$factory->define(ConcernLocation::class, function (Faker\Generator $faker) {
    return [
        'id' => NULL,
        'name' => $faker->sentence(2),
    ];
});

$factory->define(Building::class, function (Faker\Generator $faker) {
    return [
        'id' => NULL,
        'name' => $faker->word,
    ];
});

$factory->define(Room::class, function (Faker\Generator $faker) {
    return [
        'id' => NULL,
        'name' => $faker->word,
        'building_id' => $faker->numberBetween(1,3),
    ];
});

$factory->define(Owner::class, function (Faker\Generator $faker) {
    return [
        'id' => NULL,
        'name' => $faker->name,
    ];
});

$factory->define(Patient::class, function (Faker\Generator $faker) {
    return [
        'id' => NULL,
        'name' => $faker->randomAscii,
    ];
});

$factory->define(Reporter::class, function (Faker\Generator $faker) {
    return [
        'id' => NULL,
        'name' => $faker->name,
    ];
});

$factory->define(Study::class, function (Faker\Generator $faker) {
    return [
        'id' => NULL,
        'name' => $faker->sentence(2),
    ];
});

$factory->define(Report::class, function (Faker\Generator $faker) {
    return [
        'patient_id' => $faker->numberBetween(1,4),
        'animal_type_id' => $faker->numberBetween(1,2),
        'building_id' => $faker->numberBetween(1,3),
        'room_id' => $faker->numberBetween(1,7),
        'owner_id' => $faker->numberBetween(1,3),
        'study_id' => $faker->numberBetween(1,3),
        'concern_quality_id' => $faker->numberBetween(1,15),
        'concern_location_id' => $faker->numberBetween(1,21),
        'reporter_id' => $faker->numberBetween(1.)
    ];
});

