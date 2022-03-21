<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('categoria_id')->nullable()->after('id'); //llave foreana
            $table->foreign('categoria_id')->references('id')->on('categorias'); //llave foreana
            $table->string("telefono")->nullable()->after('password');
            $table->string("pais")->nullable()->after('password');
            $table->string("nickname")->nullable()->after('password');
            $table->text('direccion')->nullable()->after('password');
            $table->date('fecha_nacimiento')->nullable()->after('password');
            $table->datetime('deleted_at')->nullable()->after('remember_token');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('categoria_id');
            $table->dropColumn('categoria_id');
            $table->dropColumn('telefono');
            $table->dropColumn('pais');
            $table->dropColumn('nickname');
            $table->dropColumn('direccion');
            $table->dropColumn('fecha_nacimiento');
            $table->dropColumn('deleted_at');
        });
    }
}
