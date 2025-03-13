<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('codigo') }}
            {{ Form::text('codigo', $aporte->codigo, ['class' => 'form-control' . ($errors->has('codigo') ? ' is-invalid' : ''), 'placeholder' => 'Codigo']) }}
            {!! $errors->first('codigo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('gestion') }}
            {{ Form::number('gestion', $aporte->gestion, ['class' => 'form-control' . ($errors->has('gestion') ? ' is-invalid' : ''), 'placeholder' => 'Gestion']) }}
            {!! $errors->first('gestion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('mes') }}
            {!! Form::select('mes', $meses, $aporte->mes ? $aporte->mes : null, [
                'class' => 'form-control' . ($errors->has('mes') ? ' is-invalid' : ''),
            ]) !!}
            {{-- {{ Form::text('mes', $aporte->mes, ['class' => 'form-control' . ($errors->has('mes') ? ' is-invalid' : ''), 'placeholder' => 'Mes']) }} --}}
            {!! $errors->first('mes', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('importe') }}
            {{ Form::number('importe', $aporte->importe, ['class' => 'form-control' . ($errors->has('importe') ? ' is-invalid' : ''), 'placeholder' => '0.00', 'step' => 'any']) }}
            {!! $errors->first('importe', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {!! Form::select('status', ['1' => 'Activo', '0' => 'Inactivo'], $aporte->status ? $aporte->status : 1, [
                'class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''),
                'placeholder' => 'Seleccione una opción',
            ]) !!}
            {{-- {{ Form::text('status', $aporte->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }} --}}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 col-12 col-md-3">
        <button type="submit" class="btn btn-primary btn-block">Guardar <i class="fas fa-save"></i></button>
    </div>
</div>
