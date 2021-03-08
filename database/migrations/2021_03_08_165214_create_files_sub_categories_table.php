<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('href');
            $table->unsignedInteger('files_category_id');
            $table->foreign('files_category_id')->references('id')->on('files_categories');
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
        Schema::dropIfExists('files_sub_categories');
    }
}
