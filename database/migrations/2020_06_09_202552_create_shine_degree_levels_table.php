<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShineDegreeLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shine_degree_levels', function (Blueprint $table) {
            $table->id();
            $table->integer('study_field_grouping_id')->nullable();
            $table->string('study_field_grouping_desc')->nullable();
            $table->integer('study_id')->nullable();
            $table->string('study_desc')->nullable();
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
        Schema::dropIfExists('shine_degree_levels');
    }
}
