<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        User::truncate();
        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            User::create([
                'email' => $faker->unique()->email,
                'password' => bcrypt('secret'),
            ]);
        }
    }
}
