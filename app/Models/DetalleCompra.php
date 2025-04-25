<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleCompra extends Model
{
    use HasFactory;

    protected $table = 'detalle_compras'; 

    protected $fillable = [
        'id_compra',
        'id_producto',
        'cantidad',
        'precio_compra',
        'precio_venta',
    ];

  
    public function compra(): BelongsTo
    {
        return $this->belongsTo(Compra::class);
    }

    
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}