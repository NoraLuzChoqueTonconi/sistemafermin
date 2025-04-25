<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model

{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'nombreproveedor',
        'celular',
        'empresa',
        'email',
        'direccion',
    ];
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_proveedor'); 
    }
    
}



