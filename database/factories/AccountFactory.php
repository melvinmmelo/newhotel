<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->title('Mr.'|'Mrs.'),
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'middle_name' => "",
        'account_name' => $faker->lastName . " " .$faker->firstName,
        'gender' => "male",
        'citizenship' => 'FILIPINO',
        'passport_id' => '0102451454',
        'birth_date' => $faker->date(),
        'threshold_amount' => "2000.00",
        'account_type' => 'INDIVIDUAL',
        'telephone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'address_street' => $faker->streetAddress,
        'address_city' => $faker->city,
        'country' => $faker->country,
        'zip' => "4200",
        'email' => $faker->email,
        'credit_card_type' => $faker->creditCardType,
        'credit_card_no' => $faker->creditCardNumber(),
        'credit_card_exp_date' => $faker->creditCardExpirationDate,
        'user_id' => 1,
    ];
});
