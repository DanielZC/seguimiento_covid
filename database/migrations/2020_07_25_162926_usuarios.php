<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('numero_documento')->unique();
            $table->string('nombre_completo');
            $table->string('contraseña');
            $table->enum('role',['Auxiliar de programacion','Auxiliar de seguimiento','Coordinador covid','Medico','Digitador']);
            $table->enum('sede',['Cartagena','Barranquilla','Carmen de bolivar']);

            // Automatico
            $table->timestamp('fecha_creacion_registro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
