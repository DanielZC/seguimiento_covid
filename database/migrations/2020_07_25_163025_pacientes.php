<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function(Blueprint $table)
        {
            // Datos personales del paciente (Creacion  de pacientes)
            $table->id('id_paciente');
            $table->string('tipo_paciente');
            $table->string('numero_documento')->unique();
            $table->string('tipo_documento');
            $table->string('primer_nombre');
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->integer('edad');
            $table->string('unidad_medida');
            $table->enum('sexo',['MASCULINO','FEMENINO']);
            $table->string('municipio');
            $table->string('barrio');
            $table->string('telefono');
            $table->string('telefono2')->nullable();
            $table->string('correo')->nullable();
            $table->string('aseguradora');
            $table->enum('regimen',['SUBSIDIADO','CONTRIBUTIVO']);

            // El estado del paciente se inicializa en ACTIVO y cuando se ingresa un resultado se cambia a FINALIZADO
            $table->enum('estado_paciente',['VIVO','MUERTO']);

            // fecha de fallecimiento del paciente
            $table->timestamp('fecha_fallecimiento')->nullable();

            // Toma el ID del usuario en sesion al momento de la creacion
            $table->foreignId('usuario_id')->nullable()->references('id_usuario')->on('usuarios');
            
            // Toma el ID de la persona a quien sera asignada (Asignacion de pacientes)
            $table->foreignId('usuario_seguimiento_id')->nullable()->references('id_usuario')->on('usuarios'); 

            // ??
            $table->timestamp('fecha_programacion_recepcion')->nullable();
            
            // Fecha automatica
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
        Schema::dropIfExists('pacientes');
    }
}
