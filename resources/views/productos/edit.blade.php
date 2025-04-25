@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Actualizar los Productos</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/productos', $producto->id) }}">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Codigo </label>
                                            <input type="text" name="codigo" value="{{ $producto->codigo }}" class="form-control" required style="text-transform: uppercase;">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Categoria </label>
                                            @php
                                                $categoria = json_decode($producto->categoria);
                                            @endphp
                                            <input type="text" name="categoria" value="{{ $categoria->nombrecategoria ?? '' }}" class="form-control" required>
                                            <input type="hidden" name="id_categoria" value="{{ $categoria->id ?? '' }}"> {{-- Campo oculto agregado --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre del Producto </label>
                                            <input type="text" name="nombreproducto" value="{{ $producto->nombreproducto }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Descripcion</label>
                                            <input type="text" name="descripcion" value="{{ $producto->descripcion }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Stock </label>
                                            <input type="number" name="stock" class="form-control" value="{{ $producto->stock }}" readonly>

                                        </div>
                                    </div>
                                  
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Precio Compra</label>
                                            <input type="text" name="preciocompra" value="{{ $producto->preciocompra }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Precio Venta</label>
                                            <input type="text" name="precioventa" value="{{ $producto->precioventa }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-gro">
                                            <a href="{{ url('/productos') }}" class="btn btn-secondary">Cancelar</a>
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