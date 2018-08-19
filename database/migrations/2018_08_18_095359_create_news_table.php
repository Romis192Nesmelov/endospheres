<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('slide')->nullable();
            $table->string('head_ru');
            $table->string('head_en')->nullable();
            $table->longText('description_ru');
            $table->longText('description_en')->nullable();
            $table->longText('content_ru');
            $table->longText('content_en')->nullable();
            $table->integer('time');
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
        Schema::drop('news');
    }
}
