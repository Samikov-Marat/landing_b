<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueKeyRolePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'role_permission',
            function (Blueprint $table) {
                $table->unique(['permission_text_id', 'role_id'], 'permission_text_id_role_id');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'role_permission',
            function (Blueprint $table) {
                $table->dropIndex('permission_text_id_role_id');
            }
        );
    }
}
