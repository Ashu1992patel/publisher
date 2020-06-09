<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShineSalaryRangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shine_salary_ranges', function (Blueprint $table) {
            $table->id();
            $table->integer('salary_id')->nullable();
            $table->string('text_value')->nullable();
            $table->string('text_value_hr')->nullable();
            $table->string('text_value_min')->nullable();
            $table->string('text_value_max')->nullable();
            $table->string('text_to_display')->nullable();
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
        Schema::dropIfExists('shine_salary_ranges');
    }
}
