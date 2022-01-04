<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFestivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festivities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('month');
            $table->string('tag');
            $table->string('local');
            $table->text('desc');
            $table->string('first_img')->nullable();
            $table->string('second_img')->nullable();
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
        Schema::dropIfExists('festivities');
    }
}
