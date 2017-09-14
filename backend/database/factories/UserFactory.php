<?php
use Faker\Generator as Faker;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(User::class, function (Faker $faker) {
    static $password;
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => $faker->numberBetween(1, 3),
        'phone' => $faker->phoneNumber,
        'birthday' => $faker->dateTime,
        'permissions' => $faker->numberBetween(1, 2),
        'verified' => 1,
    ];
});
