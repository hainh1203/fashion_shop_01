<?php

use Faker\Generator as Faker;
use App\Models\Review;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'product_id' => $faker->biasedNumberBetween(1, 20),
        'content' => $faker->text,
        'rating' => $faker->biasedNumberBetween(1, 5),
        'user_id' => $faker->biasedNumberBetween(3, 30)
    ];
});
