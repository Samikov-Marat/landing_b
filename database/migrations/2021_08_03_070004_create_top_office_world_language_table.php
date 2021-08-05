<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopOfficeWorldLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_office_world_language', function (Blueprint $table) {
            $table->id();
            $table->string('top_office_id')->reference('id')->on('top_offices');
            $table->string('world_language_id')->reference('id')->on('world_languages');
            $table->string('name');
            $table->string('full_address');
            $table->string('address_comment');
            $table->string('work_time');
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
        Schema::dropIfExists('top_office_world_language');
    }
}
