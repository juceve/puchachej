<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Miembro
 *
 * @property $id
 * @property $nombre
 * @property $direccion
 * @property $telefono
 * @property $nrodoc
 * @property $email
 * @property $created_at
 * @property $updated_at
 *
 * @property Aportemiembro[] $aportemiembros
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Miembro extends Model
{

    static $rules = [
        'nombre' => 'required',
        'telefono' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'direccion', 'telefono', 'nrodoc', 'email', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aportemiembros()
    {
        return $this->hasMany('App\Models\Aportemiembro', 'miembro_id', 'id');
    }
}
