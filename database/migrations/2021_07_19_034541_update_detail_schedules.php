<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDetailSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_schedulues', function (Blueprint $table) {
            // $table->time('begin')->nullable(true)->after("phone_number");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_schedulues', function (Blueprint $table) {
            // $table->string('photo_profil')->nullable(true)->after("phone_number");
        });
    }
}
