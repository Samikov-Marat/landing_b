<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalOfficeTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_office_texts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('local_office_id');
            $table->foreignId('language_id');
            $table->text('name');
            $table->text('address');
            $table->text('path');
            $table->text('worktime');
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
        Schema::dropIfExists('local_office_texts');
    }
}
