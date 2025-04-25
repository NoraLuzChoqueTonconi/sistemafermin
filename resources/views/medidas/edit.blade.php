@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Actualizar las Ventas</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('medidas.update', $medida->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombremedida">Nombre de Medida</label>
                                            <input type="text" id="nombremedida" name="nombremedida" value="{{ $medida->nombremedida }}" class="form-control" required style="text-transform: uppercase;">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="siglamedida">Sigla de Medida</label>
                                            <input type="text" id="siglamedida" name="siglamedida" value="{{ $medida->siglamedida }}" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <!-- Asegura que el label esté en su propia línea -->
                                            <label for="estado" class="d-block fw-bold">Estado</label>
                                    
                                            <!-- Agregar una envoltura para forzar los botones debajo -->
                                            <div class="d-flex flex-column align-items-start">
                                                <input type="hidden" name="estado" id="estado" value="{{ $medida->estado }}">
                                                <div class="btn-group w-100 mt-2" role="group">
                                                    <button type="button" class="btn btn-success {{ $medida->estado == 1 ? 'active' : '' }}" id="btn-activo">Activo</button>
                                                    <button type="button" class="btn btn-danger {{ $medida->estado == 0 ? 'active' : '' }}" id="btn-inactivo">Inactivo</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <a href="{{ url('/medidas') }}" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-success">Actualizar Registro</button>
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


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const inputEstado = document.getElementById("estado");
        const btnActivo = document.getElementById("btn-activo");
        const btnInactivo = document.getElementById("btn-inactivo");
    
        btnActivo.addEventListener("click", function () {
            inputEstado.value = "1";
            btnActivo.classList.add("active");
            btnInactivo.classList.remove("active");
        });
    
        btnInactivo.addEventListener("click", function () {
            inputEstado.value = "0";
            btnInactivo.classList.add("active");
            btnActivo.classList.remove("active");
        });
    });
    </script>
    