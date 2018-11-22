<?php

use Faker\Generator as Faker;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

$factory->define(App\ProductsAttributesValue::class, function (Faker $faker) {
    $output = [];
    foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
    {
        $output['value'.strtoupper($code)] = $faker->unique()->word;
    }
    return $output;
});
