<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('registration_id')->nullable();

            $table->date('date')->nullable();
            $table->decimal('value')->nullable();
            $table->decimal('fees')->nullable()->default(0);
            $table->decimal('amount')->nullable()->default(0);
            $table->integer('status')->default(0);
            $table->date('pay_date')->nullable();

            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('registration_id')->references('id')->on('registrations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('installments');
    }
}
