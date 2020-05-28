<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_title')->nullable();
            $table->string('designation')->nullable();
            $table->timestamp('expire_on')->nullable();
            $table->string('job_type')->nullable();
            $table->string('vacancies')->nullable();
            $table->string('salary_type')->nullable();
            $table->string('minimum_salary')->nullable();
            $table->string('maximum_salary')->nullable();
            $table->longText('job_description')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('company_url')->nullable();
            $table->string('company_location')->nullable();
            $table->longText('company_description')->nullable();
            $table->longText('other')->nullable();
            $table->longText('apply_button_url')->nullable();
            $table->integer('click_india_job_category_id')->nullable();
            $table->integer('click_india_city_id')->nullable();
            $table->string('click_india_minimum_qualification')->nullable();
            $table->string('click_india_minimum_experience')->nullable();
            $table->string('click_india_working_days')->nullable();
            $table->string('click_india_required_candidate')->nullable();
            $table->string('click_india_hiring_process')->nullable();
            $table->tinyInteger('is_active')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
