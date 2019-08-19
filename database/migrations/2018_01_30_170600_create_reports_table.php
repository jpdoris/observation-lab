<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status_id')->nullable();
            $table->integer('assigned_to')->nullable();
            $table->integer('patient_id');
            $table->smallInteger('animal_type_id');
            $table->smallInteger('animal_subtype_id');
            $table->smallInteger('building_id');
            $table->smallInteger('room_id');
            $table->integer('owner_id');
            $table->integer('study_id');
            $table->integer('concern_quality_id');
            $table->integer('concern_location_id')->nullable();
            $table->smallInteger('reporter_id');
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
        Schema::dropIfExists('reports');
    }
}
