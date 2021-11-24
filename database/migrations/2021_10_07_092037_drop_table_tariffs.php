<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTableTariffs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tariffs');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('tariffs', function (Blueprint $table) {
            $table->id();
            $table->string('name_ru');
            $table->string('description_ru');
            $table->string('type_ru');

            $table->string('name_en');
            $table->string('description_en');
            $table->string('type_en');
            $table->timestamps();
        });
    }
}
