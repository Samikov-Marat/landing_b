<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHashToTopOfficeWorldLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('top_office_world_language', function (Blueprint $table) {
            $table->string('office_hash')->after('work_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('top_office_world_language', function (Blueprint $table) {
            $table->dropColumn('office_hash');
        });
    }
}
