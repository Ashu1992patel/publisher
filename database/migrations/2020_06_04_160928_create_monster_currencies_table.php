<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonsterCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monster_currencies', function (Blueprint $table) {
            $table->id()->comment('Currency Id');
            $table->string('currency_code')->nullable()->comment('Currency Code');
            $table->string('currency_name')->nullable()->comment('Currency Name');
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
        Schema::dropIfExists('monster_currencies');
    }
}
