<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asesorias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();

            $table->foreign('user_id')->references('id')->on('users');

            $table->string('nombre');
            $table->unsignedBigInteger('programa_id')->unique();

            $table->foreign('programa_id')->references('id')->on('programa_educativos');

            $table->enum('nivel', ['Licenciatura', 'Maestía', 'Doctorado']);

            $table->enum('participacion', ['Director', 'Co Director', 'Sinodal', 'Lector']);

            $table->enum('tipo_tutoria', [
                'Tutoría académica individual',
                'Tutoría académica grupal',
                'Tutorías en el nivel medio superior',
                'Tutor de alumnos para Prácticas profesionales',
                'Tutor de alumnos para Servicio social',
                'Tutor de estudiantes indígenas',
                'Asesoría disciplinar para alumnos rezagados',
                'Preparación de alumnos para olimpiadas',
                'Preparación de alumnos para competencias académicas',
                'Preparación de alumnos para exámenes generales',
                'Dirección de Titulación',
                'Asesoría de tesis',
                'Lector de tesis',
                'Sinodal en exámenes de titulación',
                'Participación en los programas de orientación educativa'
            ]);

            $table->enum('estatus', ['Terminado', 'En proceso']);
            $table->string('institucion');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesorias');
    }
};
