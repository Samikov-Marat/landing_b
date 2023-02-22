<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseeNewsArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('franchisee_news_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('franchisee_id');
            $table->dateTime('publication_date');
            $table->string('preview')->nullable();
            $table->string('image')->nullable();
            $table->string('image2')->nullable();
            $table->string('mobile')->nullable();
            $table->string('mobile2')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('franchisee_news_articles');
    }
}
