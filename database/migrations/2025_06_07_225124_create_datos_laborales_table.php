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
        Schema::create('datos_laborales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();

            $table->foreign('user_id')->references('id')->on('users');
            $table->string('categoria');
            $table->enum('carga_horaria', ['PTC', 'PMT', 'PA']);

            $table->string('departamento');
            $table->unsignedBigInteger('departamento_id')->unique();

            $table->foreign('departamento_id')->references('id')->on('departamentos');

            $table->string('tipo');
            $table->tinyInteger('antiguedad');
            $table->tinyInteger('horas');
            $table->enum('tipo_contrato', ['defenitivo', 'emerito', 'honorario', 'interino', 'temporal']);
            $table->date('vencimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_laborales');
    }
};
