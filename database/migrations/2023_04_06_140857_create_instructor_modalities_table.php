<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorModalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_modalities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('instructor_id');
            $table->unsignedBigInteger('modality_id');
            $table->integer('enabled')->default(1);
            
            $table->string('remuneration_type', 3)->nullable();
            $table->float('remuneration_value')->nullable();
            $table->integer('calc_on_absense')->default(0);

            $table->foreign('instructor_id')->references('id')->on('instructors');
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
        Schema::dropIfExists('instructor_modalities');
    }
}
