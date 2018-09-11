<?php

use Faker\Generator as Faker;
use App\Models\Tag;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(1),
        'status' => 'published',
        'user_id' => 1,
    ];
});
