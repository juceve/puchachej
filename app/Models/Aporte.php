<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Aporte
 *
 * @property $id
 * @property $codigo
 * @property $gestion
 * @property $mes
 * @property $importe
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Aportemiembro[] $aportemiembros
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Aporte extends Model
{
    
    static $rules = [
		'codigo' => 'required',
		'gestion' => 'required',
		'mes' => 'required',
		'importe' => 'required',
		'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['codigo','gestion','mes','importe','status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aportemiembros()
    {
        return $this->hasMany('App\Models\Aportemiembro', 'aporte_id', 'id');
    }
    

}
