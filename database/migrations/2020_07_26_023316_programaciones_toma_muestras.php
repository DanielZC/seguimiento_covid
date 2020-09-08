<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProgramacionesTomaMuestras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programaciones_toma_muestras', function (Blueprint $table) 
        {
            // Formulario fecha programacion
            $table->id('id_programacion');
            $table->foreignId('paciente_id')->nullable()->references('id_paciente')->on('pacientes');
            $table->string('acepta_visita');
            $table->dateTime('fecha_programacion');
            $table->string('programa_pertenece');
            $table->string('lugar_toma');
            
            // Formulario fecha_realizacion
            $table->dateTime('fecha_realizacion_toma')->nullable();
            $table->string('visita_exitosa')->nullable();
            $table->string('tipo_prueba',['IGG Y IGM','ANTIGENO'])->nullable();
            $table->string('observacion')->nullable();
            $table->string('motivo')->nullable();

            // Formualrio Resultado
            $table->dateTime('fecha_entrega_lab')->nullable();
            $table->dateTime('fecha_procesamiento')->nullable();
            $table->dateTime('fecha_resultado')->nullable();
            $table->string('notificado')->nullable();
            $table->dateTime('fecha_notificacion')->nullable();
            // El estado se inicializa en ACTIVO y cuando se ingresa un resultado se cambia a FINALIZADO
            $table->enum('estado_proceso',['ACTIVO','FINALIZADO']);

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
        Schema::dropIfExists('programaciones_toma_muestras');
    }
}
