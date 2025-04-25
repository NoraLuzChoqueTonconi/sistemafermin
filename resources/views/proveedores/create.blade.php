@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Crear una Nuevo Proveedor</b></h1><br>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los Datos</b></h3>
                    </div>
                    <div class="card card-body" style="...">
                        <form action="{{ url('/proveedores') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Nombre del Proveedor</label> <b>*</b>
                                        <input type="text" name="nombreproveedor" value="{{ old('nombreproveedor') }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Celular</label> <b>*</b>
                                        <input type="text" name="celular" value="{{ old('celular') }}"
                                            class="form-control">
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Empresa</label> <b>*</b>
                                    <input type="text" name="empresa" value="{{ old('empresa') }}"
                                        class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Email</label> <b>*</b>
                                        <input type="text" name="email" value="{{ old('email') }}"
                                            class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Direccion</label> <b>*</b>
                                            <input type="text" name="direccion" value="{{ old('direccion') }}"
                                                class="form-control">
                                </div>
                            </div>
                        </div>
                            
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-gro">
                                        <a href="{{ url('/proveedores') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar registro</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection