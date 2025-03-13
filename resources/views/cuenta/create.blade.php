@extends('adminlte::page')

@section('title', 'Nuevo Cuenta')

@section('content_header')
    <h1>Nueva Cuenta</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Formulario
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
                        <form method="POST" action="{{ route('cuentas.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('cuenta.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
        </section>
    @endsection
