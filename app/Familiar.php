<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Familiar extends Model
{
    use SoftDeletes;
    protected $table = 'familiares';


    protected $fillable = [
        'user_id', 
        'pariente_id', 
        'modificador_id',
        'eliminador_id',
        'realcion',
        'estado',
        'deleted_at',
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function pariente()
    {
        return $this->belongsTo('App\User', 'pariente_id');
    }
}
