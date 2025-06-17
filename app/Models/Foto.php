<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Foto
 *
 * @property $id
 * @property $galeria_id
 * @property $url
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Galeria $galeria
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Foto extends Model
{
    
    static $rules = [
		'url' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['galeria_id','url','descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function galeria()
    {
        return $this->hasOne('App\Models\Galeria', 'id', 'galeria_id');
    }
    

}
