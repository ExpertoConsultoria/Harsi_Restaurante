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
        Schema::create('restaurante', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('rfc');
            $table->string('direccion');
            $table->string('telefono')->default('Ninguno');
            $table->string('email')->default('Ninguno');
            $table->string('subcategoria',5)->default('No');
            $table->string('reducir',5)->default('No');
            $table->string('hotel',5)->default('No');
            $table->string('facebook',150)->default('Ninguno')->nullable();
            $table->string('instagram',150)->default('Ninguno')->nullable();
            $table->string('twitter',150)->default('Ninguno')->nullable();
            $table->string('youTube',150)->default('Ninguno')->nullable();
            $table->string('linkedIn',150)->default('Ninguno')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurante');
    }
};
