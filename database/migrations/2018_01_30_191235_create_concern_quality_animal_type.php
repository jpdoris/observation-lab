<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcernQualityAnimalType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concern_quality_animal_type', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('concern_quality_id');
            $table->integer('animal_type_id');
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
        Schema::dropIfExists('concern_quality_animal_type');
        Schema::dropIfExists('concern_quality_animal_types');
    }
}
