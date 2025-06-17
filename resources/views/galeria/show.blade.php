@extends('layouts.app')

@section('template_title')
    {{ $galeria->name ?? "{{ __('Show') Galeria" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Galeria</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('galerias.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Titulo:</strong>
                            {{ $galeria->titulo }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $galeria->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $galeria->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
