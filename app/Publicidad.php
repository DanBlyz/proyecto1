<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publicidad extends Model
{
    use SoftDeletes;
    protected $table = "publicidad";


    protected $fillable = [
        'user_id', 
        'cliente_id', 
        'banner', 
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'cantidad_publicaciones',
        'publicaciones',
        'estado',
        'deleted_at',
    ];
}
