<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->enum('gender',['L','P']);
            $table->date('dob');
            $table->string('pob');
            $table->string('address');
            $table->string('email')->unique()->nullable(true);
            $table->string('phone_number')->unique()->nullable(true);
            $table->string('parent_name');
            $table->string('parent_address');
            $table->string('parent_phone_number');
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
        Schema::dropIfExists('students');
    }
}
