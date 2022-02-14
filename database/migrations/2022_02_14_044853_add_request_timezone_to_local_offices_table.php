<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequestTimezoneToLocalOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('local_offices', function (Blueprint $table) {
            $table->string('request_timezone', 30)
                ->default('0')
                ->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('local_offices', function (Blueprint $table) {
            $table->dropColumn('request_timezone');
        });
    }
}
