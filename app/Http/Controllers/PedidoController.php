<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('proveedor', 'detallesPedido.producto')->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $proveedors = Proveedor::all();
        $productos = Producto::all();
        return view('pedidos.create', compact('proveedors', 'productos'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
    
            // Crear el pedido principal
            $pedido = new Pedido();
            $pedido->fecha = $request->fecha;
            $pedido->id_proveedor = $request->id_proveedor;
            $pedido->telefono = $request->telefono;
            $pedido->save();
    
            // Crear los detalles del pedido
            if ($request->has('productos')) {
                foreach ($request->productos as $productoData) {
                    $detallePedido = new DetallePedido();
                    $detallePedido->pedido_id = $pedido->id;
                    $detallePedido->producto_id = $productoData['id_producto'];
                    $detallePedido->cantidad = $productoData['cantidad'];
                    $detallePedido->save();
                }
            }
    
            DB::commit();
            return redirect()->route('pedidos.index')->with('mensaje', 'Se registró el pedido de manera correcta');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al guardar el pedido: ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        $pedido = Pedido::with('proveedor', 'detallesPedido.producto')->findOrFail($id);
        return view('pedidos.show', compact('pedido'));
    }

    public function edit($id)
    {
        $pedido = Pedido::with('proveedor', 'detallesPedido')->findOrFail($id);
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('pedidos.edit', compact('pedido', 'proveedores', 'productos'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Actualizar el pedido principal
            $pedido = Pedido::findOrFail($id);
            $pedido->fecha = $request->fecha;
            $pedido->id_proveedor = $request->id_proveedor;
            $pedido->telefono = $request->telefono;
            $pedido->save();

            // Eliminar los detalles de pedido existentes
            $pedido->detallesPedido()->delete();

            // Crear los nuevos detalles del pedido
            if ($request->has('productos')) {
                foreach ($request->productos as $productoData) {
                    $detallePedido = new DetallePedido();
                    $detallePedido->pedido_id = $pedido->id;
                    $detallePedido->producto_id = $productoData['id_producto'];
                    $detallePedido->cantidad = $productoData['cantidad'];
                    $detallePedido->save();
                }
            }

            DB::commit();
            return redirect()->route('pedidos.index')->with('mensaje', 'Se actualizó el pedido de manera correcta');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al actualizar el pedido: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        Pedido::destroy($id);
        return redirect()->route('pedidos.index')->with('mensaje', 'Se eliminó el pedido de manera correcta');
    }
}