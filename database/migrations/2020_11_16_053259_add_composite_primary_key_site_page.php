<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompositePrimaryKeySitePage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_page', function (Blueprint $table) {
            $table->primary(['site_id', 'page_id'], 'site_id_page_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_page', function (Blueprint $table) {
            $table->dropPrimary();
        });
    }
}
