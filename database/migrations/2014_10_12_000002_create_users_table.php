\<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

//            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('mobile')->unique()->nullable();

            $table->enum('gender',['male','female']);
            $table->string('age');

            $table->string('image')->nullable();

            $table->string('password');
            $table->string('register_by');
            $table->string('device_token')->nullable();
            $table->string('ip')->nullable();
            $table->string('language')->nullable();

//            $table->integer('rate')->default(0);

            $table->unsignedInteger('country_id')->nullable();


            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
