<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonsterIndustryCategoryMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monster_industry_category_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('industry_name')->nullable();
            $table->integer('category_function_id')->nullable();
            $table->string('category_function_name')->nullable();
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
        Schema::dropIfExists('monster_industry_category_mappings');
    }
}
