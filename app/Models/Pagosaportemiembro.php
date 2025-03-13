<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pagosaportemiembro
 *
 * @property $id
 * @property $aportemiembro_id
 * @property $pago_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Aportemiembro $aportemiembro
 * @property Pago $pago
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pagosaportemiembro extends Model
{
    
    static $rules = [
		'aportemiembro_id' => 'required',
		'pago_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['aportemiembro_id','pago_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function aportemiembro()
    {
        return $this->hasOne('App\Models\Aportemiembro', 'id', 'aportemiembro_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pago()
    {
        return $this->hasOne('App\Models\Pago', 'id', 'pago_id');
    }
    

}
