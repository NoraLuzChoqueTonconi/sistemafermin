@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Crear un Nuevo Usuario</b></h1><br>

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
                        <form action="{{ url('/users') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Correo Electrónico</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Contraseña (Opcional)</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirmar Contraseña</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Roles</label><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="roles[]" value="administrador" id="administrador">
                                            <label class="form-check-label" for="administrador">administrador</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="roles[]" value="empleado" id="empleado">
                                            <label class="form-check-label" for="empleado">empleado</label>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-4">
                                    <label for="id_role">Tipos de Roles</label> <b>*</b>
                                    <select name="roles[]" class="form-control selectpicker" data-live-search="true" disabled>
                                        <option value="">Seleccionar Roles</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col-md-4">
                                    <label>Tipos de Roles</label> <b>*</b><br>
                                
                                    @foreach ($roles as $role)
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input"
                                                type="checkbox" 
                                                name="roles[]" 
                                                value="{{ $role->name }}"
                                                id="role_{{ $role->id }}"
                                                {{ isset($user) && $user->hasRole($role->name) ? 'checked' : '' }}
                                            >
                                            <label class="form-check-label" for="role_{{ $role->id }}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="{{ url('/users') }}" class="btn btn-secondary">Cancelar</a>
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