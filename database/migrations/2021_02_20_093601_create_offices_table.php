<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->id();
            $table->timestamps();
            $table->string('code', 32);
            $table->string('name');
            $table->string('country_code_iso');
            $table->string('work_time');
            $table->string('address');
            $table->string('full_address');
            $table->text('address_comment');
            $table->string('email');
            $table->string('phone');
            $table->point('coordinates')->spatialIndex();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offices');
    }
}
