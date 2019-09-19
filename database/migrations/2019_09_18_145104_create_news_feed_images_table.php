<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsFeedImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_feed_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('news_feed_id');
            $table->foreign('news_feed_id')
                ->references('id')
                ->on('news_feed')
                ->onDelete('cascade');
            $table->string('image_path');

            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('news_feed_images');
    }
}
