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
        Schema::create('detalle_compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_compra')->constrained('compras')->onDelete('cascade');
            $table->foreignId('id_producto')->constrained('productos')->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('precio_compra', 10, 2); // Precio de compra específico para este producto en esta compra
            $table->decimal('precio_venta', 10, 2)->nullable(); // Precio de venta sugerido o específico
            $table->timestamps();

            // Definir claves únicas para evitar duplicados de producto por compra (opcional pero recomendado)
            $table->unique(['id_compra', 'id_producto']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_compras');
    }
};