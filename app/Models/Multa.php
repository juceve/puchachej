<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Multa
 *
 * @property $id
 * @property $fecha
 * @property $miembro_id
 * @property $motivo_id
 * @property $detalles
 * @property $monto
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Miembro $miembro
 * @property Motivo $motivo
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Multa extends Model
{
    
    static $rules = [
		'fecha' => 'required',
		'monto' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','miembro_id','motivo_id','detalles','monto','estado'];


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
    public function motivo()
    {
        return $this->hasOne('App\Models\Motivo', 'id', 'motivo_id');
    }
    

}
