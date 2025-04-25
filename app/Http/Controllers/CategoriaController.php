<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('categorias.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoria = new Categoria();
    
        $categoria->codigo = $request->codigo;
        $categoria->nombrecategoria = $request->nombrecategoria;
    
        // Manejo de la imagen
        if ($request->hasFile('imagen')) {
            // Guardar la imagen en la carpeta 'categorias' dentro de 'storage/app/public'
            $categoria->imagen = $request->file('imagen')->store('categorias', 'public');
        }
    
        $categoria->save();
    
        return redirect()->route('categorias.index')
            ->with('mensaje', 'Se registró la categoría de manera correcta')
            ->with('icono', 'success');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categoria = Categoria::findOrfail($id);
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrfail($id);
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
    
        $categoria->codigo = $request->codigo;
        $categoria->nombrecategoria = $request->nombrecategoria;
    
        // Manejo de la imagen
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            Storage::delete('public/' . $categoria->imagen);
            
            // Guardar la nueva imagen
            $categoria->imagen = $request->file('imagen')->store('categorias', 'public');
        }
    
        $categoria->save();
    
        return redirect()->route('categorias.index')
            ->with('mensaje', 'Se actualizó la categoría de manera correcta')
            ->with('icono', 'success');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Categoria::destroy($id);
        return redirect()->route('categorias.index')->with('mensaje','Se Elimiino la categoria de manera Correcta');
    }
}
