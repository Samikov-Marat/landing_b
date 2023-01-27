<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseeUserTable extends Migration
{
    public function up(): void
    {
        Schema::create('franchisee_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('franchisee_id');
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('franchisee_user');
    }
}
