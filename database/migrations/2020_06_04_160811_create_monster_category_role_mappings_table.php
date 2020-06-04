<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonsterCategoryRoleMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monster_category_role_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('category_function_name')->nullable();
            $table->integer('role_id')->nullable();
            $table->string('role_name')->nullable();
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
        Schema::dropIfExists('monster_category_role_mappings');
    }
}
