<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonsterPostedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monster_posted_jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('job_id')->nullable();
            $table->integer('industry_id')->nullable();
            $table->integer('category_function_id')->nullable();
            $table->integer('category_role_id')->nullable();
            $table->integer('monster_education_level_id')->nullable();
            $table->integer('monster_education_stream_id')->nullable();
            $table->integer('monster_location_id')->nullable();
            $table->integer('monster_location_id')->nullable();
            $table->integer('is_sent')->nullable();
            $table->tinyInteger('is_active')->nullable();
            $table->date('expire_on')->nullable();
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
        Schema::dropIfExists('monster_posted_jobs');
    }
}
