<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFestivityImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festivity_images', function (Blueprint $table) {
            $table->id();
            $table->string('src');
            $table->string('folderName')->nullable();
            $table->string('fileName')->nullable();
            $table->unsignedInteger('festivity_id');
            $table->foreign('festivity_id')->references('id')->on('festivities');
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
        Schema::dropIfExists('festivity_images');
    }
}
