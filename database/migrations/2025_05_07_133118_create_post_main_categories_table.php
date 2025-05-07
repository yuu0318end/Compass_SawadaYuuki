<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostMainCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_main_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('post_id')->index()->comment('投稿のid');
            $table->integer('main_category_id')->unsigned()->index()->comment('メインカテゴリーid');
            $table->timestamp('created_at')->nullable()->comment('登録日時');

            // 外部キー制約の追加
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('main_category_id')->references('id')->on('main_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_main_categories');
    }
};
