<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::with('proveedor', 'user', 'producto')->get();
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        $users = User::all();
        return view('compras.create', compact('proveedores', 'productos', 'users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date',
            'id_proveedor' => 'required|exists:proveedores,id',
            'productos' => 'required|array|min:1',
            'productos.*.id_producto' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.preciocompra' => 'required|numeric|min:0.01',
            'productos.*.precioventa' => 'required|numeric|min:0.01',
            'productos.*.descripcion' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            foreach ($request->productos as $detalle) {
                $compra = new Compra();
                $compra->fecha = $request->fecha;
                $compra->id_proveedor = $request->id_proveedor;
                $compra->id_user = Auth::id();
                $compra->id_producto = $detalle['id_producto'];
                $compra->cantidad = $detalle['cantidad'];
                $compra->descripcion = $detalle['descripcion'] ?? null;
                $compra->preciocompra = $detalle['preciocompra'];
                $compra->precioventa = $detalle['precioventa'];
                $compra->save();

                // Actualizar stock
                Producto::find($detalle['id_producto'])->increment('stock', $detalle['cantidad']);
            }

            DB::commit();
            return redirect()->route('compras.index')->with('mensaje', 'Compra registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al guardar la compra: ' . $e->getMessage()])->withInput();
        }
    }

    public function show(Compra $compra)
    {
        return view('compras.show', compact('compra'));
    }

    public function edit(Compra $compra)
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        $users = User::all();
        return view('compras.edit', compact('compra', 'proveedores', 'productos', 'users'));
    }

    public function update(Request $request, Compra $compra)
    {
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date',
            'id_proveedor' => 'required|exists:proveedores,id',
            'id_producto' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'preciocompra' => 'required|numeric|min:0.01',
            'precioventa' => 'required|numeric|min:0.01',
            'descripcion' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            // Revertir stock anterior
            Producto::find($compra->id_producto)->decrement('stock', $compra->cantidad);

            $compra->fecha = $request->fecha;
            $compra->id_proveedor = $request->id_proveedor;
            $compra->id_producto = $request->id_producto;
            $compra->cantidad = $request->cantidad;
            $compra->descripcion = $request->descripcion ?? null;
            $compra->preciocompra = $request->preciocompra;
            $compra->precioventa = $request->precioventa;
            $compra->save();

            // Actualizar stock
            Producto::find($request->id_producto)->increment('stock', $request->cantidad);

            DB::commit();
            return redirect()->route('compras.index')->with('mensaje', 'Compra actualizada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Compra $compra)
    {
        // Revertir stock
        Producto::find($compra->id_producto)->decrement('stock', $compra->cantidad);
        $compra->delete();

        return redirect()->route('compras.index')->with('success', 'Compra eliminada correctamente.');
    }

    public function showDetalles(Compra $compra)
    {
        $compra->load('producto');
        return view('compras.detalles', compact('compra'));
    }
}

