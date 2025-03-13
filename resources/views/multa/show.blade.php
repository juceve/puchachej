@extends('layouts.app')

@section('template_title')
    {{ $multa->name ?? "{{ __('Show') Multa" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Multa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('multas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $multa->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Miembro Id:</strong>
                            {{ $multa->miembro_id }}
                        </div>
                        <div class="form-group">
                            <strong>Motivo Id:</strong>
                            {{ $multa->motivo_id }}
                        </div>
                        <div class="form-group">
                            <strong>Detalles:</strong>
                            {{ $multa->detalles }}
                        </div>
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $multa->monto }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $multa->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
