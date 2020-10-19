<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {

            $table->increments('id');
            $table->text('images')->nullable();
            $table->string('mobile')->nullable();

            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('account_type')->nullable();

            $table->string('insta_url')->nullable();

            $table->text('tags')->nullable();
            $table->text('note')->nullable();

            $table->integer('rate')->default(0);
            $table->integer('views')->default(0);
            $table->integer('clicks')->default(0);
            $table->integer('instagram_clicks')->default(0);

            $table->date('featured_from')->nullable();
            $table->date('featured_to')->nullable();
            $table->boolean('is_featured_before')->default(0);

            $table->date('started_at')->nullable();
            $table->date('expire_at')->nullable();

            $table->integer('priority')->default(0);
            $table->boolean('seen')->default(1);
            $table->boolean('status')->default(0);

            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('set null');

            $table->foreign('country_id')->references('id')
                ->on('countries')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
