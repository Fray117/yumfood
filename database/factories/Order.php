<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
	$random_tags = \App\Tag::whereIn('name', [
        \App\Interfaces\TagInterface::MEAT,
        \App\Interfaces\TagInterface::FISH,
    ])->get();

	$faker_data = [
		'dishes_id' => $faker->randomElement($random_tags),
        'customer' => $faker->name,
        'quantity' => rand(0, 5),
		'notes' => $faker->text,
    ];

	return $faker_data;
});
