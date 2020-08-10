<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_metas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('music_id');
            $table->string('meta_name');
            $table->bigInteger('meta_id');
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
        Schema::dropIfExists('music_metas');
    }
}
