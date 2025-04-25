<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'id_proveedor',
        'descripcion',
        'id_user',
    ];

    // Relación con el Proveedor (una compra pertenece a un proveedor)
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    // Relación con el Usuario (una compra fue realizada por un usuario)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relación muchos a muchos con Producto a través de la tabla 'detalle_compras'
    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'detalle_compras')
                    ->withPivot('cantidad', 'precio_compra', 'precio_venta')
                    ->withTimestamps();
    }

    // Relación hasMany con DetalleCompra (opcional, pero útil para acceder directamente a los detalles)
    public function detallesCompra()
    {
        return $this->hasMany(DetalleCompra::class, 'id_compra');
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}