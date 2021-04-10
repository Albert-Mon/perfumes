<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Paqueterias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ('paqueterias',function(Blueprint $table){
            $table->Increments('Id_paqueteria');
            $table->string('img',255);
            $table->string('agencia',20);
            $table->string('sucursal',30);
            $table->integer('idestado')->unsigned();  //aqui es en donde va la llave foranea
            $table->foreign('idestado')->references('idestado')->on('estados');
            $table->string('municipio');
            $table->string('calle',30);
            $table->string('numero',5);
            $table->string('codigo_postal',6);
            $table->string('telefono',10);
            $table->string('correo',30);
            $table->string('zona',30);
            $table->string('piezas',2);
            $table->string('dias',30);
            $table->string('horario',10);
            $table->string('tipo_pago',20);
            $table->string('cuenta_bancaria',20);
            $table->string('comision',10);
            $table->string('transporte',20);
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
        Schema::drop('paqueterias');
    }
}
