<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Motivo
 *
 * @property $id
 * @property $nombre
 * @property $descripcion
 * @property $importe
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Motivo extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'importe' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','descripcion','importe'];



}
