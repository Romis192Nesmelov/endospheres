<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('questions', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('question_ru');
//            $table->string('question_en')->nullable();
//            $table->longText('answer_ru');
//            $table->longText('answer_en')->nullable();
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
//        Schema::drop('questions');
    }
}
