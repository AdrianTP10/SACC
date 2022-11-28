<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno_id')->references('id')->on('alumnos');
            $table->foreignId('actividad_id')->references('id')->on('actividades');
            $table->foreignId('periodo_id')->references('id')->on('periodos');
            $table->foreignId('departamento_id')->references('id')->on('departamentos');
            $table->foreignId('responsable_id')->nullable()->references('id')->on('personal');
            $table->foreignId('estatus_id')->references('id')->on('estatus_solicitud')->default('1');
            $table->float('valor', 2, 1);
            $table->integer('calificacion')->default('0');
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
        Schema::dropIfExists('solicitudes');
    }
};
