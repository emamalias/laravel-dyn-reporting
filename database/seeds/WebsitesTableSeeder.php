<?php

use Illuminate\Database\Seeder;
use App\Website;
use App\User;

class WebsitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        Website::truncate();

        $users = User::all();

        foreach($users as $user) {
        	$website = new Website([]);
        	$user->websites()->save($website);
        }
    }
}
