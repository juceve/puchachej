@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>FRATERNINDA PUCHACHEJ</h1>
    <span>Fund. 24 de Febrero de 2004</span>
@stop

@section('content')
    <div class="card">
        <div class="card-header bg-success">
            <h5>CUMPLEAÑEROS DEL MES 🎂🎈</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Miembro</th>
                            <th>Día</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cumpleaneros as $cumple)
                            <tr>
                                <td>{{ $cumple->nombre }}</td>
                                <td>{{ $cumple->fecha_literal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
