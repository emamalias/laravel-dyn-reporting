<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Meta;

class UsersMetaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();
    	Meta::truncate();
        $users = User::all();

        foreach($users as $user) {
        	$user->meta()->saveMany([
        		new Meta([
        			'name' => 'first_name',
        			'label' => 'First Name',
        			'value' => $faker->firstName
        		]),
        		new Meta([
        			'name' => 'last_name',
        			'label' => 'Last Name',
        			'value' => $faker->lastName
        		]),
        	]);
        }
    }
}
