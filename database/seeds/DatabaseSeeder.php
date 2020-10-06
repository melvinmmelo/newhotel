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
            'password' => Hash::make('secret'),
            'type' => 'SYSTEM ADMIN'
        ]);

        App\User::create([
            'name' => 'Shiela Posugac',
            'email' => 'shiela.po@gmail.com',
            'password' => Hash::make('secret'),
            'type' => 'FRONT DESK'
        ]);

        App\User::create([
            'name' => 'RICHARD CAGUE',
            'email' => 'rich.cague@gmail.com',
            'password' => Hash::make('secret'),
            'type' => 'STUDENT'
        ]);

        App\Room::create([
            'no' => '200',
            'floor' => '1',
            'type' => 'STANDARD',
            'capacity' => 5,
            'default_amount' => 500,
            'user_id' => 1
        ]);

        App\Room::create([
            'no' => '201',
            'floor' => '1',
            'type' => 'STANDARD',
            'capacity' => 5,
            'default_amount' => 1000,
            'user_id' => 1
        ]);

        // App\RoomType::create([
        //     'room_category' => 'STANDARD',
        //     'amount' => '500.00',
        //     'user_id' => 1
        // ]);
        // App\RoomType::create([
        //     'room_category' => 'PREMIUM',
        //     'amount' => '750.00',
        //     'user_id' => 1
        // ]);

        // App\RoomType::create([
        //     'room_category' => 'SUITE',
        //     'amount' => '100.00',
        //     'user_id' => 1
        // ]);

        App\Transaction::create([
            'code' => '7011',
            'accounting_side' => 'DEBIT',
            'memo' => 'ROOM',
            'local_tax' => '10',
            'local_tax_inclusive' => '0',
            'govt_tax' => '10',
            'govt_tax_inclusive' => '0',
            'service_charge' => '10',
            'service_charge_inclusive' => '0',
            'warning_amount' => '500',
            'default_amount' => '1000',
            'user_id' => 1
        ]);


        factory('App\Account', 10)->create();
    }
}
