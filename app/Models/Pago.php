<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pago
 *
 * @property $id
 * @property $fecha
 * @property $importe
 * @property $tipopago_id
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Pagosaportemiembro[] $pagosaportemiembros
 * @property Tipopago $tipopago
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pago extends Model
{

    static $rules = [
        'fecha' => 'required',
        'importe' => 'required',
        'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha', 'importe', 'tipopago_id', 'movimiento_id', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagosaportemiembros()
    {
        return $this->hasMany('App\Models\Pagosaportemiembro', 'pago_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipopago()
    {
        return $this->hasOne('App\Models\Tipopago', 'id', 'tipopago_id');
    }
    public function movimiento()
    {
        return $this->hasOne('App\Models\Movimiento', 'id', 'movimiento_id');
    }
}
