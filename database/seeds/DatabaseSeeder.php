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

        factory('App\Account', 10)->create();
    }
}
