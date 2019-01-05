<?php

use Faker\Generator as Faker;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

$factory->define(App\Partner::class, function (Faker $faker) {
    $output = [];
    foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
    {
        $output['title'.strtoupper($code)] = $faker->word;
    }
    return $output;
});
