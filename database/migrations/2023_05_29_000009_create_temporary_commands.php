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
        Schema::create('comanda_temporal', function (Blueprint $table) {
            $table->id();

            $table->integer('fila'); // Array Index from Orden

            $table->date('fecha'); // Fecha de Guardado
            $table->string('mesa'); // Mesa Atendida
            $table->string('estado')->nullable(); // Estado de la Mesa [Abierta, Cerrada]
            $table->string('cajero'); // Nombre del Cajero


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
            $table->string('direccion',500)->nullable(); // Dirección del Cliente

            $table->string('articulo')->nullable(); // Nombre del Producto
            $table->string('cantidad')->nullable(); // Cantidad del Producto Solicitado
            $table->decimal('precio_compra',10,2)->nullable(); // Precio del Producto
            $table->decimal('subtotal',10,2)->nullable(); // Total a pagar por los Productos

            $table->boolean('ready_to_serve')->default(0); // Estado de Preparación del Platillo
            $table->string('preparation_specifications', 500)->default('Ninguna')->nullable(); // Especificaciones del Platillo

            $table->string('status')->default('Disponible'); // Estado de la Comanda [Disponible, Eliminado]
            $table->string('motivo',500)->nullable(); // Motivo de Cancelación
            $table->string('comentario',500)->nullable(); // Comentario de la Comanda

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comanda_temporal');
    }
};
