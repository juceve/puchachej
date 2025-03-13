@extends('adminlte::page')

@section('title', 'Info Moviento')

@section('content_header')
<h1>Info Moviento</h1>
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
                            <a href="{{ route('movimientos.index') }}" class="btn btn-info btn-sm float-right"
                                data-placement="left">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Fecha:</strong>
                        {{ $movimiento->fecha }}
                    </div>
                    <div class="form-group">
                        <strong>Descripción:</strong>
                        {{ $movimiento->descripcion }}
                    </div>
                    <div class="form-group">
                        <strong>Cuenta:</strong>
                        {{ $movimiento->cuenta->nombre }}
                    </div>
                    <div class="form-group">
                        <strong>Tipo:</strong>
                        {{ $movimiento->cuenta->tipo }}
                    </div>
                    <div class="form-group">
                        <strong>Usuario:</strong>
                        {{ $movimiento->user->name }}
                    </div>
                    <div class="form-group">
                        <strong>Monto Bs.:</strong>
                        {{ $movimiento->monto }}
                    </div>
                    <div class="form-group">
                        <strong>Tipo Pago:</strong>
                        {{ $movimiento->tipopago->nombre }}
                    </div>
                    <div class="form-group">
                        <strong>Estado:</strong>
                        @if ($movimiento->status)
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