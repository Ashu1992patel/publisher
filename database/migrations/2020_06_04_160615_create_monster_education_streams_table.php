<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonsterEducationStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monster_education_streams', function (Blueprint $table) {
            $table->id();
            $table->integer('stream_id')->nullable()->comment('Stream Id');
            $table->string('specialization')->nullable()->comment('Specialization');
            $table->integer('level_id')->nullable()->comment('Level Id');
            $table->string('degree')->nullable()->comment('Degree');
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
        Schema::dropIfExists('monster_education_streams');
    }
}
