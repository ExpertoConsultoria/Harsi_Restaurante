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
            $table->integer('fila');
            $table->date('fecha');
            $table->string('mesa');
            $table->string('estado')->nullable();
            $table->string('cajero');
            $table->string('cliente')->nullable();
            $table->string('direccion',500)->nullable();

            $table->unsignedBigInteger('articulo_id')->nullable();
            $table->foreign('articulo_id')
                ->references('id')->on('productos')
                ->onDelete('cascade');

            $table->string('articulo')->nullable();
            $table->string('cantidad')->nullable();
            $table->decimal('precio_compra',10,2)->nullable();
            $table->decimal('subtotal',10,2)->nullable();
            $table->string('status')->default('Disponible');
            $table->string('motivo',500)->nullable();
            $table->string('comentario',500)->nullable();
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
