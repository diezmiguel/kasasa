<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Loan;
use Faker\Generator as Faker;

$factory->define(Loan::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'ssn' => 123456789,
        'dob' => '2021-10-10',
        'loan_amount' => 1000,
        'rate' => 2.25,
        'type' => 'auto',
        'term' => 720,
        'apr' => 12,
    ];
});
