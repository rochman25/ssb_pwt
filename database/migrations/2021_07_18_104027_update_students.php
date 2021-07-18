<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->date('register_date')->after('parent_phone_number');
            $table->enum('status',['acc','fail','pending'])->after('register_date');
            $table->string('photo_profil')->nullable(true)->after("status");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table){
            $table->dropColumn(['register_date','status','photo_profil']);
        });
    }
}
