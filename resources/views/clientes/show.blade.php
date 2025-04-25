@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Datos de Clientes Registradas</b></h1><br>

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Datos registrados</b></h3>
                    </div>
                    <div class="card-body" style="...">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Nombre Completo</label>
                                        <input type="text" name="nombre" value="{{ $cliente->nombre_completo }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">C.I</label>
                                    <input type="text" name="ci" value="{{ $cliente->ci }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Celular</label>
                                <input type="text" name="celular" value="{{ $cliente->celular }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Email</label>
                            <input type="text" name="email" value="{{ $cliente->email}}" class="form-control" disabled>
                                </div>
                                                                
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-gro">
                                        <a href="{{ url('/clientes') }}" class="btn btn-secondary">Atras</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection