<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calificacion extends Model
{
    use SoftDeletes;
    
    protected $table = 'calificaciones';

    protected $fillable = [
        'usuario_id',
        'restaurant_id',
        'comenta',
        'like',
        'nolike',
        'deleted_at'
    ];
}
