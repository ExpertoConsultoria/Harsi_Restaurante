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
            $table->date('fecha');
            $table->string('mesa');
            $table->string('cajero');
            $table->string('cliente')->nullable();
            $table->string('direccion')->nullable();
            $table->decimal('total',10,2)->nullable();
            $table->string('motivo',500)->default('Ninguno')->nullable();
            $table->string('comentario',500)->default('Ninguno')->nullable();
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
