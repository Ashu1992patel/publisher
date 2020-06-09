<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shines', function (Blueprint $table) {
            $table->id();
            $table->integer('job_id')->nullable();
            $table->integer('city_grouping_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('industry_id')->nullable();
            $table->integer('experience_lookup_id')->nullable();
            $table->integer('salary_id')->nullable();
            $table->integer('study_field_grouping_id')->nullable();
            $table->integer('study_id')->nullable();
            $table->integer('functional_area_id')->nullable();
            $table->longText('response')->nullable();
            $table->integer('update_count')->default(0);
            $table->tinyInteger('is_sent')->default(0);
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
        Schema::dropIfExists('shines');
    }
}
