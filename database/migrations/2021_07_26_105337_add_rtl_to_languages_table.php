<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRtlToLanguagesTable extends Migration
{
    public function up()
    {
        Schema::table(
            'languages',
            function (Blueprint $table) {
                $table->boolean('rtl')
                    ->default(false)
                    ->nullable(false);
            }
        );
    }

    public function down()
    {
        Schema::table(
            'languages',
            function (Blueprint $table) {
                $table->dropColumn('rtl');
            }
        );
    }
}
