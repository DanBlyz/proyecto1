<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class like extends Model
{
    use SoftDeletes;
    
    protected $table = 'likes';

    protected $fillable = [
        'usuario_id',
        'restaurant_id',
        'like',
        'deleted_at'
    ];
}
