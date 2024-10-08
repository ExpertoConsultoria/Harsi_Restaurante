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
        Schema::create('orden_cancelado', function (Blueprint $table) {
            $table->id();

            $table->date('fecha'); // Fecha de Guardado
            $table->string('mesa'); // Mesa Atendida
            $table->string('cajero'); // Nombre del Cajero

            $table->string('guia')->default('Ninguno')->nullable(); // Nombre del Guia
            $table->string('mesero')->default('Ninguno')->nullable(); // Nombre del Mesero
            $table->integer('num_comensales')->default(1); // Cantidad de Comensales

            $table->string('cliente')->nullable(); // Nombre del Cliente
            $table->string('direccion')->nullable(); // Dirección del Cliente

            $table->decimal('total',10,2)->nullable(); // Total por Consumo
            $table->string('motivo',500)->default('Ninguno')->nullable(); // Motivo de Cancelación
            $table->string('comentario',500)->default('Ninguno')->nullable(); // Comentarios del Servicio

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_cancelado');
    }
};
