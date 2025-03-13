@extends('layouts.app')

@section('template_title')
    Aportemiembro
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Aportemiembro</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('aportemiembros.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Aporte Id:</strong>
                            {{ $aportemiembro->aporte_id }}
                        </div>
                        <div class="form-group">
                            <strong>Miembro Id:</strong>
                            {{ $aportemiembro->miembro_id }}
                        </div>
                        <div class="form-group">
                            <strong>Movimiento Id:</strong>
                            {{ $aportemiembro->movimiento_id }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $aportemiembro->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $aportemiembro->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
