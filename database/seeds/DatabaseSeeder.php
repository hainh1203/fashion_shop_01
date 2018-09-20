<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            CategoryTableSeeder::class,
            BrandTableSeeder::class,
            SliderTableSeeder::class,
            PostTableSeeder::class,
            ProductTableSeeder::class,
            ReviewTableSeeder::class,
            TagTableSeeder::class,
        ]);
    }
}
