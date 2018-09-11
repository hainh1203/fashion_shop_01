<?php

use Faker\Generator as Faker;
use App\Models\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'thumbnail' => config('backend.default_img.post') . $faker->biasedNumberBetween(1, 6) . '.jpg',
        'excerpt' => $faker->paragraph(10),
        'description' => $faker->paragraph(10),
        'status' => 'published',
        'user_id' => 1,
    ];
});
