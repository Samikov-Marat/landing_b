<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubdomainToFranchiseesTable extends Migration
{
    public function up(): void
    {
        Schema::table('franchisees', function (Blueprint $table) {
            $table->string('subdomain')->default('');
        });
    }

    public function down(): void
    {
        Schema::table('franchisees', function (Blueprint $table) {
            $table->dropColumn('subdomain');
        });
    }
}
