<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    
{
    $proveedores = Proveedor::all();
    return view('proveedores.index', compact('proveedores')); 
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        //$proveedores = Proveedor::all();
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $proveedor = new Proveedor();

        $proveedor->nombreproveedor = $request->nombreproveedor;
        $proveedor->celular = $request->celular;
        $proveedor->email = $request->email;
        $proveedor->empresa = $request->empresa;
        $proveedor->direccion = $request->direccion;

        $proveedor->save();

        return redirect()->route('proveedores.index')->with('mensaje','Se Registro de manera correcta');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        
            $proveedor = Proveedor::findOrfail($id);
            return view('proveedores.show', compact('proveedor'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proveedor = Proveedor::findOrfail($id);
        return view('proveedores.edit', compact('proveedor'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        {
            $proveedor = Proveedor::find($id);
    
            $proveedor->nombreproveedor = $request->nombreproveedor;
            $proveedor->celular = $request->celular;
            $proveedor->email = $request->email;
            $proveedor->empresa = $request->empresa;
            $proveedor->direccion = $request->direccion;
    
            $proveedor->save();
    
            return redirect()->route('proveedores.index')->with('mensaje','Se actualizo de manera correcta');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Proveedor::destroy($id);
        return redirect()->route('proveedores.index')->with('mensaje','Se Elimiino de manera Correcta');
    }
}
