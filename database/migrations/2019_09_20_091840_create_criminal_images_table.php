<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCriminalImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criminal_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('criminal_id');
            $table->foreign('criminal_id')
                ->references('id')
                ->on('criminals')
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
        Schema::dropIfExists('criminal_images');
    }
}
