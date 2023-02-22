<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseeTextsTable extends Migration
{
    public function up()
    {
        Schema::create('franchisee_texts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('text_type_id');
            $table->foreignId('franchisee_id');
            $table->foreignId('language_id');
            $table->text('value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('franchisee_texts');
    }
}
