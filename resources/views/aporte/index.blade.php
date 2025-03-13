@extends('adminlte::page')

@section('title', 'Aportes')

@section('content_header')
    <h1>Aportes</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Listado
                            </span>

                            <div class="float-right">
                                <a href="{{ route('generargestion') }}" class="btn btn-info btn-sm float-right"
                                    data-placement="left">
                                    <i class="fas fa-cogs"></i> Generar Gestión
                                </a>
                                <a href="{{ route('aportes.create') }}" class="btn btn-info btn-sm float-right"
                                    data-placement="left">
                                    <i class="fas fa-plus"></i> Nuevo
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover dataTable">
                                <thead class="thead">
                                    <tr class="text-uppercase">
                                        <th>No</th>

                                        <th>Codigo</th>
                                        <th>Gestion</th>
                                        <th>Mes</th>
                                        <th>Importe</th>
                                        <th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aportes as $aporte)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $aporte->codigo }}</td>
                                            <td>{{ $aporte->gestion }}</td>
                                            <td>{{ $aporte->mes }}</td>
                                            <td>{{ $aporte->importe }}</td>
                                            <td>
                                                @if ($aporte->status)
                                                    <span class="badge badge-pill badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-pill badge-secondary">Inactivo</span>
                                                @endif
                                            </td>

                                            <td align="right">
                                                <form action="{{ route('aportes.destroy', $aporte->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('aportes.edit', $aporte->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.dataTable').DataTable({
            destroy: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            responsive: {
                details: false
            }
        });
    </script>
@endsection
