@extends('layouts.app')
@section('title')
    Mis Deudas
@endsection
@section('content')
    <!-- Masthead-->
    <header class="masthead">
        <div class="container" style="min-height: 600px;">
            <div class="card" style="opacity: 0.9">
                <div class="card-body">
                    <h4 class="text-secondary mb-4">Mis Deudas</h4>
                    <div class="row text-secondary">
                        <div class="col-12 col-md-4 mb-3">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Cedula:</span>
                                <input type="text" class="form-control" placeholder="Cedula de Identidad" id='cedula'>

                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-3 d-grid">
                            <button class="btn btn-success" onclick='buscarDeudas()'>Buscar <i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>


                    <div class="table-responsive d-none" id="tableDeudas">
                        <table class="table table-striped dataTable" style="font-size: 12px;">
                            <thead>
                                <tr class="table-info">
                                    <th>NRO</th>
                                    <th>MIEMBRO</th>
                                    <th>DETALLE DEUDA</th>
                                    <th>MONTO</th>
                                </tr>
                            </thead>
                            <tbody id="deudas-body">

                            </tbody>
                            <tfoot class="table-secondary">
                                <tr>
                                    <td colspan="3" class="text-end"><strong>TOTAL ADEUDADO:</strong></td>
                                    <td id="total-monto"><strong>0.00</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </header>
@endsection
@section('js')
    <script>
        function buscarDeudas() {
            const cedula = document.getElementById('cedula').value;
            const tableDeudas = document.getElementById('tableDeudas');

            tableDeudas.classList.remove('d-none');

            let total = 0;
            fetch('{{ route('deudas.buscar') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        cedula
                    })
                })
                .then(res => res.json())
                .then(data => {
                    const tbody = document.getElementById('deudas-body');

                    tbody.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach((deuda, i) => {
                            let monto = parseFloat(deuda.monto);
                            tbody.innerHTML += `
                    <tr>
                        <td>${i + 1}</td>
                        <td>${deuda.miembro}</td>
                        <td>${deuda.detalles}</td>
                        <td>${monto.toFixed(2)}</td>
                    </tr>`;
                            total = total + parseFloat(deuda.monto);
                        });
                    } else {
                        tbody.innerHTML = '<tr><td colspan="4"><i>No se encontraron resultados</i></td></tr>';
                    }

                    document.getElementById('total-monto').innerHTML = `<strong>${total.toFixed(2)}</strong>`;

                })
                .then(res => {
                    if (res.status === 429) {
                        alert("Demasiadas solicitudes. Esperá un momento antes de volver a intentar.");
                        return;
                    }
                    return res.json();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
