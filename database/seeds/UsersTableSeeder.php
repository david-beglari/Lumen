<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'Test User',
            'email' => 'testUser@test.com',
            'password' => \Illuminate\Support\Facades\Hash::make('secret')
        ];
        \DB::table('users')->insert($user);
    }
}