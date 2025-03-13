<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::text('fecha', $pago->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('importe') }}
            {{ Form::text('importe', $pago->importe, ['class' => 'form-control' . ($errors->has('importe') ? ' is-invalid' : ''), 'placeholder' => 'Importe']) }}
            {!! $errors->first('importe', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipopago_id') }}
            {{ Form::text('tipopago_id', $pago->tipopago_id, ['class' => 'form-control' . ($errors->has('tipopago_id') ? ' is-invalid' : ''), 'placeholder' => 'Tipopago Id']) }}
            {!! $errors->first('tipopago_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $pago->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>