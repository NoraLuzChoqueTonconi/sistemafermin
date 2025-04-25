@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Actualizar las Categorias</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/categorias',$categoria->id) }}" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Codigo De Categoria</label>
                                            <input type="text" name="codigo" value="{{ $categoria->codigo }}" class="form-control" required style="text-transform: uppercase;">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre de Categoris</label>
                                            <input type="text" name="nombrecategoria" value="{{ $categoria->nombrecategoria }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="logo">Imagen</label>
                                            <input type="file" id="file" name="imagen" accept=".jpg, .jpeg, .png" class="form-control">
                                            @error('imagen')
                                            <small style="color: red;">{{$message}}</small>
                                            @enderror
                                            <br>
                                            <center><output id="list"><img src="{{asset('storage/'.$categoria->imagen)}}" width="80px" alt="imagen"></output></center>
                                            <script>
                                                function archivo(evt) {
                                                    var files = evt.target.files; // FileList object
                                                    // Obtenemos la imagen del campo "file".
                                                    for (var i = 0, f; f = files[i]; i++) {
                                                        //Solo admitimos imágenes.
                                                        if (!f.type.match('image.*')) {
                                                            continue;
                                                        }
                                                        var reader = new FileReader();
                                                        reader.onload = (function (theFile) {
                                                            return function (e) {
                                                                // Insertamos la imagen
                                                                document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="',e.target.result, '" width="70%" title="', escape(theFile.name), '"/>'].join('');
                                                            };
                                                        })(f);
                                                        reader.readAsDataURL(f);
                                                    }
                                                }
                                                document.getElementById('file').addEventListener('change', archivo, false);
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-gro">
                                            <a href="{{ url('/categorias') }}" class="btn btn-secondary">Cancelar</a>
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
