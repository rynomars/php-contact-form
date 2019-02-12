<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\ContactUs::class, function (Faker $faker) {
    return [
        "full_name" => $faker->name,
        "email"     => $faker->email,
        "phone"     => $faker->phoneNumber,
        "message"   => $faker->paragraphs(3, true)
    ];
});