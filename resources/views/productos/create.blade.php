@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Crear un Nuevo Producto</b></h1><br>

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
                    <div class="card card-body">
                        <form action="{{ url('/productos') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codigo">Codigo</label> <b>*</b>
                                        <input type="text" name="codigo" value="{{ old('codigo') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id_categoria">Categoría</label> <b>*</b>
                                        <select name="id_categoria" class="form-control" required>
                                            <option value="" disabled selected>Seleccione una categoría</option> <!-- Aquí el cambio -->
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}" {{ old('id_categoria') == $categoria->id ? 'selected' : '' }}>
                                                    {{ $categoria->nombrecategoria }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="descripcion">Nombre del Producto</label> <b>*</b>
                                        <input type="text" name="nombreproducto" value="{{ old('nombreproducto') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="descripcion">Descripcion</label> <b>*</b>
                                        <input type="text" name="descripcion" value="{{ old('descripcion') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="stockminimo">Stock </label> <b>*</b>
                                        <input type="text" name="stock" value="{{ old('stock') }}" class="form-control">
                                    </div>
                                </div>
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="preciocompra">Precio Compra</label> <b>*</b>
                                        <input type="number" name="preciocompra" value="{{ old('preciocompra') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="precioventa">Precio Venta</label> <b>*</b>
                                        <input type="number" name="precioventa" value="{{ old('precioventa') }}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="{{ url('/productos') }}" class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Guardar registro</button>
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
