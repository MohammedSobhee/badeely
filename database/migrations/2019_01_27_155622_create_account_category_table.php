<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_category', function (Blueprint $table) {

            $table->unsignedInteger('category_id');
            $table->unsignedInteger('account_id');

            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('cascade');

            $table->foreign('account_id')->references('id')
                ->on('accounts')->onDelete('cascade');

            $table->primary(['category_id','account_id']);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_category');
    }
}
