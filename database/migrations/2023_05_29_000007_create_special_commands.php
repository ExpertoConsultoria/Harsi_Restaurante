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
        Schema::create('comandaesp', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pedido_id')->nullable();
            $table->foreign('pedido_id')
                ->references('id')->on('orden')
                ->onDelete('cascade');

            $table->string('producto')->nullable();
            $table->string('cant')->nullable();
            $table->decimal('precio_c',10,2)->nullable();
            $table->decimal('sub_total',10,2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comandaesp');
    }
};
