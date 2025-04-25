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
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pedido')->constrained('pedidos')->onDelete('cascade');
            $table->foreignId('id_producto')->constrained('productos');
            $table->integer('cantidad'); 
            $table->timestamps();

            // Clave única para evitar duplicados del mismo producto en un pedido
            $table->unique(['id_pedido', 'id_producto']);

            // Índices para mejorar las consultas
            $table->index('id_pedido');
            $table->index('id_producto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos');
    }
};
