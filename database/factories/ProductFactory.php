<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'description'=>$faker->sentence,
        'price'=>$faker->randomFloat(2,0,999),
        'category_id' => $faker->numberBetween(1,5),
        'created_at'=> $faker->dateTime,
        'updated_at'=> $faker->dateTime,
    ];
});
