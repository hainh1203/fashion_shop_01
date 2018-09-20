<?php

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Brand::insert([
            [
                'name' => 'canon',
                'slug' => 'canon',
                'thumbnail' => config('backend.default_img.brand') . 'canon.jpg',
                'status' => 'published',
                'user_id' => 1,
            ],
            [
                'name' => 'esprit',
                'slug' => 'esprit',
                'thumbnail' => config('backend.default_img.brand') . 'esprit.jpg',
                'status' => 'published',
                'user_id' => 1,
            ],
            [
                'name' => 'gap',
                'slug' => 'gap',
                'thumbnail' => config('backend.default_img.brand') . 'gap.jpg',
                'status' => 'published',
                'user_id' => 1,
            ],
            [
                'name' => 'next',
                'slug' => 'next',
                'thumbnail' => config('backend.default_img.brand') . 'next.jpg',
                'status' => 'published',
                'user_id' => 1,
            ],
            [
                'name' => 'puma',
                'slug' => 'puma',
                'thumbnail' => config('backend.default_img.brand') . 'puma.jpg',
                'status' => 'published',
                'user_id' => 1,
            ],
            [
                'name' => 'zara',
                'slug' => 'zara',
                'thumbnail' => config('backend.default_img.brand') . 'zara.jpg',
                'status' => 'published',
                'user_id' => 1,
            ],
        ]);
    }
}
