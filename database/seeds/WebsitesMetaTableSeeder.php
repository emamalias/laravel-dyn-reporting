<?php

use Illuminate\Database\Seeder;
use App\Website;

class WebsitesMetaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $websites = Website::all();

        foreach($websites as $website) {
        	$website->meta()->create([
    			'name' => 'domain',
    			'label' => 'Domain',
    			'value' => $faker->domainName
        	]);
        }
    }
}
