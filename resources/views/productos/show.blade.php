@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Datos de Productos Registradas</b></h1><br>

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
                                    <label for="">Codigo</label>
                                    <input type="text" name="codigo" value="{{ $producto->codigo }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Categoria</label>
                                @php
                                    $categoria = json_decode($producto->categoria);
                                @endphp
                                <input type="text" name="categoria" value="{{ $categoria->nombrecategoria ?? '' }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Nombre del Producto</label>
                            <input type="text" name="nombreproducto" value="{{ $producto->nombreproducto }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Descripcion</label>
                            <input type="text" name="descripcion" value="{{ $producto->descripcion }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Stock </label>
                            <input type="text" name="stock" value="{{ $producto->stock}}" class="form-control" disabled>
                        </div>
    
                        <div class="col-md-4">
                            <label for="">Precio Compra</label>
                            <input type="text" name="preciocompra" value="{{ $producto->preciocompra }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Precio Venta</label>
                            <input type="text" name="precioventa" value="{{ $producto->precioventa }}" class="form-control" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-gro">
                                <a href="{{ url('/productos') }}" class="btn btn-secondary">Atras</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection