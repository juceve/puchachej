@extends('adminlte::page')

@section('title', 'Info Miembro')

@section('content_header')
    <h1>Info Miembro</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Detalles
                            </span>

                            <div class="float-right">
                                <a href="{{ route('miembros.index') }}" class="btn btn-info btn-sm float-right"
                                    data-placement="left">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $miembro->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $miembro->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $miembro->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Nrodoc:</strong>
                            {{ $miembro->nrodoc }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $miembro->email }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            @if ($miembro->status)
                                <span class="badge badge-pill badge-success">Activo</span>
                            @else
                                <span class="badge badge-pill badge-secondary">Inactivo</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    @endsection
