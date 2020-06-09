de=<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateJobToClickIndiasTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('job_to_click_indias', function (Blueprint $table) {
                $table->id();
                $table->integer('job_id')->nullable();
                $table->integer('response')->nullable();
                $table->integer('views')->nullable();
                $table->tinyInteger('is_posted')->nullable();
                $table->integer('update_count')->nullable();
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
            Schema::dropIfExists('job_to_click_indias');
        }
    }
