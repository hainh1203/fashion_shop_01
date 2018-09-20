<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'role' => 'admin',
                'remember_token' => str_random(10),
            ],
            [
                'id' => 2,
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('manager123'),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'role' => 'manager',
                'remember_token' => str_random(10),
            ],
            [
                'id' => 3,
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user123'),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'role' => 'user',
                'remember_token' => str_random(10),
            ]
        ]);

        factory(User::class, 27)->create();
    }
}
