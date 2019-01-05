<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductsCategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(ProductsAttributesNamesTableSeeder::class);
        $this->call(ProductsAttributesValuesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(PartnersTableSeeder::class);
        $this->call(RecordsTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
    }
}
