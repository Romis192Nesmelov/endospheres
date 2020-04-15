<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('articles', function (Blueprint $table) {
//            $table->increments('id');
//
//            $table->string('title')->nullable();
//            $table->longText('meta_description')->nullable();
//            $table->longText('meta_keywords')->nullable();
//            $table->string('meta_twitter_card')->nullable();
//            $table->string('meta_twitter_size')->nullable();
//            $table->string('meta_twitter_creator')->nullable();
//            $table->string('meta_og_url')->nullable();
//            $table->string('meta_og_type')->nullable();
//            $table->string('meta_og_title')->nullable();
//            $table->longText('meta_og_description')->nullable();
//            $table->string('meta_og_image')->nullable();
//            $table->string('meta_robots')->nullable();
//            $table->string('meta_googlebot')->nullable();
//            $table->string('meta_google_site_verification')->nullable();
//
//            $table->string('slug');
//            $table->string('head');
//            $table->longText('content');
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
//        Schema::drop('articles');
    }
}
