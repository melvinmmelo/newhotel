<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        App\User::create([
            'name' => 'Melvin Melo',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('secret')
        ]);

        App\Room::create([
            'no' => '1',
            'floor' => '1',
            'type' => 'Standard',
            'capacity' => 5,
            'default_amount' => 500,
            'user_id' => 1
        ]);

        App\Room::create([
            'no' => '2',
            'floor' => '1',
            'type' => 'Standard',
            'capacity' => 5,
            'default_amount' => 1000,
            'user_id' => 1
        ]);

        factory('App\Account', 10)->create();
    }
}
