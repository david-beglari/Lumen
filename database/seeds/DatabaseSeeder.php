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
        $this->call('UsersTableSeeder');
        $this->command->info('Users table seeded!');
        $this->call('ShopsTableSeeder');
        $this->command->info('Shops table seeded!');
        $this->call('ProductsTableSeeder');
        $this->command->info('DB successfully seeded!');
    }
}
