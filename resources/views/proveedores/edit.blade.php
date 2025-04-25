@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Actualizar los Proveedores</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/proveedores', $proveedor->id) }}">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre del Proveedor</label>
                                            <input type="text" name="nombreproveedor" value="{{ $proveedor->nombreproveedor }}" class="form-control" required style="text-transform: uppercase;">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Celular</label>
                                            <input type="text" name="celular" value="{{ $proveedor->celular }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" name="email" value="{{ $proveedor->email }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Empresa</label>
                                            <input type="text" name="empresa" value="{{ $proveedor->empresa }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Direccion</label>
                                            <input type="text" name="direccion" value="{{ $proveedor->direccion }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-gro">
                                            <a href="{{ url('/proveedores') }}" class="btn btn-secondary">Cancelar</a>
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