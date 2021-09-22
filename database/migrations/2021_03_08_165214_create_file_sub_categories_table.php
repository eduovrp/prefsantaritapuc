<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('href');
            $table->string('single_name');
            $table->unsignedInteger('file_category_id');
            $table->foreign('file_category_id')->references('id')->on('file_categories');
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
        Schema::dropIfExists('file_sub_categories');
    }
}
