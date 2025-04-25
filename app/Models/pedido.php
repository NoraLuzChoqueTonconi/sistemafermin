<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'id_proveedor',
        'telefono',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function detallesPedido()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_pedidos', 'id_pedido', 'id_producto')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }
}
