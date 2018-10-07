<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('devices', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('slug');
//            $table->string('slide');
//            $table->string('home_page_image');
//            $table->string('menu_logo');
//            $table->string('head_ru');
//            $table->string('head_en');
//            $table->string('name');
//            $table->string('image');
//            $table->text('description_ru');
//            $table->text('description_en')->nullable();
//            $table->longText('content_ru');
//            $table->longText('content_en')->nullable();
//            $table->boolean('is_new');
//            $table->string('booklet');
//            $table->string('catalogue');
//            $table->boolean('active');
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::drop('devices');
    }
}
