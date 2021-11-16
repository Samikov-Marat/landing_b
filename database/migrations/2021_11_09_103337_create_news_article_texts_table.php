<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsArticleTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_article_texts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_article_id');
            $table->foreignId('language_id');
            $table->string('header');
            $table->text('note');
            $table->text('text');
            $table->string('publication_date_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_article_texts');
    }
}
