<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('curso_impartidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();

            $table->foreign('user_id')->references('id')->on('users');

            $table->string('nombre');
            $table->unsignedBigInteger('programa_id')->unique();

            $table->foreign('programa_id')->references('id')->on('programa_educativos');

            $table->enum('tipo', ['Curso', 'Curso en Linea', 'Seminario', 'Taller', 'Mixto', 'Semi-Prescencial']);

            $table->enum('nivel', ['Licenciatura', 'Maestía', 'Doctorado']);
            $table->string('ciclo', 10);
            $table->tinyInteger('horas');
            $table->tinyInteger('num_alumnos');
            $table->enum('cargo', ['Con cargo', 'Asigantura']);
            $table->string('tecnologias', 400);
            $table->year('anio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_impartidos');
    }
};
