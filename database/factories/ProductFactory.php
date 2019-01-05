<?php

use Faker\Generator as Faker;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

$factory->define(App\Product::class, function (Faker $faker) {
    $output = [
    	'price' => $faker->randomFloat(2, 0, 1000000),
    	'category_id' => $faker->biasedNumberBetween(1, 6),
	];
    foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
    {
        $output['title'.strtoupper($code)] = $faker->word;
        $output['short_description'.strtoupper($code)] = $faker->paragraph(1, true);
        $output['description'.strtoupper($code)] = $faker->paragraph(5, true);
    }
    return $output;
});
