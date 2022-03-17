<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imagen extends Model
{
    use SoftDeletes;

    protected $table = 'imagenes';

    protected $fillable = [
        'id',
        'publicacion_id', 
        'imagen', 
        'estado', 
        'deleted_at'
    ];
}
