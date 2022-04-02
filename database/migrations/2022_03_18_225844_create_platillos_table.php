<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatillosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platillos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id')->nullable(); //llave foreana
            $table->foreign('menu_id')->references('id')->on('menus'); //llave foreana
            $table->string('nombre')->nullable();
            $table->string('tipo')->nullable();
            $table->string('logotipo')->nullable();
            $table->string('ingredientes')->nullable();
            $table->string('precio')->nullable();
            $table->datetime('deleted_at')->nullable();
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
        Schema::dropIfExists('platillos');
    }
}
