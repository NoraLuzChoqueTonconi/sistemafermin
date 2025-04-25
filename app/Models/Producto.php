<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'codigo',
        'nombreproducto',
        'descripcion',
        'stock',
        'preciocompra',
        'precioventa',
        'id_categoria',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    
    public function detalleVentas(): HasMany
    {
        return $this->hasMany(DetalleVenta::class, 'id_producto');
    }

    public function pedidos(): BelongsToMany
    {
        return $this->belongsToMany(Pedido::class, 'detalle_pedidos', 'id_producto', 'id_pedido')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }

    
    public function compras(): BelongsToMany
    {
        return $this->belongsToMany(Compra::class, 'detalle_compras', 'producto_id', 'compra_id')
                    ->withPivot('cantidad', 'precio_compra', 'precio_venta')
                    ->withTimestamps();
    }
}