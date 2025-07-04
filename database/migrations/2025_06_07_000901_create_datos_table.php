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
        Schema::create('datos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();

            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('codigo')->unique();
            $table->index('codigo');
            $table->string('nombre')->unique();
            $table->index('nombre');
            $table->enum('sexo', ['Masculino', 'Femenino']);
            $table->string('domicilio');
            $table->string('telefono');
            $table->string('CRUP')->unique();
            $table->string('RFC')->unique();
            $table->enum('grado', ['Dr.', 'Dra.', 'Mtro.', 'Mtra', 'Lic.']);
            $table->string('disciplina');
            $table->string('correo');
            $table->string('correo_alternativo')->nullable();



            // Nuevos campos para distribución del tiempo
            $table->tinyInteger('docencia')->default(0);
            $table->tinyInteger('asesorias')->default(0);
            $table->tinyInteger('gestion')->default(0);
            $table->tinyInteger('investigacion')->default(0);
            $table->tinyInteger('extension_difusion')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos');
    }
};
