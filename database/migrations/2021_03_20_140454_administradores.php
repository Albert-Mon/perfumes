<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Administradores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administradores', function(Blueprint $table){
            $table->increments('ClaveAdministrador');
            $table->string('Fotografia',300);
            $table->string('NombreUsuario',20);
            $table->string('Nombre',20);
            $table->string('ApellidoPaterno',20);
            $table->string('ApellidoMaterno',20);
            $table->string('Sexo',10);
            $table->string('Telefono',10);
            $table->string('Correo',30);
            $table->string('Contraseña',20);
            $table->remembertoken();
            $table->softDeletes();
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
        Schema::drop('administradores');
    }
}
