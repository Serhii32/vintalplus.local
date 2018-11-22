<?php

use Illuminate\Database\Seeder;

class ProductsAttributesNamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ProductsAttributesName::class, 10)->create();
    }
}
