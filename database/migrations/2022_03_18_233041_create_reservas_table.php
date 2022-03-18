<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->nullable(); //llave foreana
            $table->foreign('usuario_id')->references('id')->on('users'); //llave foreana
            $table->unsignedBigInteger('restaurant_id')->nullable(); //llave foreana
            $table->foreign('restaurant_id')->references('id')->on('restaurantes'); //llave foreana
            $table->date('fecha')->nullable();
            $table->string('hora')->nullable();
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
        Schema::dropIfExists('reservas');
    }
}
