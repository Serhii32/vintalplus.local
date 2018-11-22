<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('priority')->default(0);
            foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
            {
                $table->string('title'.strtoupper($code));
                $table->text('short_description'.strtoupper($code))->nullable();
                $table->string('titleSEO'.strtoupper($code))->nullable();
                $table->text('descriptionSEO'.strtoupper($code))->nullable();
                $table->string('keywordsSEO'.strtoupper($code))->nullable();
            }
            $table->string('photo')->nullable();
            $table->integer('parent_id')->default(0);
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
        Schema::dropIfExists('products_categories');
    }
}
