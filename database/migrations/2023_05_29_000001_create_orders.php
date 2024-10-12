s<?php

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
        Schema::create('orden', function (Blueprint $table) {
            $table->id();

            $table->date('fecha'); // Fecha de Creación
            $table->string('mesa'); // Mesa Atendida
            $table->string('cajero'); // Nombre del Cajero de Turno
            $table->string('turno',50)->nullable(); // Horario / Turno Laboral
            $table->string('forma_pago')->nullable(); // Forma de Pago

            $table->unsignedBigInteger('guia_id')->default(1)->nullable();
            $table->foreign('guia_id')
                ->references('id')->on('guias')
                ->onDelete('cascade'); // ID del Guia

            $table->decimal('comision_percentage',10,2)->nullable(); // % de Comisión por Guia

            $table->unsignedBigInteger('mesero_id')->default(1)->nullable();
            $table->foreign('mesero_id')
                ->references('id')->on('meseros')
                ->onDelete('cascade'); // ID del Mesaro

            $table->integer('num_comensales')->default(1); // Cantidad de Comensales

            $table->string('cliente')->nullable(); // Nombre del Cliente
            $table->string('direccion',500)->nullable(); //Dirección del Cliente
            $table->string('articulo',500)->nullable(); // Resumen en texto plano de la Orden
            $table->string('comentario',500)->default('Ninguno')->nullable(); // Comentarios respecto al Servicio

            $table->decimal('conf_total',10,2); // Total por Productos
            $table->integer('descuento')->nullable(); // Descuento otorgado al Usuario
            $table->string('motivo_descuento',500)->default('Ninguno')->nullable(); // Motivo del Descuento Dado
            $table->decimal('descuento_pesos',10,2)->nullable(); // Cantidad a Descontar al Total
            $table->decimal('total',10,2)->nullable(); // Ultimo Total - Descuento
            $table->decimal('comision',10,2)->nullable(); // Ultimo Total con Comisión Incluida
            $table->decimal('propina',10,2)->nullable(); // Propina
            $table->decimal('total2',10,2)->nullable(); // Ultimo Total + Propina
            $table->decimal('pago',10,2)->nullable(); // Pago recibido
            $table->decimal('cambio',10,2)->nullable(); // Cambio monetario

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden');
    }
};
