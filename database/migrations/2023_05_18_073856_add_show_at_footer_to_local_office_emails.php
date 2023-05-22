<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowAtFooterToLocalOfficeEmails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('local_office_emails', function (Blueprint $table) {
            $table->boolean('show_at_footer')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('local_office_emails', function (Blueprint $table) {
            $table->dropColumn('show_at_footer');
        });
    }
}
