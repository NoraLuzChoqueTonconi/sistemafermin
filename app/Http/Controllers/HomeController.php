<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Venta;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $categoriasCount = Categoria::count();
        $clientesCount = Cliente::count();
        $comprasCount = Compra::count();
        $pedidosCount = Pedido::count();
        $productosCount = Producto::count();
        $proveedoresCount = Proveedor::count();
        $ventasCount = Venta::count();
        $permissionsCount = Permission::count();

        return view('index', [
            'users' => $usersCount,
            'categorias' => $categoriasCount,
            'clientes' => $clientesCount,
            'compras' => $comprasCount,
            'pedidos' => $pedidosCount,
            'productos' => $productosCount,
            'proveedores' => $proveedoresCount,
            'ventas' => $ventasCount,
            'permissions' => $permissionsCount,
        ]);
    }
}