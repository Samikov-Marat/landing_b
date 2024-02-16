<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSourceToOfficesTable extends Migration
{
    public function up()
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->boolean('from_esb')
                ->nullable(false)
                ->default(false);
        });
    }

    public function down()
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->dropColumn('from_esb');
        });
    }
}
