<div>
    @section('title', 'Reporte de Gestión')

    @section('content_header')
    <h1>Reporte de Gestión</h1>
    @stop

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="gestion">Gestion</label>
                        </div>
                        <select class="custom-select" id="gestion" wire:model='gestion'>
                            <option value="">Todas las gestiones</option>
                            @foreach ($gestiones as $gestion)
                            <option value="{{$gestion->gestion}}">{{$gestion->gestion}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('gestion')

                    <small class="text-danger">El campo Gestion es requerido</small>

                    @enderror
                </div>
                <div class="col-12 col-md-2">
                    <button class="btn btn-primary btn-block" wire:click='buscar'>
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @if ($result1 && $result2)
    <div class="card">
        <div class="card-body">
            <h2 class="text-center">REPORTE DE MOVIMIENTOS</h2>
            <p class="text-center">Al {{date('Y-m-d')}}</p>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="table-info">
                        <th class="text-center">NRO</th>
                        <th>DETALLE</th>
                        <th class="text-center">CANTIDAD</th>
                        <th class="text-right">INGRESO Bs.</th>
                        <th class="text-right">EGRESO Bs.</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $ingresos =0;
                    $egresos =0;
                    @endphp

                    @foreach ($result1 as $item)

                    <tr>
                        <td class="text-center">{{$i++}}</td>
                        <td>
                            <button class="btn btn-link text-dark" data-toggle="modal" data-target="#modalMovimientos"
                                onclick='buscarMovimientos({{$item->id}})'>
                                {{$item->movimiento}}
                            </button>
                        </td>
                        <td class="text-center">{{$item->cantidad}}</td>
                        @if ($item->tipo=="INGRESO")
                        @php
                        $ingresos+=$item->total;
                        @endphp
                        <td class="text-right">{{number_format($item->total,1,'.')}}</td>
                        <td class="text-right">0.0</td>
                        @else
                        @php
                        $egresos+=$item->total;
                        @endphp
                        <td class="text-right">0.0</td>
                        <td class="text-right">{{number_format($item->total,1,'.')}}</td>
                        @endif

                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-info">
                        <td colspan="3" class="text-right"><strong>TOTAL</strong></td>
                        <td class="text-right"><strong>{{number_format($ingresos,1,'.')}}</strong></td>
                        <td class="text-right"><strong>{{number_format($egresos,1,'.')}}</strong></td>

                    </tr>
                </tfoot>
            </table>

            <hr>
            @php
            $resultado = $ingresos - $egresos;

            @endphp
            @if ($resultado>=0)
            <h3 class="text-right text-success">
                @else
                <h3 class="text-right text-danger">
                    @endif
                    EN CAJA:
                    {{number_format($resultado,1,'.');}}Bs.
                </h3>
        </div>
    </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="modalMovimientos" tabindex="-1" aria-labelledby="modalMovimientosLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalMovimientosLabel"><strong>Detalle {{$selCuenta}}</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($resultMovimientos)
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="table-primary">
                                <th class="text-center">Nro.</th>
                                <th>Fecha</th>
                                <th>Detalle</th>
                                <th>Tipo</th>
                                <th class="text-right">Monto Bs.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $x=1;
                            $totalmovimiento=0;
                            @endphp
                            @foreach ($resultMovimientos as $item)
                            <tr>
                                <td class="text-center">{{$x++}}</td>
                                <td>{{$item->fecha}}</td>
                                <td>{{$item->descripcion}}</td>
                                <td>{{$item->tipo}}</td>
                                <td class="text-right">{{number_format($item->monto,1,'.')}}</td>
                            </tr>
                            @php
                            $totalmovimiento+=$item->monto
                            @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-primary">
                                <td colspan="4" class="text-right"><strong>TOTAL:</strong></td>
                                <td class="text-right"><strong>{{number_format($totalmovimiento,1,'.')}}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
<script>
    function buscarMovimientos(cuenta_id) {
            Livewire.emit('movimientos',cuenta_id);
        }
</script>
@endsection