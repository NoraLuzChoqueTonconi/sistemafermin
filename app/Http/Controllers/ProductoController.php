<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Compra; // Importa el modelo Compra
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Asegúrate de usar Session

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $productos = Producto::all();

        // Pasar los datos a la vista
        return view('productos.create', compact('productos', 'categorias'));
    }
    public function store(Request $request)
    {


        if (!$request->id_categoria) {
            return redirect()->back()->withErrors(['id_categoria' => 'La categoría seleccionada es inválida.'])->withInput();
        }

        // Crear un nuevo producto
        $producto = new Producto();

        $producto->codigo = $request->codigo;
        $producto->nombreproducto = $request->nombreproducto;
        $producto->descripcion = $request->descripcion;
        $producto->stock = $request->stock;
        $producto->preciocompra = $request->preciocompra;
        $producto->precioventa = $request->precioventa;
        $producto->id_categoria = $request->id_categoria;

        //dd($producto->id_categoria);
        // Guardar el producto en la base de datos
        $producto->save();


        return redirect()->route('productos.index')->with('mensaje', 'Se registró el producto de manera correcta');
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //

        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        $producto->codigo = $request->codigo;
        $producto->nombreproducto = $request->nombreproducto;
        $producto->descripcion = $request->descripcion;
        $producto->stock = $request->stock;
        $producto->preciocompra = $request->preciocompra;
        $producto->id_categoria = $request->id_categoria;

        $producto->save();

        return redirect()->route('productos.index')->with('mensaje', 'Se actualizo el Producto de manera correcta');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        // Eliminar primero las compras relacionadas con este producto
        Compra::where('id_producto', $id)->delete();

        // Ahora sí, eliminar el producto
        Producto::destroy($id);

        return redirect()->route('productos.index')->with('mensaje', 'Se Eliminó el Producto de manera Correcta');
    }
}