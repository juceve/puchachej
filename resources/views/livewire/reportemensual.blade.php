<div>
    @section('title', 'Reporte Mensual')

    @section('content_header')
    <h1>Reporte Mensual</h1>
    @stop

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="mes">Mes</label>
                        </div>
                        <select class="custom-select" id="mes" wire:model.defer='mes'>
                            <option value="">Seleccione un Mes</option>
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>
                    @error('mes')

                    <small class="text-danger">El campo Mes es requerido</small>

                    @enderror

                </div>
                <div class="col-12 col-md-3">
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="gestion">Gestion</label>
                        </div>
                        <select class="custom-select" id="gestion" wire:model.defer='gestion'>
                            <option value="">Seleccione un Gestion</option>
                            @foreach ($gestiones as $gestion)
                            <option value="{{$gestion->gestion}}">{{$gestion->gestion}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('gestion')

                    <small class="text-danger">El campo Gestion es requerido</small>

                    @enderror
                </div>
                <div class="col-12 col-md-3">
                    <button class="btn btn-primary btn-block" wire:click='generar'>Generar <i
                            class="fas fa-cog"></i></button>
                </div>
            </div>
        </div>
    </div>

    @if (!is_null($tabla1))
    <div class="card">
        <div class="card-header bg-info text-white font-weight-bold">
            REPORTE MENSUAL: {{$tabla1Title}}
        </div>
        <div class="card-body">
            <h4 class="text-center">TABLA GENERAL</h4>
            <p class="text-center">Segmento: {{$tabla1Title}}</p>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-info">
                        <tr class="text-center">
                            <th>Nro</th>
                            <th>CUENTA</th>
                            <th>CANTIDAD</th>
                            <th>INGRESO</th>
                            <th>EGRESO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $totalI = 0;
                        $totalE = 0;
                        @endphp
                        @if (count($tabla1)>0)
                        @forelse ($tabla1 as $item)
                        <tr>
                            <td align="center">{{$i++}}</td>
                            <td>{{$item->cuenta}}</td>
                            <td align="center">{{$item->cantidad}}</td>
                            <td align="right">
                                @if ($item->tipo=='INGRESO')
                                {{number_format($item->monto,2,'.')}}
                                @php
                                $totalI += $item->monto;
                                @endphp
                                @else
                                0.00
                                @endif
                            </td>
                            <td align="right">
                                @if ($item->tipo=='EGRESO')
                                {{number_format($item->monto,2,'.')}}
                                @php
                                $totalE += $item->monto;
                                @endphp
                                @else
                                0.00
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        <tr class="table-info font-weight-bold">
                            <td align="right" colspan="3">TOTAL:</td>
                            <td align="right">{{number_format($totalI,2,'.')}}</td>
                            <td align="right">{{number_format($totalE,2,'.')}}</td>
                        </tr>
                        @php
                        $saldo = $totalI - $totalE;
                        $color = "";
                        if($saldo >= 0){
                        $color = "success";
                        }else{
                        $color = "danger";
                        }
                        @endphp
                        <tr class="table-{{$color}} font-weight-bold">
                            <td colspan="3" align="right">SALDO:</td>
                            <td colspan="2" align="center">{{number_format($saldo,2,'.')}}</td>
                        </tr>
                        @else
                        <tr>
                            <td colspan="5" align="center">No existen registros</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

</div>