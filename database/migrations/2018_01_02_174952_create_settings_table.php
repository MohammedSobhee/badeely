<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key');
            $table->text('value')->nullable();
            $table->string('type');

            $table->primary('key');
        });

        DB::table('settings')->insert([
            ['key' => 'website_name', 'value' => 'Badeely App', 'type' => 'system'],
            ['key' => 'website_description', 'value' => 'هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس ع ▶', 'type' => 'system'],
            ['key' => 'website_mobile', 'value' => '974 0000000', 'type' => 'system'],
            ['key' => 'website_email', 'value' => 'info@showme.com', 'type' => 'system'],
            ['key' => 'facebook', 'value' => 'https://www.facebook.com', 'type' => 'system'],
            ['key' => 'twitter', 'value' => 'https://twitter.com', 'type' => 'system'],
            ['key' => 'instagram', 'value' => 'https://www.instagram.com', 'type' => 'system'],
            ['key' => 'youtube', 'value' => 'https://www.youtube.com', 'type' => 'system'],
            ['key' => 'google_play', 'value' => 'https://play.google.com/store', 'type' => 'system'],
            ['key' => 'appstore', 'value' => 'https://www.apple.com/ios/app-store', 'type' => 'system'],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
