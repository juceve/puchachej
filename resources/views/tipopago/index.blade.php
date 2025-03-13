@extends('adminlte::page')

@section('title', 'Tipo de Pagos')

@section('content_header')
    <h1>Tipo de Pagos</h1>
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
                                <a href="{{ route('tipopagos.create') }}" class="btn btn-info btn-sm float-right"
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
                                        <th>Nombre corto</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipopagos as $tipopago)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $tipopago->nombre }}</td>
                                            <td>{{ $tipopago->nombrecorto }}</td>

                                            <td align="right">
                                                <form action="{{ route('tipopagos.destroy', $tipopago->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('tipopagos.show', $tipopago->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('tipopagos.edit', $tipopago->id) }}"><i
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
                {!! $tipopagos->links() !!}
            </div>
        </div>
    </div>
    {{-- @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif --}}
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
