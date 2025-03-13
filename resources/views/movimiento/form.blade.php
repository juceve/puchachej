<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('fecha') }}
                    {{ Form::date('fecha', $movimiento->fecha ? $movimiento->fecha : date('Y-m-d'), ['class' =>
                    'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                    {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('cuenta') }}
                    {!! Form::select('cuenta_id', $cuentas, $movimiento->cuenta_id ? $movimiento->cuenta_id : '', [
                    'class' => 'form-control' . ($errors->has('cuenta_id') ? ' is-invalid' : ''),
                    'placeholder' => 'Seleccione una cuenta',
                    ]) !!}
                    {!! $errors->first('cuenta_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    {{ Form::label('descripción') }}
                    {{ Form::text('descripcion', $movimiento->descripcion, ['class' => 'form-control' .
                    ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripción']) }}
                    {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('Monto Bs.') }}
                    {{ Form::number('monto', $movimiento->monto, ['class' => 'form-control' . ($errors->has('monto') ? '
                    is-invalid' : ''), 'placeholder' => '0.00', 'step' => 'any']) }}
                    {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-12 col-md-6">
                {!! Form::label('tipopago_id', 'Tipo Pago') !!}
                {!! Form::select('tipopago_id', $tipopagos, $movimiento->tipopago_id?$movimiento->tipopago_id:"",
                [
                'class' => 'form-control' . ($errors->has('tipopago_id') ? ' is-invalid' : ''),
                'placeholder' => 'Seleccione un tipo',
                ]
                ) !!}
            </div>
            <div class="col-12 col-md-6">

            </div>
        </div>

        <div class="form-group d-none">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $movimiento->user_id ? $movimiento->user_id : Auth::user()->id, ['class' =>
            'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group d-none">
            {{ Form::label('status') }}
            {{ Form::text('status', $movimiento->status ? $movimiento->status : 1, ['class' => 'form-control' .
            ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 col-12 col-md-3">
        <button type="submit" class="btn btn-primary btn-block">Guardar <i class="fas fa-save"></i></button>
    </div>
</div>