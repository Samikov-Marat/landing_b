<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeValidToTypeCertificateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificate_checks', function (Blueprint $table) {
            $table->dropColumn('valid_to');
        });
        Schema::table('certificate_checks', function (Blueprint $table) {
            $table->timestamp('valid_to')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificate_checks', function (Blueprint $table) {
            $table->dropColumn('valid_to');
        });
        Schema::table('certificate_checks', function (Blueprint $table) {
            $table->bigInteger('valid_to')->default(0);
        });
    }
}
