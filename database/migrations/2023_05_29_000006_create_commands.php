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

            $table->unsignedBigInteger('pedido_id')->nullable();
            $table->foreign('pedido_id')
                ->references('id')->on('orden')
                ->onDelete('cascade');

            $table->unsignedBigInteger('articulo_id')->nullable();
            $table->foreign('articulo_id')
                ->references('id')->on('productos')
                ->onDelete('cascade');

            $table->string('articulo');
            $table->string('cantidad');
            $table->decimal('precio_compra',10,2);
            $table->decimal('subtotal',10,2);
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
