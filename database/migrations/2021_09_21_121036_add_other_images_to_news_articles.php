<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherImagesToNewsArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_articles', function (Blueprint $table) {
            $table->string('image2')->nullable()->after('image');
            $table->string('mobile')->nullable()->after('image2');
            $table->string('mobile2')->nullable()->after('mobile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_articles', function (Blueprint $table) {
            $table->dropColumn('image2');
            $table->dropColumn('mobile');
            $table->dropColumn('mobile2');
        });
    }
}
