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
        Schema::create('plan_estudios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->unique();

            $table->foreign('user_id')->references('id')->on('users');

            $table->string('nombre');
            $table->enum('grado', ['Licenciatura', 'Especialidad', 'Maestria', 'Doctorado', 'Postdoctorado']);
            $table->string('descripcion');
            $table->year('anio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_estudios');
    }
};
