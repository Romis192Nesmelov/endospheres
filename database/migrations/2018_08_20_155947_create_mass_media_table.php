<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMassMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mass_media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('preview');
            $table->string('full');
            $table->longText('description_ru');
            $table->longText('description_en')->nullable();
            $table->boolean('is_pdf');
            $table->integer('year');
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
        Schema::drop('mass_media');
    }
}
