<?php

use Faker\Generator as Faker;
use App\Models\Product;

$factory->define(Product::class, function (Faker $faker) {
    // sale: 0%, 5%, 10%, 15%, ...
    $saleValidator = function ($sale) {
        return $sale % 5 === 0;
    };

    return [
        'name' => $faker->sentence(2),
        'thumbnail' => config('backend.default_img.product') . $faker->biasedNumberBetween(1, 7) . '.jpg',
        'price' => $faker->biasedNumberBetween(5000, 100000),
        'sale' => $faker->valid($saleValidator)->biasedNumberBetween(0, 70),
        'excerpt' => $faker->paragraph(10),
        'description' => $faker->paragraph(10),
        'status' => 'published',
        'feature' => $faker->randomElement([0, 1]),
        'user_id' => 1,
    ];
});
