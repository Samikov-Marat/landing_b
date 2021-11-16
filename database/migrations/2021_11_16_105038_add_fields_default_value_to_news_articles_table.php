<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsDefaultValueToNewsArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_articles', function (Blueprint $table) {
            $table->string('header')->default('')->change();
            $table->text('note')->nullable()->change();
            $table->text('text')->nullable()->change();
            $table->string('publication_date_text')->default('')->change();
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
            $table->string('header')->change();
            $table->text('note')->change();
            $table->text('text')->change();
            $table->string('publication_date_text')->change();
        });
    }
}
