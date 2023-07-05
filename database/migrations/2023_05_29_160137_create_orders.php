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
            $table->date('fecha');
            $table->string('mesa');
            $table->string('cajero');
            $table->string('turno',50)->nullable();
            $table->string('forma_pago')->nullable();

            $table->string('consumo',10)->nullable();
            $table->integer('num_room')->nullable();
            $table->string('cliente')->nullable();
            $table->string('direccion',500)->nullable();
            $table->string('articulo',500)->nullable();
            $table->string('comentario',500)->default('Ninguno')->nullable();
            $table->decimal('conf_total',10,2);
            $table->integer('descuento')->nullable();
            $table->string('motivo_descuento',500)->default('Ninguno')->nullable();
            $table->decimal('descuento_pesos',10,2)->nullable();
            $table->string('ordencol',45)->nullable();
            $table->decimal('total',10,2)->nullable();
            $table->decimal('propina',10,2)->nullable(); // Propina
            $table->decimal('total2',10,2)->nullable();
            // $table->decimal('cupon',10,2)->nullable();
            $table->decimal('pago',10,2)->nullable();
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
