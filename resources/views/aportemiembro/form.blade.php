<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('aporte_id') }}
            {{ Form::text('aporte_id', $aportemiembro->aporte_id, ['class' => 'form-control' . ($errors->has('aporte_id') ? ' is-invalid' : ''), 'placeholder' => 'Aporte Id']) }}
            {!! $errors->first('aporte_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('miembro_id') }}
            {{ Form::text('miembro_id', $aportemiembro->miembro_id, ['class' => 'form-control' . ($errors->has('miembro_id') ? ' is-invalid' : ''), 'placeholder' => 'Miembro Id']) }}
            {!! $errors->first('miembro_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('movimiento_id') }}
            {{ Form::text('movimiento_id', $aportemiembro->movimiento_id, ['class' => 'form-control' . ($errors->has('movimiento_id') ? ' is-invalid' : ''), 'placeholder' => 'Movimiento Id']) }}
            {!! $errors->first('movimiento_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::text('fecha', $aportemiembro->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $aportemiembro->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>