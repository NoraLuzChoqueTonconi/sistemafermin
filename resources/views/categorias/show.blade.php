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
                    <div class="card-body" style="...">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Codigo de Categoria</label>
                                        <input type="text" name="codigo" value="{{ $categoria->codigo }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Nombre de la Categoria</label>
                                    <input type="text" name="nombrecategoria" value="{{ $categoria->nombrecategoria }}" class="form-control" disabled>
                                </div>
                                                                
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="logo">Imagen</label><br>
                                    <img src="{{asset('storage/'.$categoria->imagen)}}" width="80px" alt="imagen">
                                </div>
                            </div>
                        </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-gro">
                                        <a href="{{ url('/categorias') }}" class="btn btn-secondary">Atras</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

