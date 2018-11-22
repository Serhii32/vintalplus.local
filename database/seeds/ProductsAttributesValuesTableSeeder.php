<?php

use Illuminate\Database\Seeder;

class ProductsAttributesValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ProductsAttributesValue::class, 10)->create();
    }
}
