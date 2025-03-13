<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Aportemiembro
 *
 * @property $id
 * @property $aporte_id
 * @property $miembro_id
 * @property $movimiento_id
 * @property $fecha
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Aporte $aporte
 * @property Miembro $miembro
 * @property Movimiento $movimiento
 * @property Pagosaportemiembro[] $pagosaportemiembros
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Aportemiembro extends Model
{
    
    static $rules = [
		'aporte_id' => 'required',
		'miembro_id' => 'required',
		'movimiento_id' => 'required',
		'fecha' => 'required',
		'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['aporte_id','miembro_id','movimiento_id','fecha','status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function aporte()
    {
        return $this->hasOne('App\Models\Aporte', 'id', 'aporte_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function miembro()
    {
        return $this->hasOne('App\Models\Miembro', 'id', 'miembro_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function movimiento()
    {
        return $this->hasOne('App\Models\Movimiento', 'id', 'movimiento_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagosaportemiembros()
    {
        return $this->hasMany('App\Models\Pagosaportemiembro', 'aportemiembro_id', 'id');
    }
    

}
