<?php

use Faker\Generator as Faker;
use App\Models\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => 'user123',
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'role' => 'user',
        'remember_token' => str_random(10),
    ];
});
