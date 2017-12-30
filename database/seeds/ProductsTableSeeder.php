<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Model\Products');
        for ($i = 0; $i < 3; $i++) {
            DB::table('products')->insert([
                'shop_id' => 1,
                'name' => $faker->word(),
                'quantity' => $faker->numberBetween($min = 1, $max = 10),
                'price' => $faker->numberBetween($min = 225, $max = 544),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}