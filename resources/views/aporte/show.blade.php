@extends('layouts.app')

@section('template_title')
    Aporte
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Aporte</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('aportes.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Codigo:</strong>
                            {{ $aporte->codigo }}
                        </div>
                        <div class="form-group">
                            <strong>Gestion:</strong>
                            {{ $aporte->gestion }}
                        </div>
                        <div class="form-group">
                            <strong>Mes:</strong>
                            {{ $aporte->mes }}
                        </div>
                        <div class="form-group">
                            <strong>Importe:</strong>
                            {{ $aporte->importe }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $aporte->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
