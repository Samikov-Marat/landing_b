<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalOfficePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_office_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('local_office_id');
            $table->string('sample')->nullable();
            $table->string('sample2')->nullable();
            $table->string('mobile')->nullable();
            $table->string('mobile2')->nullable();
            $table->string('tablet')->nullable();
            $table->string('tablet2')->nullable();
            $table->bigInteger('sort');
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
        Schema::dropIfExists('local_office_photos');
    }
}
