<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Medida;
use Illuminate\Http\Request;

class MedidaController extends Controller
{
    public function index()
    {
        $medidas = Medida::all();
      
        return view('medidas.index', compact('medidas'));
    }

    public function create()
    {
        return view('medidas.create');
    }

    public function store(Request $request)
    {
        $medidas = new Medida();

        $medidas->nombremedida = $request->nombremedida;
        $medidas->siglamedida = $request->siglamedida;
        $medidas->estado = '1';

        $medidas->save();

        return redirect()->route('medidas.index')->with('mensaje', 'Se Registro la Medidas de manera correcta');
    }
    public function show($id)
    {
        $medida = Medida::findOrfail($id);
        return view('medidas.show', compact('medida'));
    }
    public function edit($id)
    {
        $medida = Medida::findOrfail($id);
        return view('medidas.edit', compact('medida'));
    }
    public function update(Request $request, $id)
    {
        $medida = Medida::find($id);

        $medida->nombremedida= $request->nombremedida;
        $medida->siglamedida = $request->siglamedida;
        $medida->estado = $request->estado; ;

        $medida->save();

        return redirect()->route('medidas.index')->with('mensaje','Se actualizo las Medidas de manera correcta');
    }

    public function destroy($id){
        Medida::destroy($id);
        return redirect()->route('medidas.index')->with('mensaje', 'Se Elimino la Medidas de manera correcta');
    }
}
