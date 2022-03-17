<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 
        'categoria_id', 
        'contenido', 
        'estado',
        'deleted_at',
    ];
}
