@extends('adminlte::page')

@section('title', 'Info Cuenta')

@section('content_header')
    <h1>Info Cuenta</h1>
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
                                <a href="{{ route('cuentas.index') }}" class="btn btn-info btn-sm float-right"
                                    data-placement="left">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $cuenta->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $cuenta->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            @if ($cuenta->status)
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
