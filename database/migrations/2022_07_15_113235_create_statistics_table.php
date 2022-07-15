<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->string('utm_source', 255)->nullable()->default(null);
            $table->string('utm_medium', 255)->nullable()->default(null);
            $table->string('utm_campaign', 255)->nullable()->default(null);
            $table->string('utm_term', 255)->nullable()->default(null);
            $table->string('utm_content', 255)->nullable()->default(null);
            $table->string('site', 255)->nullable(false);
            $table->string('page', 255)->nullable(false);
            $table->timestamps();

            $table->index(['site', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistics');
    }
}
