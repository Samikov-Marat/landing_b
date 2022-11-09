<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubdomainColumnToLocalOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('local_offices', function (Blueprint $table) {
            $table->string('subdomain')
                ->nullable(false)
                ->default('');
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
            $table->dropColumn('subdomain');
        });
    }
}
