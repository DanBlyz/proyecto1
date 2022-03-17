<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localizacion extends Model
{
    use SoftDeletes;
    protected $table = 'localizaciones';


    protected $fillable = [
        'user_id', 
        'dispositivo', 
        'latitud',
        'longitud',
        'deleted_at',
        'estado',
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
