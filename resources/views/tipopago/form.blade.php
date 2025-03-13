<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $tipopago->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombrecorto') }}
            {{ Form::text('nombrecorto', $tipopago->nombrecorto, ['class' => 'form-control' . ($errors->has('nombrecorto') ? ' is-invalid' : ''), 'placeholder' => 'Nombrecorto']) }}
            {!! $errors->first('nombrecorto', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 col-12 col-md-3">
        <button type="submit" class="btn btn-primary btn-block">Guardar <i class="fas fa-save"></i></button>
    </div>
</div>
