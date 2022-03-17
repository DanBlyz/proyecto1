<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grupo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 
        'sector_id', 
        'modificador_id',
        'eliminador_id',
        'estado',
        'deleted_at',
    ];

}
