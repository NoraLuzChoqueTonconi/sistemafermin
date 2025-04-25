<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes'; 

    protected $fillable = [
        'nombre_completo',
        'ci',       
        'celular',  
        'email',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Relación con ventas: un cliente puede hacer varias compras
    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
