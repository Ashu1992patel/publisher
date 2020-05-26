<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialCrendentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_crendentials', function (Blueprint $table) {
            $table->id();
            $table->string('social_plateform_name')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->longText('profile_picture_path')->nullable();
            $table->longText('access_token')->nullable();
            $table->timestamp('expires_in')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('social_crendentials');
    }
}
