<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('chapters', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('slug');
//            $table->string('slide')->nullable();
//            $table->string('subscribe_ru');
//            $table->string('subscribe_en')->nullable();
//            $table->string('head_ru');
//            $table->string('head_en');
//            $table->longText('content_ru');
//            $table->longText('content_en')->nullable();
//            $table->boolean('have_a_video');
//            $table->boolean('have_a_files');
//            $table->boolean('have_a_sheet');
//            $table->boolean('have_a_questions');
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
//        Schema::drop('chapters');
    }
}
