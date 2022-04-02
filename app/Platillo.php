<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platillo extends Model
{
    use SoftDeletes;
    
    protected $table = 'platillos';

    protected $fillable = [
        'menu_id',
        'nombre',
        'tipo',
        'logotipo',
        'ingredientes',
        'precio',
        'deleted_at'
    ];
}
