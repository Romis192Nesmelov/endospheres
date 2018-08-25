<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChapterIdToNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('news', function (Blueprint $table) {
//            $table->integer('chapter_id', false, true);
//            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade')->onUpdate('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('news', function (Blueprint $table) {
//            $table->dropForeign('news_chapter_id_foreign');
//            $table->dropColumn('chapter_id');
//        });
    }
}
