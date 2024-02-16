<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUuidToOfficesTable extends Migration
{
    public function up()
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->uuid('uuid')
                ->index();
        });
    }

    public function down()
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
}
