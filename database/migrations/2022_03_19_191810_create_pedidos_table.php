<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->nullable(); //llave foreana
            $table->foreign('usuario_id')->references('id')->on('users'); //llave foreana
            $table->unsignedBigInteger('restaurant_id')->nullable(); //llave foreana
            $table->foreign('restaurant_id')->references('id')->on('restaurantes'); //llave foreana
            $table->unsignedBigInteger('menu_id')->nullable(); //llave foreana
            $table->foreign('menu_id')->references('id')->on('menus'); //llave foreana
            $table->unsignedBigInteger('platillo_id')->nullable(); //llave foreana
            $table->foreign('platillo_id')->references('id')->on('platillos'); //llave foreana
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
        Schema::dropIfExists('pedidos');
    }
}
