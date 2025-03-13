@extends('layouts.app')

@section('template_title')
    Pagosaportemiembro
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Pagosaportemiembro') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('pagosaportemiembros.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Aportemiembro Id</th>
										<th>Pago Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pagosaportemiembros as $pagosaportemiembro)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $pagosaportemiembro->aportemiembro_id }}</td>
											<td>{{ $pagosaportemiembro->pago_id }}</td>

                                            <td>
                                                <form action="{{ route('pagosaportemiembros.destroy',$pagosaportemiembro->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('pagosaportemiembros.show',$pagosaportemiembro->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('pagosaportemiembros.edit',$pagosaportemiembro->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $pagosaportemiembros->links() !!}
            </div>
        </div>
    </div>
@endsection
