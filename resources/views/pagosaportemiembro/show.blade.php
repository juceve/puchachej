@extends('layouts.app')

@section('template_title')
    Pagosaportemiembro
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Pagosaportemiembro</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('pagosaportemiembros.index') }}">
                                {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Aportemiembro Id:</strong>
                            {{ $pagosaportemiembro->aportemiembro_id }}
                        </div>
                        <div class="form-group">
                            <strong>Pago Id:</strong>
                            {{ $pagosaportemiembro->pago_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
