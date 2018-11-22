<?php

use Faker\Generator as Faker;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

$factory->define(App\ProductsAttributesName::class, function (Faker $faker) {
    $output = [];
    foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
    {
        $output['name'.strtoupper($code)] = $faker->unique()->word;
    }
    return $output;
});
