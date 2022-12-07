<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFranchiseeIdToLocalOfficesTable extends Migration
{
    public function up(): void
    {
        Schema::table('local_offices', function (Blueprint $table) {
            $table->foreignId('franchisee_id')
                ->nullable(true)
                ->default(null);
        });
    }

    public function down(): void
    {
        Schema::table('local_offices', function (Blueprint $table) {
            $table->dropColumn('franchisee_id');
        });
    }
}
