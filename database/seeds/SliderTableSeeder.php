<?php

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::insert([
            [
                'name' => 'slider 1',
                'thumbnail' => config('backend.default_img.slider') . '1.jpg',
                'status' => 'published',
                'user_id' => 1,
            ],
            [
                'name' => 'slider 2',
                'thumbnail' => config('backend.default_img.slider') . '2.jpg',
                'status' => 'published',
                'user_id' => 1,
            ],
            [
                'name' => 'slider 3',
                'thumbnail' => config('backend.default_img.slider') . '3.jpg',
                'status' => 'published',
                'user_id' => 1,
            ],
            [
                'name' => 'slider 4',
                'thumbnail' => config('backend.default_img.slider') . '4.jpg',
                'status' => 'published',
                'user_id' => 1,
            ],
        ]);
    }
}
