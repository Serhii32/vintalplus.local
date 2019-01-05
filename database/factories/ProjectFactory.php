<?php

use Faker\Generator as Faker;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

$factory->define(App\Project::class, function (Faker $faker) {
    $output = [];
    foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
    {
        $output['title'.strtoupper($code)] = $faker->word;
        $output['short_description'.strtoupper($code)] = $faker->paragraph(1, true);
        $output['description'.strtoupper($code)] = $faker->paragraph(4, true);
    }
    return $output;
});
