<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMapPresetToLocalOfficesTable extends Migration
{
    public function up()
    {
        Schema::table('local_offices', function (Blueprint $table) {
            $table->text('map_preset');
        });
    }

    public function down()
    {
        Schema::table('local_offices', function (Blueprint $table) {
            $table->dropColumn('map_preset');
        });
    }
}
