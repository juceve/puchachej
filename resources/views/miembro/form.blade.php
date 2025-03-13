<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $miembro->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? '
            is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('direccion') }}
            {{ Form::text('direccion', $miembro->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? '
            is-invalid' : ''), 'placeholder' => 'Direccion']) }}
            {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('telefono') }}
            {{ Form::text('telefono', $miembro->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? '
            is-invalid' : ''), 'placeholder' => 'Telefono']) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Nro. Doc.') }}
            {{ Form::text('nrodoc', $miembro->nrodoc, ['class' => 'form-control' . ($errors->has('nrodoc') ? '
            is-invalid' : ''), 'placeholder' => 'Nrodoc']) }}
            {!! $errors->first('nrodoc', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::email('email', $miembro->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid'
            : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="">Estado</label>
            {!! Form::select('status', ['1'=>'Activo','0'=>'Inactivo'], $miembro->status?1:0, ['class' => 'form-control'
            . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una opcion']) !!}
        </div>
    </div>
    <div class="box-footer mt20 col-12 col-md-3">
        <button type="submit" class="btn btn-primary btn-block">Guardar <i class="fas fa-save"></i></button>
    </div>
</div>