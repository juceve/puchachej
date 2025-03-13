@extends('adminlte::page')

@section('title', 'Miembros')

@section('content_header')
    <h1>Miembros</h1>
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
                                <a href="{{ route('miembros.create') }}" class="btn btn-info btn-sm float-right"
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

                                        <th>Nombre</th>
                                        <th>Telefono</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($miembros as $miembro)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $miembro->nombre }}</td>
                                            <td>{{ $miembro->telefono }}</td>
                                            <td>
                                                @if ($miembro->status)
                                                    <span class="badge badge-pill badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-pill badge-secondary">Inactivo</span>
                                                @endif
                                            </td>
                                            <td align="right">
                                                <form action="{{ route('miembros.destroy', $miembro->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('miembros.show', $miembro->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('miembros.edit', $miembro->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $miembros->links() !!}
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
