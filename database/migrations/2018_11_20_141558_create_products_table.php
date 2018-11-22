<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('priority')->default(0);
            $table->decimal('price', 10, 2)->nullable();
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
            $table->integer('category_id')->nullable()->unsigned();
            $table->foreign('category_id')->references('id')->on('products_categories');
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
        Schema::dropIfExists('products');
    }
}
