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
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->id();
    
            $table->unsignedBigInteger('id_venta');
            $table->foreign('id_venta')->references('id')->on('ventas')->onDelete('cascade');
    
            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')->references('id')->on('productos')->onDelete('cascade');
    
            $table->unsignedBigInteger('id_medida');  // <- AQUÍ
            $table->foreign('id_medida')->references('id')->on('medidas')->onDelete('cascade');
    
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2); // precio unitario
    
            $table->timestamps();
        });
    }
    
    
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};