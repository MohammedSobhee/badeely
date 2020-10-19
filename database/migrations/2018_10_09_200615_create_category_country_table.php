<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_country', function (Blueprint $table) {

            $table->unsignedInteger('category_id');
            $table->unsignedInteger('country_id');

            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('cascade');

            $table->foreign('country_id')->references('id')
                ->on('countries')->onDelete('cascade');

            $table->primary(['category_id','country_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_country');
    }
}
