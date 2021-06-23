<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopOfficeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_office_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('top_office_id');
            $table->foreignId('top_office_language_id');
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
        Schema::dropIfExists('top_office_translations');
    }
}
