<?php

use Faker\Generator as Faker;
use App\Models\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'status' => 'published',
        'type' => $faker->randomElement(['product', 'post']),
        'user_id' => 1,
    ];
});
