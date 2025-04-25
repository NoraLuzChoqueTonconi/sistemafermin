<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = [
        'Fecha',
        'id_cliente',
        'totalpagado',
    ];
    // Definir relaciones con otros modelos
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
    public function medida()
    {
        return $this->belongsTo(Medida::class, 'id_medida');
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }


    protected static function boot()
    {
        parent::boot();

        static::created(function ($venta) {
            $producto = Producto::find($venta->id_producto);
            if ($producto && $producto->stock >= $venta->cantidad) {
                $producto->decrement('stock', $venta->cantidad);
            } else {
                throw new \Exception('Stock insuficiente para la venta');
            }
        });
    }
}