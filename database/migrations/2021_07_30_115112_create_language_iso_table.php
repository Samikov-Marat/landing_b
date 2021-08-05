<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguageIsoTable extends Migration
{

    // Коды языков в браузере ISO 639-1
    // https://id.loc.gov/vocabulary/iso639-1.html

    public function up()
    {
        Schema::create('language_iso', function (Blueprint $table) {
            $table->string('code_iso', 2)->primary();
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('language_iso');
    }
}
