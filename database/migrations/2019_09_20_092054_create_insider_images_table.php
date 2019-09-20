<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsiderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insider_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('insider_id');
            $table->foreign('insider_id')
                ->references('id')
                ->on('insiders')
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
        Schema::dropIfExists('insider_images');
    }
}
