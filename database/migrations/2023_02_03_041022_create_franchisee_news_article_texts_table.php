<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseeNewsArticleTextsTable extends Migration
{
    public function up(): void
    {
        Schema::create('franchisee_news_article_texts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('franchisee_news_article_id');
            $table->foreignId('language_id');
            $table->string('header');
            $table->text('note');
            $table->text('text');
            $table->string('publication_date_text');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('franchisee_news_article_texts');
    }
}
