<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->string('poster');
            $table->string('head_ru');
            $table->string('head_en');
            $table->text('description_ru');
            $table->text('description_en');
            $table->string('background_color');
            $table->string('mouse_color');
            $table->boolean('is_image');
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('slides');
    }
}
