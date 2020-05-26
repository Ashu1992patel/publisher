<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_positions', function (Blueprint $table) {
            $table->id();
            $table->string('clientId')->nullable();
            $table->string('positionState')->nullable();
            $table->string('positionCity')->nullable();
            $table->string('positionName')->nullable();
            $table->dateTime('closeDate')->nullable();
            $table->string('openings')->nullable();
            $table->string('location')->nullable();
            $table->string('skillSet')->nullable();
            $table->string('job_description')->nullable();
            $table->string('minYearExp')->nullable();
            $table->string('maxYearExp')->nullable();
            $table->string('eduQualification')->nullable();
            $table->string('minSalary')->nullable();
            $table->string('maxSalary')->nullable();
            $table->string('jobType')->nullable();
            $table->string('industry')->nullable();
            $table->string('level')->nullable();
            $table->string('gender')->nullable();
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
        Schema::dropIfExists('job_positions');
    }
}
