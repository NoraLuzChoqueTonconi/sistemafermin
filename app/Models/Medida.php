<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Asegúrate de tener esta línea

class Medida extends Model
{
    use HasFactory;

    protected $table = 'medidas'; // Nombre de la tabla en la BD

    protected $fillable = [
        'estado',
        'nombremedida',
        'siglamedida',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function detalleVentas(): HasMany
    {
        return $this->hasMany(DetalleVenta::class, 'id_medida');
    }
}