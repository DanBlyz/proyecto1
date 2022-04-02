<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable(); //llave foreana
            $table->foreign('admin_id')->references('id')->on('users'); //llave foreana
            $table->unsignedBigInteger('gerente_id')->nullable(); //llave foreana
            $table->foreign('gerente_id')->references('id')->on('users'); //llave foreana
            $table->string('nombre')->nullable();
            $table->string('tipo')->nullable();
            $table->string('logotipo')->nullable();
            $table->string('objetivo')->nullable();
            $table->string('hora_apertura')->nullable();
            $table->string('hora_cierre')->nullable();
            $table->string('validacion')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ubicacion')->nullable();
            
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
        Schema::dropIfExists('restaurantes');
    }
}
