<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

    for ($i = 1; $i <= 1000; $i++) {

      DB::table('products')->insert([
        'code' => IdGenerator::generate(['table' => 'products', 'field' => 'code', 'length' => 8, 'prefix' => 'M']),
        'product_name' => $faker->foodName(),
        'quantity' => $faker->numberBetween(5, 100),
        'price' => $faker->numberBetween(5000, 100000)
      ]);
    }
  }
}
