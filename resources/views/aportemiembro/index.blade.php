@extends('adminlte::page')

@section('title', 'Aporte Miembros')

@section('content_header')
    <h1>Aporte Miembros</h1>
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
                                <a href="{{ route('cuentas.create') }}" class="btn btn-info btn-sm float-right"
                                    data-placement="left">
                                    <i class="fas fa-plus"></i> Nuevo
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Aporte Id</th>
                                        <th>Miembro Id</th>
                                        <th>Movimiento Id</th>
                                        <th>Fecha</th>
                                        <th>Status</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aportemiembros as $aportemiembro)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $aportemiembro->aporte_id }}</td>
                                            <td>{{ $aportemiembro->miembro_id }}</td>
                                            <td>{{ $aportemiembro->movimiento_id }}</td>
                                            <td>{{ $aportemiembro->fecha }}</td>
                                            <td>{{ $aportemiembro->status }}</td>

                                            <td>
                                                <form action="{{ route('aportemiembros.destroy', $aportemiembro->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('aportemiembros.show', $aportemiembro->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('aportemiembros.edit', $aportemiembro->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $aportemiembros->links() !!}
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
