<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewsHeadingIdToNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('news', function (Blueprint $table) {
//            $table->integer('news_heading_id', false, true);
//            $table->foreign('news_heading_id')->references('id')->on('news_headings')->onDelete('cascade')->onUpdate('cascade');
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
//            $table->dropForeign('news_news_heading_id_foreign');
//            $table->dropColumn('news_heading_id');
//        });
    }
}
