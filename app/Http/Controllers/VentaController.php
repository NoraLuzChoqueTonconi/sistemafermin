<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Medida;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente', 'detalleVentas.producto', 'detalleVentas.medida')->get();
        
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $medidas = Medida::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes','medidas','productos'));
    }
    public function store(Request $request)
    
    {
       dd($request->all());
        //  1. Validación de datos
        $request->validate([
            'Fecha' => 'required|date',
            'id_cliente' => 'required|exists:clientes,id',
            'productos' => 'required|array|min:1',
            'productos.*.id_producto' => 'required|exists:productos,id',
            'productos.*.id_medida' => 'required|exists:medidas,id',
            'productos.*.cantidad' => 'required|numeric|min:1',
            'productos.*.precio' => 'required|numeric|min:0',
        ]);
    
       
        DB::beginTransaction();
    
        try {
            $venta = new Venta();
            $venta->Fecha = $request->Fecha;
            $venta->id_cliente = $request->id_cliente;
            $venta->totalpagado = 0;
            $venta->save();
    
            $total = 0;
    
            foreach ($request->productos as $item) {
                $detalle = new DetalleVenta();
                $detalle->id_venta = $venta->id;
                $detalle->id_producto = $item['id_producto'];
                $detalle->id_medida = $item['id_medida'];
                $detalle->cantidad = $item['cantidad'];
                $detalle->precio = $item['precio'];
                $detalle->save();
    
                $total += $item['cantidad'] * $item['precio'];
    
                $producto = Producto::find($item['id_producto']);
                $producto->stock -= $item['cantidad'];
                $producto->save();
            }
    
            $venta->totalpagado = $total;
            $venta->save();
    
            DB::commit();
    
            return redirect()->route('ventas.index')->with('mensaje','Venta registrada correctamente');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al guardar la venta: ' . $e->getMessage());
        }
    }
    
    

    public function show($id)
    {
        $venta = Venta::with('cliente', 'detalleVentas.producto', 'detalleVentas.medida')->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

    public function edit($id)
    {
        $venta = Venta::with('detalleVentas')->findOrFail($id);
        $productos = Producto::all();
        $clientes = Cliente::all();
        $medidas = Medida::all();
        return view('ventas.edit', compact('venta','productos','clientes','medidas'));
    }

    public function update(Request $request, $id)
    {
        // Para simplificar: eliminamos los detalles viejos y los volvemos a crear (opcionalmente puedes optimizarlo)
        DB::beginTransaction();

        try {
            $venta = Venta::findOrFail($id);
            $venta->Fecha = $request->Fecha;
            $venta->id_cliente = $request->id_cliente;
            $venta->totalpagado = 0;
            $venta->save();

            $venta->detalleVentas()->delete();

            $total = 0;
            foreach ($request->productos as $item) {
                $detalle = new DetalleVenta();
                $detalle->id_venta = $venta->id;
                $detalle->id_producto = $item['id_producto'];
                $detalle->id_medida = $item['id_medida'];
                $detalle->cantidad = $item['cantidad'];
                $detalle->precio = $item['precio'];
                $detalle->save();

                $total += $item['cantidad'] * $item['precio'];
            }

            $venta->totalpagado = $total;
            $venta->save();

            DB::commit();

            return redirect()->route('ventas.index')->with('mensaje','Venta actualizada correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al actualizar la venta: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Venta::destroy($id);
        return redirect()->route('ventas.index')->with('mensaje','Se eliminó la venta correctamente');
    }

    // Nueva función para obtener los detalles de la venta
    public function obtenerDetallesVenta($id)
    {
        $venta = Venta::with('cliente', 'detalleVentas.producto', 'detalleVentas.medida')->findOrFail($id);
        return view('ventas.detalles', compact('venta'));
    }

public function guardarDetalleVenta(Request $request, Venta $venta)
{
    // Aquí recibirás el ID de la venta ($venta->id) y cualquier otra información
    // que necesites guardar (enviada a través del $request).

    // Ejemplo: Si los detalles de la venta se envían como un array 'detalles' en el request:
    $detalles = $request->input('detalles');

    if ($detalles) {
        // Eliminar los detalles existentes para esta venta (opcional, dependiendo de tu lógica)
        $venta->detalleVentas()->delete();

        foreach ($detalles as $detalleData) {
            $venta->detalleVentas()->create([
                'id_producto' => $detalleData['id_producto'],
                'cantidad' => $detalleData['cantidad'],
                'precio' => $detalleData['precio'],
                // ... otros campos del detalle de venta
            ]);
        }

        return response()->json(['success' => 'Detalles de la venta guardados correctamente']);
    } else {
        return response()->json(['error' => 'No se recibieron detalles para guardar'], 400);
    }

    // Si los detalles se obtienen de otra manera (ej: una lógica interna), implementa eso aquí.
}
public function detalle($id)
{
    $venta = Venta::with('cliente', 'detalleVentas.producto', 'detalleVentas.medida')->findOrFail($id);
    return view('ventas.detalle', compact('venta'));
}




}
