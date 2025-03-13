<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipopago
 *
 * @property $id
 * @property $nombre
 * @property $nombrecorto
 * @property $created_at
 * @property $updated_at
 *
 * @property Pago[] $pagos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tipopago extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'nombrecorto' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','nombrecorto'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagos()
    {
        return $this->hasMany('App\Models\Pago', 'tipopago_id', 'id');
    }
    

}
