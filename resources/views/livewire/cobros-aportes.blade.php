<div>

    @section('title', 'Cobro Aportes')

    @section('content_header')
        <h1>Cobro Aportes</h1>
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
                                        <th>MIEMBRO</th>
                                        <th>CODIGO</th>
                                        <th>ESTADO</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aportesmiembros as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->fecha }}</td>
                                            <td>{{ $item->miembro->nombre }}</td>
                                            <td>{{ $item->aporte->codigo }}</td>
                                            <td>
                                                @if ($item->status)
                                                    <span class="badge badge-pill badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-pill badge-secondary">Inactivo</span>
                                                @endif
                                            </td>
                                            <td align="right">
                                                {{-- <button class="btn btn-info btn-sm" title="Ver Info">
                                                <i class="fas fa-eye"></i>
                                            </button> --}}

                                                <button class="btn btn-sm btn-warning" title="Reimprimir Recibo"
                                                    wire:click='reimpresion({{ $item->id }})'>
                                                    <i class="fas fa-print"></i> Reimprimir
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCobroLabel">Pago de Aportes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click='resetAll'>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label><small>Miembros:</small></label>
                    <div class="form-group">
                        <select name="miembros" id="miembros" class="form-control" wire:model='selMiembro'>
                            <option value="">Seleccione un miembro</option>
                            @foreach ($miembros as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for=""><small>Aportes de la Gestión:</small></label>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" style="font-size: 14px;">
                                <thead class="table-primary">
                                    <tr class="text-center text-uppercase">
                                        <th class="align-middle">Codigo</th>
                                        <th class="align-middle">Mes</th>
                                        <th class="align-middle">Estado</th>
                                        <th class="align-middle">Importe</th>
                                        <th class="align-middle">Sel.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($aportesgestion)
                                        @foreach ($aportesgestion as $item)
                                            @php
                                                $data = explode('-', $item->codigo);
                                            @endphp
                                            <tr class="text-center">

                                                <td class="align-middle">{{ $item->codigo }}</td>
                                                <td class="align-middle">{{ $data[0] }}</td>
                                                <td class="align-middle">
                                                    @if ($data[0] <= date('n') || $data[1] < date('Y'))
                                                        <span class="badge badge-pill badge-danger">
                                                            Impaga</span>
                                                    @else
                                                        <span class="badge badge-pill badge-secondary">Impaga</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    {{ number_format($item->importe, 2, '.') }} Bs.
                                                </td>
                                                <td class="align-middle">
                                                    <input type="checkbox" id="sel1" value="{{ $item->id }}"
                                                        wire:model='selAportes'>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if ($aportesgestion)
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click='resetAll'><i
                                class="fas fa-times"></i> Cerrar</button>
                        <button type="button" class="btn btn-success" wire:click='pagar1'>Pagar <i
                                class="fas fa-cash-register"></i></button>
                    </div>
                @endif

            </div>
        </div>
    </div>

    {{-- Modal Pago2 --}}
    <div class="modal modal-primary fade" id="modalPago2" tabindex="100" aria-labelledby="modalPago2Label"
        aria-hidden="true" data-backdrop="static" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPago2Label">Finalizar Pago</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Total Bs.:</label>
                        <input type="text" class="form-control bg-white" wire:model='montototal' readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Tipo de Pago:</label>
                        <select wire:model='selTipoPago' class="form-control">
                            <option value="">Seleccione un tipo</option>
                            @foreach ($tipopagos as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col col-12 col-md-4"></div>
                        <div class="col col-6 col-md-4">
                            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal"><i
                                    class="fas fa-times-circle"></i> Cerar</button>
                        </div>
                        <div class="col col-6 col-md-4">
                            <button type="button" class="btn btn-primary btn-block" wire:click='pagar2'>Procesar
                                <i class="fas fa-check-circle"></i></button>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

</div>
@section('js')
    <script>
        document.addEventListener('livewire:load', function() {
            $('#modalCobro').on('shown.bs.modal', function() {
                if ($('#miembros').length) {
                    $('#miembros').select2({
                        theme: 'bootstrap4',
                        dropdownParent: $('#modalCobro .modal-body')
                    });
                    $('#miembros').on('change', function(e) {
                        var data = $('#miembros').select2("val");
                        @this.set('selMiembro', data);
                    });
                    Livewire.hook('message.processed', (message, component) => {
                        $('#miembros').select2({
                            theme: 'bootstrap4',
                            dropdownParent: $('#modalCobro .modal-body')
                        });
                    });
                }

            });
        });
    </script>

    <script>
        Livewire.on('abrirpago2', () => {
            $('#modalPago2').modal('show');
        });

        Livewire.on('cerrarModales', () => {
            $('#modalCobro').modal('hide');
            $('#modalPago2').modal('hide');
        });

        Livewire.on('dataTable', () => {
            $('.dataTable').DataTable({
                destroy: true,
                order: [
                    [0, 'desc']
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                responsive: {
                    details: false
                }
            });
        });
    </script>
    <script>
        $('.dataTable').DataTable({

            destroy: true,
            order: [
                [0, 'desc']
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            responsive: {
                details: false
            }
        });
    </script>
@endsection
