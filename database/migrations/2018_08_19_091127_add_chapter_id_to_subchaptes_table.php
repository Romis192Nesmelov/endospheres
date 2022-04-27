<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChapterIdToSubchaptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('sub_chapters', function (Blueprint $table) {
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
//        Schema::table('sub_chapters', function (Blueprint $table) {
//            $table->dropForeign('sub_chapters_chapter_id_foreign');
//            $table->dropColumn('chapter_id');
//        });
    }
}
