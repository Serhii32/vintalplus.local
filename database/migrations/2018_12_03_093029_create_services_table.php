<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('main_photo')->nullable();
            foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
            {
                $table->string('title'.strtoupper($code));
                $table->text('short_description'.strtoupper($code))->nullable();
                $table->text('description'.strtoupper($code))->nullable();
                $table->string('titleSEO'.strtoupper($code))->nullable();
                $table->text('descriptionSEO'.strtoupper($code))->nullable();
                $table->string('keywordsSEO'.strtoupper($code))->nullable();
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
