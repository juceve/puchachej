@extends('layouts.app')

@section('template_title')
    Multa
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Multa') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('multas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Fecha</th>
										<th>Miembro Id</th>
										<th>Motivo Id</th>
										<th>Detalles</th>
										<th>Monto</th>
										<th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($multas as $multa)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $multa->fecha }}</td>
											<td>{{ $multa->miembro_id }}</td>
											<td>{{ $multa->motivo_id }}</td>
											<td>{{ $multa->detalles }}</td>
											<td>{{ $multa->monto }}</td>
											<td>{{ $multa->estado }}</td>

                                            <td>
                                                <form action="{{ route('multas.destroy',$multa->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('multas.show',$multa->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('multas.edit',$multa->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $multas->links() !!}
            </div>
        </div>
    </div>
@endsection
