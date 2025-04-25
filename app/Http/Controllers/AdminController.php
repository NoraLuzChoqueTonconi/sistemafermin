<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Venta;
use App\Models\Pedido;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\Cliente;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $categoriaCount = Categoria::count();
        $clienteCount = Cliente::count();
        $compraCount = Compra::count();
        $pedidoCount = Pedido::count();
        $productoCount = Producto::count();
        $proveedorCount = Proveedor::count();
        $ventaCount = Venta::count();
        $permissionCount = Permission::count();

        return view('index', compact(
            'userCount', 'categoriaCount', 'clienteCount', 'compraCount',
            'pedidoCount', 'productoCount', 'proveedorCount', 'ventaCount', 'permissionCount'
        ));
    }
}
