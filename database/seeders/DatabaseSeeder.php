<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::create([
            'name' => 'admin@gmail.com',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin@gmail.com'),
            'admin' => 2,
            'subscribed'=>1,
        ]);
        User::create([
            'name' => 'macha3402@gmail.com',
            'email' => 'macha3402@gmail.com',
            'password' => bcrypt('macha3402@gmail.com'),
            'admin'=>0,
            'subscribed'=>1,
        ]);
        User::create([
            'name' => 'editor@gmail.com',
            'email' => 'editor@gmail.com',
            'password' => bcrypt('editor@gmail.com'),
            'admin' => 1,
            'subscribed'=>1,
        ]);
        User::create([
            'name'=>"Gabi",
            'email'=>'marin.gabriel.ionut27@gmail.com',
            'password' => bcrypt('marin.gabriel.ionut27@gmail.com'),
            'admin' => 2,
            'subscribed'=>1,
        ]);
        User::create([
            'name' => $this->generateRandomName(),
            'email' => $this->generateRandomEmail(),
            'password' => bcrypt('password'),
            'admin' => 0,
            'subscribed'=>1,
        ]);
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => $this->generateRandomName(),
                'email' => $this->generateRandomEmail(),
                'password' => bcrypt('password'),
                'admin' => 0,
                'subscribed'=>1,
            ]);
            Subscription::create([
                'user_id'=>$i
            ]);
        }


    }
    private function generateRandomName()
    {
        $faker = \Faker\Factory::create();
        return $faker->firstName . ' ' . $faker->lastName;
    }

    private function generateRandomEmail()
    {
        $faker = \Faker\Factory::create();
        return $faker->unique()->safeEmail;
    }
}
