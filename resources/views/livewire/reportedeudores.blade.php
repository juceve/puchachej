<div>
    @section('title', 'Reporte de Deudores')

    @section('content_header')
    <h1>Reporte de Deudores</h1>
    @stop

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped dataTable">
                    <thead>
                        <tr class="table-info">
                            <th>NRO</th>
                            <th>MIEMBRO</th>
                            <th>DETALLE DEUDA</th>
                            <th>MONTO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deudas as $deuda)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$deuda->miembro}}</td>
                                <td>{{$deuda->detalles}}</td>
                                <td>{{$deuda->monto}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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
