<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLanguageCodeIsoToLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'languages',
            function (Blueprint $table) {
                $table->string('language_code_iso', 3)
                    ->after('shortname')
                    ->default('');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'languages',
            function (Blueprint $table) {
                $table->dropColumn('language_code_iso');
            }
        );
    }
}
