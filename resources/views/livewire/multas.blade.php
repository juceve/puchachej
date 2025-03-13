<div>
    @section('title', 'Multas')

    @section('content_header')
        <h1>Multas</h1>
    @stop


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
                                <button class="btn btn-info btn-sm float-right" data-placement="left" data-toggle="modal"
                                    data-target="#modalCobro">
                                    <i class="fas fa-plus"></i> Nuevo
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>FECHA</th>
                                        <th>NOMBRE MIEMBRO</th>
                                        <th>MOTIVO</th>
                                        <th>IMPORTE Bs.</th>
                                        <th>ESTADO</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($multas as $multa)
                                        <tr>
                                            <td>{{ $multa->id }}</td>
                                            <td>{{ $multa->fecha }}</td>
                                            <td>{{ $multa->miembro->nombre }}</td>
                                            <td>{{ $multa->motivo->nombre }}</td>
                                            <td>{{ $multa->monto }}</td>
                                            <td>
                                                @if ($multa->estado)
                                                    <span class="badge badge-pill badge-success">Pagado</span>
                                                @else
                                                    <span class="badge badge-pill badge-warning">Impaga</span>
                                                @endif
                                            </td>
                                            <td align="right">
                                                <button class="btn btn-sm btn-success" title="Pagar"
                                                    onclick="pagar({{ $multa->id }})"
                                                    @if ($multa->estado) disabled @endif>
                                                    <i class="fas fa-hand-holding-usd"></i></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" title="Eliminar"
                                                    onclick="eliminar({{ $multa->id }})"
                                                    @if ($multa->estado) disabled @endif>
                                                    <i class="fas fa-trash"></i></i>
                                                </button>

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

    <!-- Modal -->
    <div class="modal fade" id="modalCobro" tabindex="-1" role="dialog" aria-labelledby="modalCobroLabel"
        aria-hidden="true" data-backdrop="static" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalCobroLabel">REGISTRAR MULTA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td>
                                        <label>Miembro:</label>
                                    </td>
                                    <td>
                                        <select class="form-control" wire:model='miembro_id'>
                                            <option value="">Seleccione un Miembro </option>
                                            @foreach ($miembros as $miembro)
                                                <option value="{{ $miembro->id }}">{{ $miembro->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Motivo:</label>
                                    </td>
                                    <td>
                                        <select class="form-control" wire:model='motivoid'>
                                            <option value="">Seleccione un Motivo </option>
                                            @foreach ($motivos as $motivo)
                                                <option value="{{ $motivo->id }}">{{ $motivo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Detalles:</label></td>
                                    <td>
                                        <textarea rows="2" class="form-control" wire:model='detalles'></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Monto Bs.:</label></td>
                                    <td>
                                        <input type="number" class="form-control" step="any" wire:model='monto'>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Estado:</label></td>
                                    <td>
                                        <select class="form-control" wire:model='estado'>
                                            <option value="0">Impaga</option>
                                            <option value="1">Pagada</option>
                                        </select>
                                    </td>
                                </tr>
                                @if ($estado)
                                    <tr>
                                        <td>
                                            <label>Tipo Pago:</label>
                                        </td>
                                        <td>
                                            <select class="form-control" wire:model='tipopagoid'>
                                                <option value="">Seleccione un Tipo Pago </option>
                                                @foreach ($tipopagos as $tipopago)
                                                    <option value="{{ $tipopago->id }}">{{ $tipopago->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-block" wire:click='registrar'>REGISTRAR <i
                            class="fa fa-save"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script>
        $('.dataTable').DataTable({
            destroy: true,
            "aaSorting": [
                [1, 'desc'],
                [3, 'asc']
            ],
            responsive: {
                details: false
            }
        });
    </script>

    <script>
        Livewire.on('cerrarModales', () => {
            $('#modalCobro').modal('hide');
        });

        Livewire.on('resetDataTable', () => {
            $('.dataTable').DataTable({
                destroy: true,
                "aaSorting": [
                    [1, 'desc'],
                    [3, 'asc']
                ],
                responsive: {
                    details: false
                }
            });
        });
    </script>
    <script>
        function pagar(id) {
            Swal.fire({
                title: "PAGAR MULTA",
                text: "Está seguro de realizar esta operación?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, continuar",
                cancelButtonText: "No, cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('pagar', id);
                }
            });
        }
    </script>
    <script>
        function eliminar(id) {
            Swal.fire({
                title: "ELIMINAR MULTA",
                text: "Está seguro de realizar esta operación?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, continuar",
                cancelButtonText: "No, cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('delete', id);
                }

            });
        }
    </script>
@endsection
