@extends('adminlte::page')

@section('title', 'Galerias')

@section('content_header')
<h1>Galerias</h1>
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
                            <a href="{{ route('galerias.create') }}" class="btn btn-info btn-sm float-right"
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
                                        
										<th>Titulo</th>
										<th>Descripcion</th>
										<th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($galerias as $galeria)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $galeria->titulo }}</td>
											<td>{{ $galeria->descripcion }}</td>
											<td>{{ $galeria->estado }}</td>

                                            <td>
                                                <form action="{{ route('galerias.destroy',$galeria->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('galerias.show',$galeria->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('galerias.edit',$galeria->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $galerias->links() !!}
            </div>
        </div>
    </div>
@endsection
