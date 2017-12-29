<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Model\Shops');
        for ($i = 0; $i < 4; $i++) {
            DB::table('shops')->insert([
                'name' => $faker->word(),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}