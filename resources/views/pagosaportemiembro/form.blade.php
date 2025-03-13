<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('aportemiembro_id') }}
            {{ Form::text('aportemiembro_id', $pagosaportemiembro->aportemiembro_id, ['class' => 'form-control' . ($errors->has('aportemiembro_id') ? ' is-invalid' : ''), 'placeholder' => 'Aportemiembro Id']) }}
            {!! $errors->first('aportemiembro_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('pago_id') }}
            {{ Form::text('pago_id', $pagosaportemiembro->pago_id, ['class' => 'form-control' . ($errors->has('pago_id') ? ' is-invalid' : ''), 'placeholder' => 'Pago Id']) }}
            {!! $errors->first('pago_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>