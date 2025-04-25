@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Actualizar los clientes</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/clientes',$cliente->id) }}">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre Completo</label>
                                            <input type="text" name="nombre_completo" value="{{ $cliente->nombre_completo }}" class="form-control" required style="text-transform: uppercase;">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">C.I</label>
                                            <input type="text" name="ci" value="{{ $cliente->ci }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Celular</label>
                                            <input type="text" name="celular" value="{{ $cliente->celular }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" name="email" value="{{ $cliente->email}}" class="form-control" required>
                                        </div>
                                    </div>
                                                                        
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-gro">
                                            <a href="{{ url('/clientes') }}" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-success">Actualizar registro</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection