<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comentario extends Model
{
    use SoftDeletes;
    // protected $table = "publicidad";


    protected $fillable = [
        'publicacion_id', 
        'user_id', 
        'comentario', 
        'estado',
        'deleted_at',
    ];

    public function usuario()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
