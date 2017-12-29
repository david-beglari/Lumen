<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('ShopsTableSeeder');
        $this->command->info('Shops table seeded!');
        $this->call('ProductsTableSeeder');
        $this->command->info('Products table seeded!');
    }
}
