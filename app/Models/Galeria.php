<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Galeria
 *
 * @property $id
 * @property $titulo
 * @property $descripcion
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Foto[] $fotos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Galeria extends Model
{
    
    static $rules = [
		'titulo' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo','descripcion','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fotos()
    {
        return $this->hasMany('App\Models\Foto', 'galeria_id', 'id');
    }
    

}
