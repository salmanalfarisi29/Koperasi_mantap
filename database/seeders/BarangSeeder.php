<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $faker = Faker::create('id_ID');
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

    	for($i = 1; $i <= 2000; $i++){

        \DB::table('products')->insert([
            'code' => $faker->unique()->text(13),
        	'product_name' => $faker->foodName(),
        	'quantity' => $faker->numberBetween(5,100),
        	'price' => $faker->numberBetween(500,100000)
        ]);
    }
}
}