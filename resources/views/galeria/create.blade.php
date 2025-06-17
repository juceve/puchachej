@extends('adminlte::page')

@section('title', 'Nueva Galeria')

@section('content_header')
    <h1>Nueva Galeria</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Registro de Galerias
                            </span>

                            <div class="float-right">
                                <a href="{{ route('galerias.index') }}" class="btn btn-info btn-sm float-right"
                                    data-placement="left">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                       
                        <form action="{{ route('fotos.upload') }}" method="POST" class="dropzone" id="uploads"
                            enctype="multipart/form-data">
                            @csrf
                        </form>
                        <form action="{{ route('galerias.store') }}" method="POST">
                            @csrf
                            <div class="form-group mt-3">
                                <label>Titulo Galeria</label>
                                <input type="text" class="form-control" name="titulo">
                                <label>Descripción</label>
                                <input type="text" class="form-control" name="descripcion"> 
                                <input type="hidden" id="imagenes_temp" name="imagenes_temp">
                            </div>


                            <button class="btn btn-primary">Registrar Galeria <i class="fas fa-save"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </section>
    @endsection
    @section('css')
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @endsection
    @section('js')
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <script>
            let imagenesTemporales = [];
            Dropzone.options.uploads = { // camelized version of the `id`
                dictDefaultMessage: "Suelta tus imágenes aquí o haz clic para subir 📸",
                paramName: "file", // The name that will be used to transfer the file
                acceptedFiles: "image/*",
                maxFilesize: 5,
                success: function(file, response) {
                    imagenesTemporales.push(response.path);
                    document.getElementById('imagenes_temp').value = imagenesTemporales.join('|');
                    console.log('Respuesta del servidor:', imagenesTemporales);
                },
                error: function(file, response) {
                    console.error('Error al subir:', response);
                }
            };
        </script>
    @endsection
