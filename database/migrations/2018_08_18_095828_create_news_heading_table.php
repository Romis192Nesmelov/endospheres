<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsHeadingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_headings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('slide')->nullable();
            $table->string('subscribe_ru');
            $table->string('subscribe_en')->nullable();
            $table->string('head_ru');
            $table->string('head_en')->nullable();
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
        Schema::drop('news_headings');
    }
}
