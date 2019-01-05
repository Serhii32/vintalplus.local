<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CreateSEOPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_e_o__pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('page');
            foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
            {
                $table->string('titleSEO'.strtoupper($code))->nullable();
                $table->text('descriptionSEO'.strtoupper($code))->nullable();
                $table->string('keywordsSEO'.strtoupper($code))->nullable();
            }
            $table->timestamps();
        });
        Artisan::call('db:seed', ['--class' => PagesSEOTableSeeder::class,]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_e_o__pages');
    }
}
