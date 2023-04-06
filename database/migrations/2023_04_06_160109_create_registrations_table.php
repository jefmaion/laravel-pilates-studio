<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('modality_id');
            $table->integer('duration')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->integer('class_per_week')->nullable();
            $table->integer('due_day')->nullable();
            $table->decimal('value')->nullable();
            $table->string('description')->nullable();
            $table->text('comments')->nullable();

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('modality_id')->references('id')->on('modalities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
