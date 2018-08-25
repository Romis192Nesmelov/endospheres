<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubChapterIdToMassMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('mass_media', function (Blueprint $table) {
//            $table->integer('sub_chapter_id', false, true);
//            $table->foreign('sub_chapter_id')->references('id')->on('sub_chapters')->onDelete('cascade')->onUpdate('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('mass_media', function (Blueprint $table) {
//            $table->dropForeign('mass_media_sub_chapter_id_foreign');
//            $table->dropColumn('sub_chapter_id');
//        });
    }
}
