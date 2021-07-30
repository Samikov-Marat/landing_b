<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexCodeToOfficesTable extends Migration
{
    public function up()
    {
        Schema::table(
            'offices',
            function (Blueprint $table) {
                $table->index('code', 'offices_code_index');
            }
        );
    }

    public function down()
    {
        Schema::table(
            'offices',
            function (Blueprint $table) {
                $table->dropIndex('offices_code_index');
            }
        );
    }
}
