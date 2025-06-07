<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * 
     *
     * 
     */

    public function up(): void
    {
        Schema::create('formacion_academicas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('grado', [
                'Licenciatura',
                'Maestria',
                'Doctorado',
                'Postdoctorado',
                'Especializacion',
                'Actualizacion',
                'Estudios'
            ]);
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('conocimiento_id');

            $table->foreign('conocimiento_id')->references('id')->on('disciplinas');

            $table->unsignedBigInteger('disciplina_id');

            $table->foreign('disciplina_id')->references('id')->on('disciplinas');

            $table->string('institucion');
            $table->string('pais');
            $table->date('anio');
            $table->boolean('curso')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formacion_academicas');
    }
};
