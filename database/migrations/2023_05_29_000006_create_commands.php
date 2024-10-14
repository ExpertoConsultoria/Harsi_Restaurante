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
        Schema::create('comanda', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pedido_id')->nullable(); // Id de la Orden
            $table->foreign('pedido_id')
                ->references('id')->on('orden')
                ->onDelete('cascade');

            $table->string('articulo'); // Nombre del Producto
            $table->string('cantidad'); // Cantidad del Producto Solicitado
            $table->decimal('precio_compra',10,2); // Precio del Producto
            $table->decimal('subtotal',10,2); // Total a pagar por los Productos

            $table->boolean('ready_to_serve')->default(0); // Estado de Preparación del Platillo
            $table->string('notes', 500)->default('Ninguna')->nullable(); // Especificaciones del Platillo

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comanda');
    }
};
