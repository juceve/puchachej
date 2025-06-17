@extends('layouts.app')

@section('template_title')
    Foto
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Foto') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('fotos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Galeria Id</th>
										<th>Url</th>
										<th>Descripcion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fotos as $foto)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $foto->galeria_id }}</td>
											<td>{{ $foto->url }}</td>
											<td>{{ $foto->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('fotos.destroy',$foto->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('fotos.show',$foto->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('fotos.edit',$foto->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $fotos->links() !!}
            </div>
        </div>
    </div>
@endsection
