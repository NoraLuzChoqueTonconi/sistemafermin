@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Datos de Categorias Registradas</b></h1><br>

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Datos registrados</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nombre del proveedor</label>
                                    <input type="text" name="nombreproveedor" value="{{ $proveedor->nombreproveedor }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Celular</label>
                                <input type="text" name="celular" value="{{ $proveedor->celular }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Email</label>
                            <input type="text" name="email" value="{{ $proveedor->email }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Empresa</label>
                            <input type="text" name="empresa" value="{{ $proveedor->empresa }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Direccion</label>
                            <input type="text" name="direccion" value="{{ $proveedor->direccion }}" class="form-control" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-gro">
                                <a href="{{ url('/proveedores') }}" class="btn btn-secondary">Atras</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection