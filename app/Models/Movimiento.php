<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Movimiento
 *
 * @property $id
 * @property $fecha
 * @property $descripcion
 * @property $cuenta_id
 * @property $user_id
 * @property $monto
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Aportemiembro[] $aportemiembros
 * @property Cuenta $cuenta
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Movimiento extends Model
{

    static $rules = [
        'fecha' => 'required',
        'cuenta_id' => 'required',
        'user_id' => 'required',
        'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha', 'descripcion', 'cuenta_id', 'user_id', 'monto', 'tipopago_id', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aportemiembros()
    {
        return $this->hasMany('App\Models\Aportemiembro', 'movimiento_id', 'id');
    }
    public function pagos()
    {
        return $this->hasMany('App\Models\Pago', 'movimiento_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cuenta()
    {
        return $this->hasOne('App\Models\Cuenta', 'id', 'cuenta_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function tipopago()
    {
        return $this->hasOne('App\Models\Tipopago', 'id', 'tipopago_id');
    }
}
