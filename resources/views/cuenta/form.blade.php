<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $cuenta->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipo') }}
            {!! Form::select('tipo', ['INGRESO' => 'INGRESO', 'EGRESO' => 'EGRESO'], $cuenta->tipo ? $cuenta->tipo : '', [
                'class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''),
                'placeholder' => 'Seleccione una opción',
            ]) !!}
            {{-- {{ Form::text('tipo', $cuenta->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }} --}}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('Estado') }}
            {!! Form::select('status', ['1' => 'Activo', '0' => 'Inactivo'], $cuenta->status ? $cuenta->status : 1, [
                'class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''),
                'placeholder' => 'Seleccione una opción',
            ]) !!}
            {{-- {{ Form::text('status', $cuenta->status ? $cuenta->status : 1, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }} --}}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 col-12 col-md-3">
        <button type="submit" class="btn btn-primary btn-block">Guardar <i class="fas fa-save"></i></button>
    </div>
</div>
