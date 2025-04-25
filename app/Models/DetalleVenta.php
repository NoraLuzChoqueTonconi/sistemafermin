<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_ventas';

    protected $fillable = [
        'id_venta',
        'id_producto',
        'id_medida',
        'cantidad',
        'precio',
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'precio' => 'decimal:2',
    ];

    public function venta(): BelongsTo
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function medida(): BelongsTo
    {
        return $this->belongsTo(Medida::class, 'id_medida');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($detalleVenta) {
            $producto = Producto::find($detalleVenta->id_producto);
            if ($producto) {
                if ($producto->stock >= $detalleVenta->cantidad) {
                    $producto->decrement('stock', $detalleVenta->cantidad);
                } else {
                    throw new \Exception('Stock insuficiente para el producto: ' . $producto->nombreproducto);
                }
            }
        });
    }
}