<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStudentPayments2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_paymetns', function (Blueprint $table) {
            $table->string('month')->after('student_id');
            $table->string('payment_proof')->nullable(true)->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_paymetns', function (Blueprint $table) {
            $table->dropColumn(['month','payment_proof']);
        });
    }
}
