<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('clientes.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       

        $cliente = new Cliente();

        $cliente->nombre_completo = $request->nombre_completo;
        $cliente->ci = $request->ci;
        $cliente->celular= $request->celular;
        $cliente->email= $request->email;


        $cliente->save();

        return redirect()->route('clientes.index')->with('mensaje','Se Registro el Cliente de manera correcta');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::findOrfail($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrfail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        $cliente->nombre_completo = $request->nombre_completo;
        $cliente->ci = $request->ci;
        $cliente->celular= $request->celular;
        $cliente->email= $request->email;


        $cliente->save();

        return redirect()->route('clientes.index')->with('mensaje','Se actualizo los clientes de manera correcta');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Cliente::destroy($id);
        return redirect()->route('clientes.index')->with('mensaje','Se Elimiino rl cliente de manera Correcta');
    }
}
