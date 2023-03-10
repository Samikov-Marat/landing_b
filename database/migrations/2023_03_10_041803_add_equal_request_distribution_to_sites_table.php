<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEqualRequestDistributionToSitesTable extends Migration
{
    public function up()
    {
        Schema::table('sites', function (Blueprint $table) {
            // Равномерное распределение заявок по категориям
            // независимо от кол-ва офисов у франчайзи
            $table->boolean('equal_request_distribution')
                ->default(false)
                ->nullable(false);
        });
    }

    public function down()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->dropColumn('equal_request_distribution');
        });
    }
}
