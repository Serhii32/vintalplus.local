<?php

use Faker\Generator as Faker;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

$factory->define(App\ProductsCategory::class, function (Faker $faker) {
    $output = [];
    foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
    {
        $output['title'.strtoupper($code)] = $faker->word;
        $output['short_description'.strtoupper($code)] = $faker->paragraph(1, true);
        $output['titleSEO'.strtoupper($code)] = $faker->word;
        $output['descriptionSEO'.strtoupper($code)] = $faker->paragraph(1, true);
        $output['keywordsSEO'.strtoupper($code)] = $faker->words(5, true);
    }
    return $output;
});
